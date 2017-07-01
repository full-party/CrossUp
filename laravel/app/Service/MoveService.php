<?php

namespace App\Service;

use App\Model\Move;

/**
 * Class MoveService
 * @package App\Service
 */
class MoveService
{
    /**
     * @param int $characterId
     * @return mixed
     */
    public function list(int $characterId)
    {
        return Move::where('character_id', $characterId)->get();
    }
}
