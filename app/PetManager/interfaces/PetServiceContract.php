<?php

namespace App\PetManager\interfaces;

use App\PetManager\dto\PetDTO;

interface PetServiceContract
{
    public function PetRegistrationService(PetDTO $dto);
}
