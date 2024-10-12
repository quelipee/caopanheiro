<?php

namespace Tests\Feature;

use App\Models\PetEntry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class PetAdoptionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_animals_available_for_adoption()
    {
        PetEntry::factory(10)->create();
        Sanctum::actingAs(User::factory()->create());
        $response = $this->get('/animals');
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }

    public function test_view_animal_details()
    {
        $petId = PetEntry::factory(10)->create()->first()->id;
        Sanctum::actingAs(User::factory()->create());

        $response = $this->get('/animals/' . $petId);
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }
}
