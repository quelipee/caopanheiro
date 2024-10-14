<?php

namespace Tests\Feature;

use App\AdoptPet\enums\AdoptionStatus;
use App\Models\PetEntry;
use App\Models\Shelter;
use App\Models\User;
use App\User\enums\userType;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
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
            'shelter_id' => Shelter::factory()->create()->id,
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

    public function test_admin_finalization_adoption()
    {
        Sanctum::actingAs(User::factory()->create(['user_type' => userType::admin]));
        $pet = PetEntry::factory()->create([
            'name' => 'bidu',
            'status' => AdoptionStatus::PENDING->value
        ]);
        $user = User::factory()->create([
            'name' => 'felipe'
        ]);
        $user2 = User::factory()->create([
            'name' => 'joao'
        ]);
        $user->userAdoption()->attach($pet->id,[
            'id' => (string) Str::uuid(),
            'adoption_date' => Carbon::now(),
            'status' => AdoptionStatus::PENDING->value,
        ]);
        $user2->userAdoption()->attach($pet->id,[
            'id' => (string) Str::uuid(),
            'adoption_date' => Carbon::now(),
            'status' => AdoptionStatus::PENDING->value,
        ]);
        $response = $this->put('admin/adoption/' . $pet->id . '/' . $user->id .'/complete');
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
        $this->assertDatabaseHas('adoption',[
            'user_id' => $user->id,
            'status' => AdoptionStatus::ADOPTED
        ]);
        $this->assertDatabaseHas('animal',[
            'name' => 'bidu',
            'status' => AdoptionStatus::ADOPTED->value
        ]);
    }
}
