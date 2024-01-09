<?php

namespace App\Providers;

use App\interfaces\IRepository\IOTPRepository;
use App\interfaces\IRepository\IUserRepository;
use App\repository\OTPRepository;
use App\repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class UserRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class,UserRepository::class);
        $this->app->bind(IOTPRepository::class,OTPRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
