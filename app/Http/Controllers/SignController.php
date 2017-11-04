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
            session()->flash('info', '您已签到');
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
}
