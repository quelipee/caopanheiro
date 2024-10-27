<?php

namespace App\AdoptPet\enums;

enum AdoptionStatus : string
{
    case AVAILABLE = 'available';
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case ADOPTED = 'adopted';
    case CANCELLED = 'cancelled';
}
