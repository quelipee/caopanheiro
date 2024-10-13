<?php

namespace App\AdoptPet\services;

use App\AdoptPet\enums\AdoptionStatus;
use App\AdoptPet\interfaces\PetAdoptionServiceContract;
use App\Models\PetEntry;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class PetAdoptionService implements PetAdoptionServiceContract
{
    public function __construct(protected User $user) {}
    public function listAvailableAnimals(): Collection
    {
        return PetEntry::query()->whereNot('status','adopted')->get();
    }
    public function fetchAnimalDetails(string $id): PetEntry
    {
        return PetEntry::query()->findOrFail($id);
    }
    public function handleAdoption(string $id): PetEntry
    {
        $pet = PetEntry::query()->findOrFail($id);
        $this->user->userAdoption()->attach($pet->id,[
            'id' => (string) Str::uuid(),
            'adoption_date' => Carbon::now(),
            'status' => AdoptionStatus::PENDING->value,
        ]);
        $this->user->save();
        return $pet;
    }
}
