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

        $this->app->bind(
            'App\Interfaces\RoleRepositoryInterface',
            'App\Repositories\RoleRepository'
        );

        $this->app->bind(
            'App\Interfaces\PermissionRepositoryInterface',
            'App\Repositories\PermissionRepository'
        );

        $this->app->bind(
            'App\Interfaces\ArticleRepositoryInterface',
            'App\Repositories\ArticleRepository'
        );

        $this->app->bind(
            'App\Interfaces\SlideRepositoryInterface',
            'App\Repositories\SlideRepository'
        );

        $this->app->bind(
            'App\Interfaces\StatusRepositoryInterface',
            'App\Repositories\StatusRepository'
        );

        $this->app->bind(
            'App\Interfaces\FileRepositoryInterface',
            'App\Repositories\FileRepository'
        );

        $this->app->bind(
            'App\Interfaces\EmailRepositoryInterface',
            'App\Repositories\EmailRepository'
        );

        $this->app->bind(
            'App\Interfaces\FaqRepositoryInterface',
            'App\Repositories\FaqRepository'
        );

        $this->app->bind(
            'App\Interfaces\ProductRepositoryInterface',
            'App\Repositories\ProductRepository'
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
