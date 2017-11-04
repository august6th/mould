<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Sign;
use EasyWeChat\OfficialAccount\Application;

class JssdkController extends Controller
{
    public function index()
    {
        $wechat_user = session('wechat.oauth_user');
        $openid = $wechat_user->getId();
        $sign = Sign::where('openid', $openid)->count();
        $flag = Sign::where('openid', $openid)->value('share_flag');

        if ($sign) {
            $app = new Application(['app_id' => env('WECHAT_APPID'), 'secret' => env('WECHAT_SECRET')]);

            $config = $app->jssdk->getConfigArray(
                array(
                    'onMenuShareQQ',
                    'onMenuShareWeibo',
                    'onMenuShareTimeline',
                    'onMenuShareAppMessage'
                ), false
            );

            $config_json = json_encode($config);
            return view('signs.show', compact('config_json', 'wechat_user', 'flag'));
        } else {
            session()->flash('danger','请先签到');
            return redirect()->route('sign.index');
        }
    }
}


