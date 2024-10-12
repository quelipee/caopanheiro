<?php

namespace App\PetManager\services;

use App\Models\PetEntry;
use App\PetManager\dto\PetDTO;
use App\PetManager\interfaces\PetServiceContract;
use Illuminate\Database\Eloquent\Collection;

class PetManagementService implements PetServiceContract
{
    public function PetRegistrationService(PetDTO $dto) : PetEntry
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

    public function fetchAllPetsCollection(): Collection
    {
        return PetEntry::all();
    }
}
