<?php

namespace App\PetManager\providers;

use App\AdoptPet\controllers\PetAdoptionController;
use App\PetManager\controllers\PetManagementController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;


class PetManagementServiceRouteProvider extends RouteServiceProvider
{
    public function map() : void
    {
        Route::prefix('admin')->middleware(['web','auth:sanctum','verified','admin'])->group(function () {
            Route::post('/animals',[PetManagementController::class, 'store'])->name('animals.store');
            Route::get('/animals',[PetManagementController::class, 'index'])->name('animals.index');
        });
        Route::get('/animals',[PetAdoptionController::class, 'index'])->name('animals.index');
    }
}
