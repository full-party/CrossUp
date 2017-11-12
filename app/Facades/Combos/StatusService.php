<?php

namespace App\Facades\Combos;

use Illuminate\Support\Facades\Facade;

class StatusService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'combosStatusService';
    }
}