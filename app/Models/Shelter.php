<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shelter extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'shelter';
    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'email',
        'description',
    ];

    public function animals(): HasMany
    {
        return $this->hasMany(PetEntry::class, 'shelter_id');
    }
}
