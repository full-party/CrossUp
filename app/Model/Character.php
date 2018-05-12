<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Character
 * @package App\Model
 */
class Character extends Model
{
    /**
     * @param $query
     * @param int $gameId
     * @return mixed
     */
    public function scopeGame($query, int $gameId)
    {
        return $query->where('game_id', $gameId);
    }
}