<?php

namespace App\User\exception;

use Exception;

class UserException extends Exception
{
    public static function EmailAlreadyExistsException(): UserException
    {
        return new self('Email already exists');
    }

    public static function CredentialsInvalidException(): UserException
    {
        return new self('Invalid credentials');
    }

    public static function UserNotFoundException(): UserException
    {
        return new self('User not found');
    }

    public static function UserPermissionsException(): UserException
    {
        return new self('User does not have permissions');
    }

    public static function userTypeNotAdmin(): UserException
    {
        return new self('User type not admin');
    }
}
