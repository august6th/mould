<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Models\Sign;
use App\Models\Good;
use App\Models\GoodLog;

class LotteryController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin', [
            'only' => ['show', 'destroy', 'edit', 'update', 'change']
        ]);
    }
    // 摇奖操作 获取中奖结果 并返回 信息
    private function get_win()
    {
        $wechat_user = session('wechat.oauth_user');
        $openid = $wechat_user->getId();
        
        $wechat = DB::select('select * from signs where openid = :openid', ['openid' => $openid]);
        $count = count($wechat);
        if($count != 0 && $count == 1){
            $user_id = $wechat[0]->id;
            $lottery_flag = $wechat[0]->lottery_flag;
            $json = array('code' => 0, 'msg' => '', 'uid' => $user_id);
        } else if($count == 0) {
           $json = array('code' => 0, 'msg' => '您未参与签到！', 'uid' => 0);
           return $json;
        } else {
            $json = array('code' => 0, 'msg' => '未知错误，请联系管理员。', 'uid' => 0);
            return $json;
        }

        if ($lottery_flag) {
            $json['msg'] = '您已参与抽奖，请勿重复参与！';
            $json['status'] = 2;
            return $json;
        }

        $arr = array(
            '0' => array('id' => 0, 'good_id' => 1, 'name' => '充电数据线', 'v' => 5),
            '1' => array('id' => 1, 'good_id' => 2, 'name' => '充电宝', 'v' => 3),
            '2' => array('id' => 2, 'good_id' => 3, 'name' => '矿泉水', 'v' => 20),
            '3' => array('id' => 3, 'good_id' => 4, 'name' => '电热水壶', 'v' => 1),
            '4' => array('id' => 4, 'good_id' => 5, 'name' => '矿泉水', 'v' => 20),
            '5' => array('id' => 5, 'good_id' => 6, 'name' => '玻璃杯套装', 'v' => 3),
            '6' => array('id' => 6, 'good_id' => 7, 'name' => '保温杯', 'v' => 3),
            '7' => array('id' => 7, 'good_id' => 8, 'name' => '矿泉水', 'v' => 20),
        );
        /*  开始抽奖  */
        $key = $this->get_rand($arr);
        $win = $arr[$key];
        //输出抽奖信息
//        echo $user_id."<br>";
//        echo $lottery_flag."<br>";
//        echo $key;
//        echo "<pre>";
//        print_r($win);
//        echo "</pre>";
//
//        exit;

        $good = DB::select('select * from goods where id = ?', [$win['good_id']]);

        // 抽奖成功
        if (count($good) > 0) {
            //用户失去唯一抽奖机会
            $affected = DB::update('update signs set lottery_flag = 1 where id = ?', [$user_id]);

            //添加抽奖记录
            $inserted = GoodLog::create([
                'user_oid' => $openid,
                'good_id' => $win['good_id']
            ]);

            if ($affected && $inserted) {
                return array(
                    'code' => 1,
                    'status' => 1,
                    'win' => array(
                        'id' => $win['id'],
                        'name' => $win['name'],
                        'con_point' => $good[0]->con_point,
                    ),
                );
            } else {
                $json['msg'] = '异常错误！';
                $json['status'] = 2;
                return $json;
            }
        } else {
            return array('code' => 0, 'status' => 4, 'msg' => '该活动 处于关闭状态，详情咨询客服！');
        }
    }

    // 抽奖概率算法
    private function get_rand($proArr)
    {
        $result = '';
        foreach ($proArr as $key => $val) {
            $arr[$key] = $val['v'];
        }
        // 概率数组的总概率
        $proSum = array_sum($arr);
        // 概率数组循环
        foreach ($arr as $k => $v) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $v) {
                $result = $k;
                break;
            } else {
                $proSum -= $v;
            }
        }
        return $result;
    }

    private function get_new_win()
    {
        $num = 5;
        $wechat_user = session('wechat.oauth_user');
        $openid = $wechat_user->getId();

        $list = array();

        $list = DB::table('goods_log')
            ->join('signs', 'goods_log.user_oid', '=', 'signs.openid')
            ->join('goods', 'goods_log.good_id', '=', 'goods.id')
            ->select('goods_log.id','signs.name','goods.gname')
            ->orderBy('goods_log.id', 'desc')
            ->limit($num)
            ->get();
        return $list;

    }

    //公共方法
    public function index()
    {
        $wechat_user = session('wechat.oauth_user');
        return view('lotteries.index', compact('wechat_user'));
    }

    public function start()
    {
        $arr = $this->get_win();
        return $arr;
    }

    public function get_list()
    {
        $arr = $this->get_new_win();
        return $arr;
    }

    public function show()
    {
        $goods = Good::all();
        if (count($goods) > 0) {
            return view('lotteries.show', compact('goods'));
        } else {
            return view('lotteries.show');
        }
    }

    public function edit()
    {
        return view('lotteries.edit');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'gname' => 'required',
            'dstock' => 'required',
            'gstock' => 'required',
            'probability' => 'required',
            'gimg' => 'required',
            'con_point' => 'required',
        ]);

        $good = Good::create([
            'gname' => $request->gname,
            'dstock' => $request->dstock,
            'gstock' => $request->gstock,
            'probability' => $request->probability,
            'gimg' => $request->gimg,
            'con_point' => $request->con_point,
        ]);

        if ($good) {
            session()->flash('success', '添加成功！');
            return redirect()->route('lottery.show');
        } else {
            session()->flash('danger', '操作失败，请稍后再试！');
            return redirect('lottery.edit');
        }
    }

    public function destroy($good)
    {
        $deleted = DB::delete('delete from goods where id = ?', ["$good"]);
        if ($deleted) {
            session()->flash('success', '删除成功！');
            return redirect()->back();
        } else {
            session()->flash('danger', '删除失败, 请稍后重试!');
            return redirect()->back();
        }
    }

    public function change($good)
    {
        $good_arr = DB::select('select * from goods where id = ?', ["$good"]);
        $goods = $good_arr[0];
        return view('lotteries.change', compact('goods'));
    }

    public function update(Request $request, $good)
    {
        $update = [];
        foreach( $request->except(['_token', '_method']) as $key => $value){
            if($value){
                $update[$key] = $value;
            }
        }

        if(count($update) > 0){
            $affected = DB::table('goods')
                ->where('id', $good)
                ->update($update);
        }else{
            session()->flash('danger', '您没有修改任何内容！');
            return redirect()->route('lottery.show');
        }

        if ($affected) {
            session()->flash('success', '修改成功！');
            return redirect()->route('lottery.show');
        } else {
            session()->flash('danger', '操作失败，请稍后再试！');
            return redirect()->route('lottery.show');
        }
    }
}
