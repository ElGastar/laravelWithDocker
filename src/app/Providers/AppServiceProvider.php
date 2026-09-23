<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Greeting;
use App\Services\PriceFormatter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('greeting', function ($app) {
            return new Greeting();
        });
        $this->app->singleton('price_formatter', function ($app) {
            return new PriceFormatter();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
