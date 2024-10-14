<?php

namespace App\PetManager\dto;

use App\Http\Requests\StorePetRequest;

readonly class PetDTO
{
    public function __construct(
        public string $name,
        public string $species,
        public string $breed,
        public int $age,
        public string $gender,
        public string $size,
        public string $color,
        public string $description,
        public string $status,
        public string $photo,
        public string $shelter_id
    ){}

    /**
     * Validate the attributes of a pet from the given request and return a PetDTO.
     *
     * This static method takes a StorePetRequest instance as an argument, validates the
     * pet attributes, and constructs a PetDTO object with the validated data.
     *
     * @param StorePetRequest $request The request instance containing pet data to validate.
     *
     * @return PetDTO The Data Transfer Object containing validated pet attributes.
     */
    public static function ValidatePetAttributes(StorePetRequest $request): PetDTO
    {
        return new self(
            name: $request->validated('name'),
            species: $request->validated('species'),
            breed: $request->validated('breed'),
            age: $request->validated('age'),
            gender: $request->validated('gender'),
            size: $request->validated('size'),
            color: $request->validated('color'),
            description: $request->validated('description'),
            status: $request->validated('status'),
            photo: $request->validated('photo'),
            shelter_id: $request->validated('shelter_id')
        );
    }
}
