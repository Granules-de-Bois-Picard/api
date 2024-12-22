<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Interfaces\AuthRepositoryInterface',
            'App\Repositories\AuthRepository'
        );

        $this->app->bind(
            'App\Interfaces\UserRepositoryInterface',
            'App\Repositories\UserRepository'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
