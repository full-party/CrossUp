<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GameService;
use Log;
use Throwable;

/**
 * Class GameController
 * @package App\Http\Controllers\Api
 */
class GameController extends Controller
{
    /**
     * ゲーム一覧
     *
     * @return array
     */
    public function index()
    {
        try {
            $result = GameService::list();
        } catch (Throwable $t) {
            Log::error($t);
            return response(['message' => 'internal server error'], 500);
        }
        return $result;
    }

    /**
     * ゲーム詳細
     *
     * @param int $gameId
     * @return mixed
     */
    public function show($gameId)
    {
        try {
            $result = GameService::find($gameId);
        } catch (Throwable $t) {
            Log::error($t);
            return response(['message' => 'internal server error'], 500);
        }

        if (is_null($result)) {
            return response(['message' => 'invalid game id'], 400);
        } else {
            return $result;
        }
    }
}