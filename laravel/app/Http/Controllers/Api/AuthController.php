<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStore;
use App\Http\Requests\UserLogin;
use Hash;
use Session;
use Throwable;
use UserService;
use Log;

class AuthController extends Controller
{
    /**
     * @param UserStore $request
     * @return int
     */
    public function store(UserStore $request): int
    {
        try {
            return UserService::store($request->all());
        } catch (Throwable $t) {
            Log::error($t);
            return response(['message' => 'internal server error'], 500);
        }
    }

    /**
     * @param UserLogin $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function login(UserLogin $request)
    {
        try {
            $userInfo = UserService::find($request->loginId);
        } catch (Throwable $t) {
            Log::error($t);
            return response(['message' => 'internal server error'], 500);
        }

        // ログインIDでユーザーが取得できない、またはパスワードが一致しない
        if (is_null($userInfo) || !Hash::check($request->password, $userInfo['password'])) {
            return response(['message' => 'login failed'], 401);
        }
        // セッション内のデータを全て削除しユーザーデータをセッションに追加
        Session::flush();
        Session::push('UserInfo', $userInfo);
        return response(['message' => 'login success']);
    }

    /**
     * ログアウト関数
     */
    public function logout() {
        Session::flush();
        return response(['message' => 'logout success']);
    }
}
