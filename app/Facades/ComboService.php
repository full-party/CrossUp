<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ComboService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'comboService';
    }
}