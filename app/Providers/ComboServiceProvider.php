<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComboServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('comboService', 'App\Service\ComboService');
    }
}