<?php

namespace App\User;

use App\Models\User;
use App\User\dto\signUp;

interface UserServiceContract
{
    public function initiateUserRegistration(signUp $signUp) : User;
}
