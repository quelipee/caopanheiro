<?php

namespace App\User\providers;

use App\Models\User;
use App\User\exception\UserException;
use App\User\interfaces\UserServiceContract;
use App\User\services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceContract::class, function () {
                return new UserService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
