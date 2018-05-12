<?php

namespace App\Model;

use DB;
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
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comboStatuses()
    {
        return $this->hasMany('App\Model\ComboStatus');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function statuses()
    {
        return $this->belongsToMany('App\Model\Status')->withTimestamps();
    }

    /**
     * コンボステータス絞り込み
     * @param $query
     * @param array $statusIds
     * @return mixed
     */
    public function scopeComboStatus($query, array $statusIds)
    {
        return $query->whereExists(function ($query) use ($statusIds) {
            $query->select(DB::raw(1))
                ->from('combo_status')
                ->whereRaw('combo_status.combo_id = combos.id')
                ->whereIn('status_id', $statusIds);
        });
    }

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