<?php

namespace App\User\exception;

use Exception;

class UserException extends Exception
{
    public static function EmailAlreadyExistsException(): UserException
    {
        return new self('Email already exists');
    }
}
