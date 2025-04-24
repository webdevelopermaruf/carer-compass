<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Faker\Factory as FakerFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        app()->singleton(\Faker\Generator::class, function () {
            return FakerFactory::create('en_GB'); // 🇬🇧 UK English
        });

        Paginator::useBootstrapFour();
    }
}
