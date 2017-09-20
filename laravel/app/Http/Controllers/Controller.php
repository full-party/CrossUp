<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Session;
use Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkLogin(Request $request)
    {
      // TOPの場合はそのまま表示
      if (strcmp($request->path(), '/') === 0) {
        return view('app');
      }
      // セッションにユーザー情報が入っていた場合表示する
      if (Session::has('UserInfo') && isset(Session::get('UserInfo')[0]) && isset(Session::get('UserInfo')[0]['id'])) {
        return view('app');
      } else {
        // 入っていない場合はTOPにリダイレクト
        return redirect('/');
      }
    }
}
