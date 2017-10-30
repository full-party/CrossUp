<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Log;
use Request;
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
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request)
    {
        try {
            $userId = Session::get('UserInfo')[0]['id'];
            return UserService::update($userId, $request->all());
        } catch (Throwable $t) {
            Log::error($t);
            return response(['message' => 'internal server error'], 500);
        }
    }
}