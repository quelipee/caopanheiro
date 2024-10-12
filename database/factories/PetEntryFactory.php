<?php

namespace Database\Factories;

use App\Models\PetEntry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PetEntry>
 */
class PetEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'species' => fake()->name(),
            'breed' => fake()->name(),
            'age' => fake()->numberBetween(1,15),
            'gender' => fake()->randomElement(['male', 'female']),
            'size' => fake()->randomElement(['small','medium','large']),
            'color' => fake()->randomElement(['red', 'green', 'blue']),
            'description' => fake()->text(),
            'status' => fake()->randomElement(['available', 'adopted']),
            'photo' => fake()->imageUrl(640, 480, 'animals', true),
        ];
    }
}
