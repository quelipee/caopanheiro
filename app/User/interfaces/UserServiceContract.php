<?php

namespace App\User\interfaces;

use App\Models\User;
use App\User\dto\signIn;
use App\User\dto\signUp;

interface UserServiceContract
{
    public function initiateUserRegistration(signUp $signUp) : User;
    public function verifyCredentials(signIn $signIn) : array;
    public function invalidateSession() : bool;
}
