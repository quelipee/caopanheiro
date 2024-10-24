<?php

return [
    App\Providers\AppServiceProvider::class,
    \App\User\providers\UserServiceProvider::class,
    \App\User\providers\UserRouteServiceProvider::class,
    \App\PetManager\providers\PetManagementServiceProvider::class,
    \App\PetManager\providers\PetManagementServiceRouteProvider::class,
    \App\AdoptPet\providers\PetAdoptionServiceProvider::class,
    \App\AdoptPet\providers\PetAdoptionRouteProvider::class
];
