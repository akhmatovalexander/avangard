<?php

namespace App\Providers;

use App\Contracts\WeatherServiceInterface;
use App\Services\OpenWeatherService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WeatherServiceInterface::class, function () {
            return new OpenWeatherService();
        });
    }
}
