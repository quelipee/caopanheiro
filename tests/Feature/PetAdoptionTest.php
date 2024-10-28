<?php

namespace Tests\Feature;

use App\Models\PetEntry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class PetAdoptionTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_animals_available_for_adoption()
    {
        PetEntry::factory(10)->create();
        Sanctum::actingAs(User::factory()->create());
        $response = $this->get('api/animals');
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }

    public function test_view_animal_details()
    {
        $petId = PetEntry::factory(10)->create()->first()->id;
        Sanctum::actingAs(User::factory()->create());

        $response = $this->get('api/animals/' . $petId);
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }

    public function test_process_adoption()
    {
        $petId = PetEntry::factory()->create(['name' => 'bidu'])->id;
        $payload = [
            'housing_type' => 'Casa',
            'availability' => '5',
            'experience' => 'tenho animais em casa a muito tempo',
            'other_animals' => 'possuo outro animal de estimação',
            'reason' => 'gosto muito de cachorros',
            'animal_id' => $petId,
        ];
        Sanctum::actingAs(User::factory()->create());
        $response = $this->post('api/adoption/' . $petId, $payload);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
        $this->assertDatabaseHas('adoption_interests', [
            'housing_type' => $payload['housing_type'],
            'availability' => $payload['availability'],
            'experience' => $payload['experience'],
            'other_animals' => $payload['other_animals'],
            'reason' => $payload['reason'],
        ]);
    }

    public function test_user_can_add_animal_to_favorites()
    {
        $petId = PetEntry::factory()->create()->first()->id;
        $user = User::factory()->create();

        Sanctum::actingAs($user);
        $response = $this->post('api/favorite/' . $petId);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
    }
    public function test_user_can_remove_animal_from_favorites()
    {
        $petId = PetEntry::factory()->create()->first()->id;
        $user = User::factory()->create();

        Sanctum::actingAs($user);
        $response = $this->delete('api/favorite/'. $petId);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
    }

    public function test_user_can_view_favorite_animals()
    {
        $pets = PetEntry::factory(10)->create();
        $user = User::factory()->create();

        foreach ($pets as $pet) {
            $user->favorite()->attach($pet,[
                'id' => (string) Str::uuid()
            ]);
        }
        Sanctum::actingAs($user);
        $response = $this->get('api/favorites');
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }
    public function test_user_can_view_adoption_interests()
    {
        $petId = PetEntry::factory()->create()->first()->id;
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $response = $this->get('api/adoptions/pending');
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }
}
