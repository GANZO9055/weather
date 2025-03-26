<?php

namespace App\Providers;

use App\Repository\user\UserPostgresqlRepository;
use App\Repository\user\UserRepository;
use App\Service\user\SimpleUserService;
use App\Service\user\UserService;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(UserService::class, SimpleUserService::class);
        $this->app->bind(UserRepository::class, UserPostgresqlRepository::class);
    }
}
