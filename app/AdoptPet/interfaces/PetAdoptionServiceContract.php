<?php

namespace App\AdoptPet\interfaces;

use App\AdoptPet\dto\adoptFormDTO;
use App\Models\PetEntry;
use Illuminate\Database\Eloquent\Collection;

interface PetAdoptionServiceContract
{
    public function listAvailableAnimals() : Collection;
    public function fetchAnimalDetails(string $id) : PetEntry;
    public function handleAdoption(adoptFormDTO $dto,string $id) : PetEntry;
    public function markAnimalAsFavorite(PetEntry $id) : PetEntry;
    public function removeFavoriteAnimal(PetEntry $id) : PetEntry;
    public function displayFavoriteAnimals() : Collection;
    public function displayPendingAdoptions();
}
