<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Combo
 * @package App\Model
 */
class Combo extends Model
{
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
}