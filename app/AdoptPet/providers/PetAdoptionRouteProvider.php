<?php

namespace App\AdoptPet\providers;

use App\AdoptPet\controllers\PetAdoptionController;
use App\Http\Middleware\PreventDuplicateAdoption;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class PetAdoptionRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::prefix('api')->middleware(['api','auth:sanctum','verified'])->group(function (){
            Route::get('/animals',[PetAdoptionController::class, 'index'])->name('animals.index');
            Route::get('/animals/{id}',[PetAdoptionController::class, 'show'])->name('animals.show');
            Route::post('/adoption/{id}',[PetAdoptionController::class, 'adoptAnimal'])
                ->middleware(PreventDuplicateAdoption::class)
                ->name('animals.adopt');
            Route::get('/adoptions/pending',[PetAdoptionController::class, 'pendingAdoptions'])->name('adoptions.pending');;
            Route::post('/favorite/{id}',[PetAdoptionController::class, 'favorite'])->name('animals.favorite');
            Route::delete('/favorite/{id}',[PetAdoptionController::class, 'unfavorite'])->name('animals.unfavorite');
            Route::get('/favorites',[PetAdoptionController::class,'showFavoriteAnimals'])->name('animals.favorites');
        });
    }
}
