<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
