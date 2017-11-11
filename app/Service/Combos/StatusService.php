<?php

namespace App\Service\Combos;

use App\Model\Status;

class StatusService
{
    /**
     * コンボステータス一覧取得
     * @param int $gameId
     * @return \Illuminate\Support\Collection
     */
    public function list(int $gameId)
    {
        return Status::where('game_id', $gameId)->get();
    }
}