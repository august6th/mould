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
}
