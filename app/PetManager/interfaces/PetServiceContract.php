<?php

namespace App\PetManager\interfaces;

use App\Models\PetEntry;
use App\PetManager\dto\PetDTO;
use Illuminate\Database\Eloquent\Collection;

interface PetServiceContract
{
    public function PetRegistrationService(PetDTO $dto) : PetEntry;
    public function fetchAllPetsCollection() : Collection;
}
