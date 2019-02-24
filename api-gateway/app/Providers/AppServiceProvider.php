<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Tinker\TinkerServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(TinkerServiceProvider::class);
    }
}
