<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class FlashServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Global variable share karvu hoy to
        View::share('flash_config', [
            'timeout' => 3000,
            'animation' => 'fadeIn'
        ]);
    }
}