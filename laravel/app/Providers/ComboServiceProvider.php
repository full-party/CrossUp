<?php
namespace App\Providers;

use App\Service\ComboService;
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
        $this->app->bind('ComboService', new ComboService());
    }
}