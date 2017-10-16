<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoodController extends Controller
{
    public function index()
    {
        $wechat_user = session('wechat.oauth_user');
        return view('lotteries.index', compact('wechat_user'));
    }
}
