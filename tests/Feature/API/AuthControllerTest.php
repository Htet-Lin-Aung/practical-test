<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_can_register_a_new_user()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password',
            'confirm_password' => 'password',
        ];

        $response = $this->json('POST', '/api/v1/register', $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                ],
            ]);
    }

    /** @test */
    public function it_can_login_an_existing_user()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $data = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $response = $this->json('POST', '/api/v1/login', $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                ],
                'access_token',
            ]);
    }

    /** @test */
    public function it_can_logout_an_authenticated_user()
    {
        $user = User::factory()->create();

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->actingAs($user)->json('POST', '/api/v1/logout', [], [
            'Authorization' => "Bearer $token",
        ]);

        $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'message' => 'You have successfully logged out.',
        ]);

        $this->assertEmpty($user->tokens);
    }
}