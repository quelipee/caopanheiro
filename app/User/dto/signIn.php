<?php

namespace App\User\dto;

use App\User\requests\SignInUserRequest;

readonly class signIn
{
    public function __construct(
        public string $email,
        public string $password
    ){}

    public static function FromValidatedRequest(SignInUserRequest $request): signIn
    {
        return new self(
            email: $request->validated('email'),
            password: $request->validated('password')
        );
    }
}
