<?php

namespace App\AdoptPet\providers;

use App\AdoptPet\controllers\PetAdoptionController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class PetAdoptionRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::middleware(['api','auth:sanctum','verified'])->group(function (){
            Route::get('/animals',[PetAdoptionController::class, 'index'])->name('animals.index');
            Route::get('/animals/{id}',[PetAdoptionController::class, 'show'])->name('animals.show');
            Route::post('/adoption/{id}',[PetAdoptionController::class, 'adoptAnimal'])->name('animals.adopt');
            Route::post('/favorite/{id}',[PetAdoptionController::class, 'favorite'])->name('animals.favorite');
            Route::get('/favorites',[PetAdoptionController::class,'showFavoriteAnimals'])->name('animals.favorites');
        });
    }
}
