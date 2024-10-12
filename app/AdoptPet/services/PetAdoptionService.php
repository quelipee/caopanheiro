<?php

namespace App\AdoptPet\services;

use App\AdoptPet\interfaces\PetAdoptionServiceContract;
use App\Models\PetEntry;
use Illuminate\Database\Eloquent\Collection;

class PetAdoptionService implements PetAdoptionServiceContract
{
    public function listAvailableAnimals(): Collection
    {
        return PetEntry::query()->whereNot('status','adopted')->get();
    }
}
