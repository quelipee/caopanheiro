<?php

namespace App\AdoptPet\dto;

use App\Http\Requests\AdoptionInterestRequest;

readonly class adoptFormDTO {

    public function __construct(
        public string $housing_type,
        public int $availability,
        public string $experience,
        public string $other_animals,
        public string $reason,
        public string $animal_id,
    ){}

    public static function FromArrayValidated(AdoptionInterestRequest $request): adoptFormDTO {
        return new self(
            housing_type: $request->validated('housing_type'),
            availability: $request->validated('availability'),
            experience: $request->validated('experience'),
            other_animals: $request->validated('other_animals'),
            reason: $request->validated('reason'),
            animal_id: $request->validated('animal_id'),
        );
    }
}
