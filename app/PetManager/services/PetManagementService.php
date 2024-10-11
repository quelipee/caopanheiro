<?php

namespace App\PetManager\services;

use App\Models\PetEntry;
use App\PetManager\dto\PetDTO;
use App\PetManager\interfaces\PetServiceContract;

class PetManagementService implements PetServiceContract
{
    public function PetRegistrationService(PetDTO $dto)
    {
        return PetEntry::create([
            'name' => $dto->name,
            'species' => $dto->species,
            'breed' => $dto->breed,
            'age' => $dto->age,
            'gender' => $dto->gender,
            'size' => $dto->size,
            'color' => $dto->color,
            'description' => $dto->description,
            'status' => $dto->status,
            'photo' => $dto->photo
        ]);
    }
}
