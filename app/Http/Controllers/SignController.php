<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Sign;
use Illuminate\Support\Facades\DB;

class SignController extends Controller
{
    public function index()
    {
//        dd(time());
        /*
         * 活动开始时间限制。
        $now_time = time();
        $start_time = strtotime('2017-11-9 9:00:00');
        if( $now_time < $start_time ) {
            return view('welcome');
        }
        */

        $wechat_user = session('wechat.oauth_user'); // 拿到授权用户资料

        $openid = $wechat_user->getId();

        $sign = Sign::where('openid', $openid)->count();

        if ($sign) {
            session()->flash('warning', '我们会尽快为您开通免费试用资格！');
            session()->flash('info', '您已提交成功！');
            return redirect()->route('share.index');
        }else{
            return view('signs.index', compact('wechat_user'));
        }

    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:50',
            'telephone' => 'required|unique:signs|max:11',
            'corporate' => 'required|max:255',
            'openid' => 'required|unique:signs|max:255',
        ]);

        $sign = Sign::create([
            'name' => $request->name,
            'telephone' => $request->telephone,
            'corporate' => $request->corporate,
            'openid' => $request->openid,
        ]);

        if ($sign) {
            session()->flash('success', '签到成功！');
            return redirect()->route('share.index');
        } else {
            session()->flash('danger', '网络出错，请稍后重试!');
            return redirect()->back();
        }
    }

    public function setShareFlag(Request $request)
    {
        $share_flag = $request->share_flag;
        if ($share_flag) {
            $wechat_user = session('wechat.oauth_user'); // 拿到授权用户资料
            $openid = $wechat_user->getId();

            $affected = DB::update('update signs set share_flag = ? where openid = ?', [$share_flag, $openid]);

            return $affected;
        } else {
            return false;
        }
    }
    
    public function show()
    {
        $signs = Sign::paginate(10);
        $counts = Sign::count();
//        dd($signs);
        return view('signs.signer', compact('signs', 'counts'));
    }

    public function getExcel()
    {
        $signs = Sign::all()->toArray();
        if (!empty($signs)) {
            $detail = '';
            $subject = '';
            foreach ($signs as $key => $sign) {
                $sign = collect($sign)->only('name', 'corporate', 'telephone');
                foreach ($sign as $item => $value) {
                    $value = preg_replace('/\s+/', ' ', $value);
                    $value = preg_replace('/,/', "，", $value);
                    $detail .= strlen($value) > 11 && is_numeric($value) ? '['.$value.']': $value.",";
                }
                $detail = $detail."\n";
            }
            $title = array(
                'name' => '姓名',
                'corporate' => '公司名称',
                'telephone' => '联系方式'
            );

            foreach($title as $k => $v) {
                $subject .= ($v ? $v : $k).",";
            }

            $detail = $subject."\n".$detail;
            $filename = date('YmdHis', time()). '.csv';
            ob_end_clean();
            header('Content-Encoding: none');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.$filename);
            header('Pragma: no-cache');
            header('Expires: 0');
            echo $detail;
            exit();
        }
    }
}
