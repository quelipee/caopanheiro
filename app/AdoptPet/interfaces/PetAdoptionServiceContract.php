<?php

namespace App\AdoptPet\interfaces;

use App\Models\PetEntry;
use Illuminate\Database\Eloquent\Collection;

interface PetAdoptionServiceContract
{
    public function listAvailableAnimals() : Collection;
    public function fetchAnimalDetails(string $id) : PetEntry;
}
