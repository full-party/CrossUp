<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckLogin
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

        // セッションにユーザー情報が入っていた場合表示する
        if (Session::has('UserInfo') && isset(Session::get('UserInfo')[0]) && isset(Session::get('UserInfo')[0]['id'])) {
            return $next($request);
        }

        // 入っていない場合はTOPにリダイレクト
        return redirect('/');
    }
}
