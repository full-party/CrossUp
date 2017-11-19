<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdate;
use Log;
use Session;
use Throwable;
use UserService;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
{
    /**
     * @param int $userId
     * @param UserUpdate $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(int $userId, UserUpdate $request)
    {
        if ($userId !== intval(Session::get('UserInfo')[0]['id'])) {
            return response(['message' => 'Forbidden'], 403);
        }

        if ($request->has('login_id') && UserService::checkDuplicate($userId, 'login_id', $request->get('login_id'))) {
            return response(['message' => 'login_id duplicate : ' . $request->get('login_id')], 412);
        }

        if ($request->has('email') && UserService::checkDuplicate($userId, 'email', $request->get('email'))) {
            return response(['message' => 'email duplicate : ' . $request->get('email')], 412);
        }

        try {
            return UserService::update($userId, $request->all());
        } catch (Throwable $t) {
            Log::error($t);
            return response(['message' => 'internal server error'], 500);
        }
    }

    /**
     * @param int $userId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy(int $userId)
    {
        if ($userId !== intval(Session::get('UserInfo')[0]['id'])) {
            return response(['message' => 'Forbidden'], 403);
        }

        try {
            return UserService::destroy($userId);
        } catch (Throwable $t) {
            Log::error($t);
            return response(['message' => 'internal server error'], 500);
        }
    }
}