<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class MoveService
 * @package App\Facades
 */
class MoveService extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'moveService';
    }
}