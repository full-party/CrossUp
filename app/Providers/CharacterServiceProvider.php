<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CharacterServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('characterService', 'App\Service\CharacterService');
    }
}
