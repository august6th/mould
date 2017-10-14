<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use EasyWeChat\OfficialAccount\Application;

class JssdkController extends Controller
{
    public function index(Application $officialAccount)
    {

        $js = $officialAccount->js;
        dd($js);
    }
}


