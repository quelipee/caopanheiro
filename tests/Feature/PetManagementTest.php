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
        $response = $this->post('admin/animals', $payload);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
        $this->assertDatabaseHas('animal',$payload);
    }
    public function test_admin_accesses_all_pets_collection()
    {
        PetEntry::factory(10)->create();
        Sanctum::actingAs(User::factory()->create(['user_type' => userType::admin]));
        $response = $this->get('admin/animals');
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }

    public function test_update_animal()
    {
        $petId = PetEntry::factory()->create([
            'age' => 3,
            'gender' => 'female'
        ])->first()->id;
        Sanctum::actingAs(User::factory()->create(['user_type' => userType::admin]));
        $payload = [
            'name' => 'bidu',
            'age' => 8,
            'gender' => 'male',
        ];
        $response = $this->put('admin/animals/' . $petId, $payload);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
        $this->assertDatabaseHas('animal',[
            'name' => $payload['name'],
            'age' => $payload['age'],
            'gender' => $payload['gender'],
        ]);
    }

    public function test_delete_pet_successfully()
    {
        $petId = PetEntry::factory()->create(['name' => 'bidu'])->id;
        Sanctum::actingAs(User::factory()->create(['user_type' => userType::admin]));
        $response = $this->delete('admin/animals/' . $petId);
        $response->assertStatus(ResponseAlias::HTTP_NO_CONTENT);
        $this->assertDatabaseMissing('animal',['name' => 'bidu']);
    }
}
