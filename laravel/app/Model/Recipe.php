<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Recipe
 * @package App\Model
 */
class Recipe extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function move()
    {
        return $this->belongsTo('App\Model\Move');
    }
}