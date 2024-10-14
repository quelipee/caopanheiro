<?php

namespace App\PetManager\services;

use App\AdoptPet\enums\AdoptionStatus;
use App\Models\PetEntry;
use App\Models\User;
use App\PetManager\dto\PetDTO;
use App\PetManager\dto\PetUpdateDTO;
use App\PetManager\Exceptions\PetException;
use App\PetManager\interfaces\PetServiceContract;
use Carbon\Carbon;
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

    /**
     * @throws PetException
     */
    public function editAnimalDetails(PetUpdateDTO $dto, string $id): PetEntry
    {
        $pet = PetEntry::find($id);
        $attributes = array_filter((array) $dto);
        if (!$pet) {
            throw PetException::PetNotFoundException();
        }
        $pet->fill($attributes);
        $pet->save();
        return $pet;
    }

    /**
     * @throws PetException
     */
    public function removePetById(string $id): bool
    {
        $pet = PetEntry::find($id);
        if (!$pet) {
            throw PetException::PetNotFoundException();
        }
        return $pet->delete();
    }
    public function finalizeAdoption(PetEntry $pet, User $user): PetEntry
    {
        $pet->petAdoption()->updateExistingPivot($user,[
            'status' => AdoptionStatus::ADOPTED->value,
            'adoption_date' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $pet->update([
            'status' => AdoptionStatus::ADOPTED->value
        ]);
        $pet->save();
        return $pet;
    }
}
