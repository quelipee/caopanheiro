<?php

namespace App\AdoptPet\providers;


use App\AdoptPet\interfaces\PetAdoptionServiceContract;
use App\AdoptPet\services\PetAdoptionService;
use Illuminate\Support\ServiceProvider;

class PetAdoptionServiceProvider extends ServiceProvider
{
    public function register() : void {
        $this->app->bind(PetAdoptionServiceContract::class, function (){
            return new PetAdoptionService();
        });
    }
    public function boot() : void {

    }
}
