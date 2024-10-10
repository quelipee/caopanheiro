<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_register(): void
    {
        User::factory()->create([
            'name' => fake()->name(),
            'email' => 'fe@gmail.com123',
            'phone_number' => '0123456789',
            'password' => fake()->password,
            'address' => fake()->address,
        ]);
        //prepare
        $payload = [
            'name' => fake()->name(),
            'email' => 'fe@gmail.com',
            'password' => fake()->password(),
            'phone_number' => '15996925812',
            'address' => fake()->address(),
        ];
        //action
        $response = $this->post('/register', $payload);
        //response
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
    }

    public function test_user_can_sign_in()
    {
        $user = User::factory()->create([
            'email' => 'fe@gmail.com',
            'password' => '123456789',
            'phone_number' => '15996925812',
        ])->first();

        $payload = [
         'email' => $user->email,
         'password' => '123456789',
        ];
        $response = $this->post('/login', $payload);
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }

    public function test_user_signOut()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $response = $this->post('/logout');
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }
}
