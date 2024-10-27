<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class AdoptionInterest extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'adoption_interests';

    protected $fillable = [
        'adoption_id',
        'housing_type',
        'availability',
        'experience',
        'other_animals',
        'reason',
    ];
}
