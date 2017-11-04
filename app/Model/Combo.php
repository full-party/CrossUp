<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Combo
 * @package App\Model
 */
class Combo extends Model
{
    protected $fillable = ['character_id', 'damage', 'stun', 'memo', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function character()
    {
        return $this->belongsTo('App\Model\Character');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recipes()
    {
        return $this->hasMany('App\Model\Recipe');
    }    /**

    /**
     * キャラクターの絞り込み
     * @param $query クエリービルドインスタンス
     * @param $character_id キャラクターID
     * @return クエリービルドインスタンス
     */
    public function scopeCharacter($query, $character_id)
    {
        return $query->where('character_id', $character_id);
    }
}