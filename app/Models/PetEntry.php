<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class PetEntry extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'animal';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      'name',
      'species',
      'breed',
      'age',
      'gender',
      'size',
      'color',
      'description',
      'status',
      'photo',
      'shelter_id'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'age' => 'integer',
        'size' => 'integer',
    ];

    protected $hidden = [
        'shelter_id',
    ];

    public function petAdoption(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'adoption',
            'animal_id','user_id')->withPivot('status', 'adoption_date', 'id')->withTimestamps();
    }

    public function shelter(): BelongsTo
    {
        return $this->belongsTo(Shelter::class);
    }

    public function favorite()
    {
        return $this->belongsToMany(User::class,'favorites','animal_id','user_id')->withTimestamps();
    }

    public function adoptionInterests(): HasManyThrough
    {
        return $this->hasManyThrough(AdoptionInterest::class, Adoption::class,'animal_id','adoption_id');
    }
}
