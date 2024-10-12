<?php

namespace Tests\Feature;

use App\Models\PetEntry;
use App\Models\User;
use App\User\enums\userType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class PetManagementTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_animal_entry(): void
    {
        $payload = [
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

        $user = User::factory()->create([
            'user_type' => userType::admin
        ])->first();
        Sanctum::actingAs($user);
        $response = $this->post('/animals', $payload);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
        $this->assertDatabaseHas('animal',$payload);
    }
    public function test_animals_available_for_adoption()
    {
        PetEntry::factory(10)->create();
        Sanctum::actingAs(User::factory()->create());
        $response = $this->get('/animals');
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }

    public function test_admin_accesses_all_pets_collection()
    {
        PetEntry::factory(10)->create();
        Sanctum::actingAs(User::factory()->create(['user_type' => userType::admin]));
        $response = $this->get('admin/animals');
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }
}
