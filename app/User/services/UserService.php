<?php

namespace App\User\services;

use App\Models\User;
use App\User\dto\signUp;
use App\User\exception\UserException;
use App\User\UserServiceContract;

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
}
