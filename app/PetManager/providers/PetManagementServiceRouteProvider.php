<?php

namespace App\PetManager\providers;

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
            Route::put('/animals/{id}',[PetManagementController::class, 'update'])->name('animals.update');
            Route::delete('/animals/{id}',[PetManagementController::class, 'destroy'])->name('animals.destroy');
            Route::put('/adoption/{pet}/{user}/complete',[PetManagementController::class, 'completeAdoption'])
                ->middleware('CheckPetAdoptionStatus')
                ->name('animals.completeAdoption');
        });
    }
}
