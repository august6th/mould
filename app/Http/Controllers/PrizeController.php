<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Models\Sign;
use App\Models\Good;
use App\Models\GoodLog;

class PrizeController extends Controller
{
    //
    public function index()
    {
        $prizes = DB::table('goods_log')
            ->join('signs', function ($json) {
                $json->on('goods_log.user_oid', '=', 'signs.openid')
                    ->where('signs.openid', '=', session('wechat.oauth_user')->getId());
            })
            ->join('goods', 'goods_log.good_id', '=', 'goods.id')
            ->select('goods.gname', 'goods.gimg', 'goods.con_point', 'goods_log.receive', 'goods_log.id')
            ->get()->toArray();

        foreach ($prizes as $prize) {
            $arr = explode(',', $prize->con_point);
            $prize->con_des = $arr[0];
            $prize->con_poi = $arr[1];
        }
        return view('prizes.index', compact('prizes'));
    }
    
    public function update(Request $request)
    {
        $wechat_user = session('wechat.oauth_user');
        $openid = $wechat_user->getId();
        $id = $request->id;

        if (!is_null($id)) {
            $affected = DB::table('goods_log')
                ->where(['id' => $id, 'user_oid' => $openid])
                ->update([
                    'receive' => 1
                ]);
        } else {
            session()->flash('danger', '网络错误！请稍后重试！');
            return redirect()->route('prize.index');
        }

        if ($affected) {
            session()->flash('success', '领取完成！感谢您的参与');
            return redirect()->route('prize.index');
        } else {
            session()->flash('danger', '领取失败！请稍后重试');
            return redirect()->route('prize.index');
        }
    }
}
