<?php

namespace App\AdoptPet\services;

use App\AdoptPet\enums\AdoptionStatus;
use App\AdoptPet\interfaces\PetAdoptionServiceContract;
use App\Models\PetEntry;
use App\Models\User;
use App\PetManager\Exceptions\PetException;
use App\User\exception\UserException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
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

    /**
     * @throws UserException
     * @throws PetException
     */
    public function markAnimalAsFavorite(PetEntry $id): PetEntry
    {
        $user = User::find(Auth::id());
        if (!$user){
            throw UserException::notLoggedIn();
        }

        if ($this->getExistsAnimal($user, $id)){
            throw PetException::DuplicateFavoriteAnimalException();
        }
        $user->favorite()->attach($id,[
            'id' => (string) Str::uuid(),
        ]);
        return $id;
    }

    /**
     * @param $user
     * @param PetEntry $pet
     * @return bool
     */
    public function getExistsAnimal($user, PetEntry $pet): bool
    {
        return $user->favorite()->where('animal_id',$pet->id)->exists();
    }

    public function displayFavoriteAnimals(): Collection
    {
        return Auth::user()->favorite()->whereNotIn('status',['adopted'])->get();
    }
}
