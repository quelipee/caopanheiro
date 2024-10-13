<?php

namespace App\PetManager\interfaces;

use App\Models\PetEntry;
use App\PetManager\dto\PetDTO;
use App\PetManager\dto\PetUpdateDTO;
use Illuminate\Database\Eloquent\Collection;

interface PetServiceContract
{
    public function PetRegistrationService(PetDTO $dto) : PetEntry;
    public function fetchAllPetsCollection() : Collection;
    public function editAnimalDetails(PetUpdateDTO $dto, string $id) : PetEntry;
    public function removePetById(string $id) : bool;
}
