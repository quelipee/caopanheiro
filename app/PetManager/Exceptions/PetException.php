<?php

namespace App\PetManager\Exceptions;

use Exception;

class PetException extends Exception
{
    public static function PetNotFoundException() : PetException
    {
        return new self('The pet you are looking for does not exist.');
    }

    public static function DuplicateFavoriteAnimalException(): PetException
    {
        return new self('The pet you are looking for already favorite animal.');
    }
}
