<?php

namespace App\User\providers;

use App\User\controllers\UserController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;


class UserRouteServiceProvider extends RouteServiceProvider
{
    public function map() : void
    {
        Route::prefix('api')->middleware(['guest:sanctum'])->group(function () {
            Route::post('/register', [ UserController::class, 'store'])->name('register');
            Route::post('/login', [ UserController::class, 'login'])->name('login');
        });
        Route::middleware(['web','auth:sanctum'])->group(function () {
            Route::post('/logout', [ UserController::class, 'logout'])->name('logout');
        });
    }
}
