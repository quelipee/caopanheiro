<?php

namespace App\AdoptPet\services;

use App\AdoptPet\dto\adoptFormDTO;
use App\AdoptPet\enums\AdoptionStatus;
use App\AdoptPet\interfaces\PetAdoptionServiceContract;
use App\Models\AdoptionInterest;
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
        $user = Auth::user();
        return PetEntry::query()->whereNot('status','adopted')->whereDoesntHave('petAdoption', function ($query) use ($user) {
            $query->where('user_id',$user->id);
        })->with('shelter')->get();
    }
    public function fetchAnimalDetails(string $id): PetEntry
    {
        return PetEntry::query()->where('id',$id)->with('shelter')->first();
    }
    public function handleAdoption(adoptFormDTO $adoptFormDTO, string $id): PetEntry
    {
        $pet = PetEntry::query()->findOrFail($id);
        $adoption_id = (string) Str::uuid();
        $this->user->userAdoption()->attach($pet->id,[
            'id' => $adoption_id,
            'adoption_date' => Carbon::now(),
            'status' => AdoptionStatus::PENDING->value,
        ]);

        AdoptionInterest::create([
            'adoption_id' => $adoption_id,
            'housing_type' => $adoptFormDTO->housing_type,
            'availability' => $adoptFormDTO->availability,
            'experience' => $adoptFormDTO->experience,
            'other_animals' => $adoptFormDTO->other_animals,
            'reason' => $adoptFormDTO->reason,
        ]);

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
    public function removeFavoriteAnimal(PetEntry $id): PetEntry
    {
        $user = User::find(Auth::id());
        if (!$user){
            throw UserException::notLoggedIn();
        }
        $user->favorite()->detach($id);
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
    public function displayPendingAdoptions() : Collection
    {
        return Auth::user()->userAdoption()->get();
    }
}
