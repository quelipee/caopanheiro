<?php

namespace App\User\dto;

use App\User\requests\RegisterUserRequest;

readonly class signUp
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $phone_number,
        public string $address,
    ){}

    public static function FromValidatedRequest(RegisterUserRequest $request): signUp
    {
        return new self(
            name : $request->validated('name'),
            email : $request->validated('email'),
            password : $request->validated('password'),
            phone_number : $request->validated('phone_number'),
            address : $request->validated('address'),
        );
    }
}
