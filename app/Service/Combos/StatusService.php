<?php

namespace App\Service\Combos;

use App\Model\Status;

class StatusService
{
    public function list(int $gameId)
    {
        return Status::where('game_id', $gameId)->get();
    }
}