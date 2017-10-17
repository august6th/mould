<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;
use App\Models\Sign;
use Closure;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $wechat_user = session('wechat.oauth_user');
        $is_admin = 0;
        $openid = $wechat_user->getId();
        $wechat = DB::select('select * from signs where openid = :openid', ['openid' => $openid]);
        $count = count($wechat);
        if($count > 0) {
            $user_id = $wechat[0]->id;
            $is_admin = $wechat[0]->is_admin;
        }

        if (!$is_admin) {
            session()->flash('danger', '您不是管理员！请勿执行此操作');
            return redirect()->route('share.index');
        }
        
        return $next($request);
    }
}
