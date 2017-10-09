<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Game
 * @package App\Model
 */
class Game extends Model
{
    protected $fillable = ['id', 'name', 'logo'];
}