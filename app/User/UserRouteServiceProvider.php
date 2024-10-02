<?php

namespace App\User;

use App\User\controllers\UserController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class UserRouteServiceProvider extends RouteServiceProvider
{
    public function map() : void
    {
        Route::middleware(['web','guest:sanctum'])->group(function () {
            Route::post('/register', [ UserController::class, 'store'])->name('register');
        });
    }
}
