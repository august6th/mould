<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use EasyWeChat\Foundation\Application;


class JssdkController extends Controller
{
    public function index()
    {

        $options = [
            'open_platform' => [
                'app_id' => env('WECHAT_APPID'),
                'secret' => env('WECHAT_SECRET'),
                'token' => env('WECHAT_TOKEN'),
                'aes_key' => env('WECHAT_AES_KEY')
            ],
            'oauth' => [
                'scopes' => ['snsapi_userinfo'],
                'callback' => 'api/oauth',
            ],
            'guzzle' => [
                'timeout' => 3.0, // 超时时间（秒）
                //'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
            ],
        ];

        $application = new Application($options);
        $js = $application->js;
        dd($js);
    }
}
