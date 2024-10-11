<?php

namespace App\PetManager\providers;

use App\Models\User;
use App\PetManager\interfaces\PetServiceContract;
use App\PetManager\services\PetManagementService;
use App\User\exception\UserException;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class PetManagementServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register() : void {
        $this->app->bind(PetServiceContract::class, function ($app) {
            $role = User::find(Auth::id());
            return match ($app['config']['auth.user_types.' . $role->user_type]) {
              'Admin' => new PetManagementService(),
              default => throw UserException::userTypeNotAdmin()
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot() : void {

    }
}
