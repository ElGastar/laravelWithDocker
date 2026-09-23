<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Greeting;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
