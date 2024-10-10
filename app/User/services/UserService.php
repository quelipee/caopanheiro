<?php

namespace App\User\services;

use App\Models\User;
use App\User\dto\signIn;
use App\User\dto\signUp;
use App\User\exception\UserException;
use App\User\UserServiceContract;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceContract
{
    /**
     * @throws UserException
     */
    public function initiateUserRegistration(signUp $signUp): User
    {
        if (User::query()->where('email', $signUp->email)->exists()) {
            throw UserException::EmailAlreadyExistsException();
        }
        $user = new User([
            'name' => $signUp->name,
            'email' => $signUp->email,
            'password' => $signUp->password,
            'address' => $signUp->address,
            'phone_number' => $signUp->phone_number,
        ]);
        $user->save();

        return $user;
    }
    /**
     * @throws UserException
     */
    public function verifyCredentials(signIn $signIn): array
    {
        if (!Auth::attempt(['email' => $signIn->email, 'password' => $signIn->password])) {
            throw UserException::CredentialsInvalidException();
        }

        $user = Auth::user();
        $tokenJWT = $user->createToken('jwt')->plainTextToken;
        return [
            "access_token" => $tokenJWT,
            "token_type" => "bearer",
            "user" => $user
        ];
    }

    /**
     * @throws UserException
     */
    public function invalidateSession(): bool
    {
        if (!Auth::check()){
            throw UserException::UserNotFoundException();
        }
        $user = Auth::user();
        $user->tokens()->delete();
        return true;
    }
}
