<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Sign;

class SignController extends Controller
{
    public function index()
    {
        $wechat_user = session('wechat.oauth_user'); // 拿到授权用户资料
        return view('signs.index', compact('wechat_user'));
    }
    
    public function show()
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

        

        return view('signs.show', compact('options'));
    }
}
