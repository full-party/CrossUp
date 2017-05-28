<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GameService;

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
        return GameService::list();
    }

    /**
     * ゲーム詳細
     *
     * @param int $gameId
     * @return mixed
     */
    public function show(int $gameId)
    {
        return GameService::find($gameId);
    }
}