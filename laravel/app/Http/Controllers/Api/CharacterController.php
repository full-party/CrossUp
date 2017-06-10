<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CharacterService;
use Log;
use Throwable;
use Validator;

class CharacterController extends Controller
{
    /**
     * キャラクター一覧
     *
     * @return array
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'gameId' => 'required|numeric|min:1|max:2',
        ]);
        if ($validator->fails()) {
            return response(['message' => 'validator error'], 400);
        }

        try {
            $result = CharacterService::list($request->input('gameId'));
        } catch (Throwable $t) {
            Log::error($t);
            return response(['message' => 'internal server error'], 500);
        }
        return $result;
    }

}
