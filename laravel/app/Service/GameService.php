<?php

namespace App\Service;

use App\Model\Game;

/**
 * Class GameService
 * @package App\Service
 */
class GameService
{
    /**
     * ゲーム一覧を取得
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function list()
    {
        $game = Game::all();
        return ['count' => $game, 'data' => $game];
    }

    /**
     * ゲーム詳細を取得
     *
     * @param int $gameId
     * @return mixed
     */
    public function find(int $gameId)
    {
        return Game::find($gameId);
    }
}