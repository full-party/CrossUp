<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CharacterService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'characterService';
    }
}