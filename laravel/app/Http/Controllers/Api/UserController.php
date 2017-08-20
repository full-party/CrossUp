<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStore;
use App\Http\Requests\UserLogin;
use Hash;
use Session;
use Throwable;
use UserService;
use Log;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
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

        Session::push('UserInfo', $userInfo);
        return response(['message' => 'login success']);
    }
}