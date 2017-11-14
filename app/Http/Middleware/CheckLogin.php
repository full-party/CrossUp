<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Pagination\Paginator;
use Session;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param string $mode
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next, string $mode = 'web')
    {
        // セッションにユーザー情報が入っていた場合表示する
        if (Session::has('UserInfo') && isset(Session::get('UserInfo')[0]) && isset(Session::get('UserInfo')[0]['id'])) {
            return $next($request);
        }

        // 入っていない場合はTOPにリダイレクト
        if ($mode === 'api') {
            throw new AuthenticationException('Unauthenticated.');
        } else {
            return redirect('/');
        }
    }
}
