<?php

namespace App\AdoptPet\enums;

enum AdoptionStatus : string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case ADOPTED = 'adopted';
    case CANCELLED = 'cancelled';
}
