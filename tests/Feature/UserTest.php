<?php

namespace Tests\Feature;

use App\Models\User;
use App\User\enums\userType;
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
        //prepare
        $payload = [
            'name' => fake()->name(),
            'email' => 'fe@gmail.com',
            'password' => fake()->password(8),
            'phone_number' => '15996925812',
            'address' => fake()->address(),
            'user_type' => userType::admin
        ];
        //action
        $response = $this->post('api/register', $payload);
        //response
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
    }

    public function test_user_can_sign_in()
    {
        $user = User::factory()->create([
            'email' => 'fe@gmail.com',
            'password' => '123456789',
            'phone_number' => '15996925812',
            'user_type' => userType::admin
        ])->first();

        $payload = [
         'email' => $user->email,
         'password' => '123456789',
        ];
        $response = $this->post('api/login', $payload);
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
