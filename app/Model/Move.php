<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    /**
     * MoveIdを計算してメンバに設定する
     * @param int $moveIndex
     * @return bool
     */
    public function setMoveId(int $moveIndex): bool
    {
        // キャラクターIDを先に設定必須
        if (!isset($this->character_id)) {
            return false;
        }

        // キャラクターID * 1000 - 999 + 技indexをIDのとする
        $this->id = intval($this->character_id) * 1000 - 999 + $moveIndex;
        return true;
    }
}