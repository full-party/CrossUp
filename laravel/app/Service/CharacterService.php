<?php

namespace App\Service;

use App\Model\Character;

class CharacterService
{
    /**
     * キャラクター一覧を取得
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function list($gameId)
    {
        $character = Character::where('game_id',$gameId)->get();
        return ['count' => count($character), 'data' => $character];
    }
}