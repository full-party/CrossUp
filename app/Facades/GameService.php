<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class GameService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'gameService';
    }
}