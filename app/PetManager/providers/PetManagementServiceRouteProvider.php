<?php

namespace App\PetManager\providers;

use App\PetManager\controllers\PetManagementController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;


class PetManagementServiceRouteProvider extends RouteServiceProvider
{
    public function map() : void
    {
        Route::middleware(['web','auth:sanctum','verified'])->group(function () {
            Route::post('/animals',[PetManagementController::class, 'store'])->name('animals.store');
        });
    }
}
