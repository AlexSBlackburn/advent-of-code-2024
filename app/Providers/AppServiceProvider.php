<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        \App\Services\InputService::class => \App\Services\InputService::class,
        \App\Services\LocationService::class => \App\Services\LocationService::class,
        \App\Services\ReactorService::class => \App\Services\ReactorService::class,
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}
