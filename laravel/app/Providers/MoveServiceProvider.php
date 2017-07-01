<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MoveServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('moveService', 'App\Service\MoveService');
    }
}