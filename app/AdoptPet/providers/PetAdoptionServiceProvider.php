<?php

namespace App\AdoptPet\providers;


use App\AdoptPet\interfaces\PetAdoptionServiceContract;
use App\AdoptPet\services\PetAdoptionService;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class PetAdoptionServiceProvider extends ServiceProvider
{
    public function register() : void {
        $this->app->bind(PetAdoptionServiceContract::class, function (){
            $user = User::find(Auth::id());
            return new PetAdoptionService($user);
        });
    }
    public function boot() : void {

    }
}
