<?php

namespace App\Service;

use App\Model\Game;

class GameService
{
    public function find(int $id)
    {
        return Game::find($id);
    }
}