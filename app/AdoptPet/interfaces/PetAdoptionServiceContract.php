<?php

namespace App\AdoptPet\interfaces;

use Illuminate\Database\Eloquent\Collection;

interface PetAdoptionServiceContract
{
    public function listAvailableAnimals() : Collection;
}
