<?php

namespace App\Providers;

use App\Repository\location\LocationPostgresqlRepository;
use App\Repository\location\LocationRepository;
use App\Repository\user\UserPostgresqlRepository;
use App\Repository\user\UserRepository;
use App\Service\location\LocationService;
use App\Service\location\SimpleLocationService;
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

        $this->app->bind(LocationRepository::class, LocationPostgresqlRepository::class);
        $this->app->bind(LocationService::class, SimpleLocationService::class);
    }
}
