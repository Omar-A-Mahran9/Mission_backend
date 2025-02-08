<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Api\RegisterRequest;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Tests\TestCase;

class AuthControllerTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_register_with_valid_data(): void
    {
        $data = [
            'name' => 'Maha Elshawardy',
            'user_name' => 'shawardy',
            'phone' => '0501234567',
            'email' => 'melshawardy@gmail.com',
            'provider' => '1',
            'password' => 'M@1234567',
            'password_confirmation' => 'M@1234567',
        ];
        $response = $this->postJson('/api/register', $data);
        $response->assertStatus(200)->assertJsonStructure([
            'message',
            'data' => [
                'token',
                'customer' => [
                    'id',
                    'name',
                    'email',
                ],
            ],
        ]);
    }

    public function test_register_with_duplicate_email(): void
    {
        User::factory()->create(['email' => 'melshawardy@gmail.com']);
        $data = [
            'name' => 'Maha Elshawardy',
            'user_name' => 'shawardy',
            'phone' => '0511234567',
            'email' => 'melshawardy@gmail.com',
            'provider' => '1',
            'password' => 'M@1234567',
            'password_confirmation' => 'M@1234567',
        ];
        $response = $this->postJson('/api/register', $data);
        $response->assertStatus(422)->assertJsonValidationErrors(['email']);
    }
    public function test_register_with_missing_fields()
    {
        $data = [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
        ];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(422); // Validation error
        $response->assertJsonValidationErrors(['name', 'email', 'password']);
    }
    public function test_register_with_password_confirmation_mismatch()
    {
        $data = [
            'name' => 'Maha Elshawardy',
            'user_name' => 'shawardy',
            'phone' => '0511234567',
            'email' => 'melshawardy@@.gmail.com',
            'provider' => '1',
            'password' => 'M@1234567',
            'password_confirmation' => 'M@12345617',
        ];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(422); // Validation error
        $response->assertJsonValidationErrors(['password_confirmation']);
    }
    public function test_register_with_missing_provider()
    {
        $data = [
            'name' => 'Maha Elshawardy',
            'user_name' => 'shawardy',
            'phone' => '0511234567',
            'email' => 'melshawardy@gmail.com',
            'provider' => 'test',
            'password' => 'M@1234567',
            'password_confirmation' => 'M@1234567',
        ];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(422)->assertJsonValidationErrors(['provider']);
    }
    public function test_register_with_invalid_name()
    {
        $data = [
            'name' => '1111',
            'user_name' => 'shawardy',
            'phone' => '0501234567',
            'email' => 'melshawardy@gmail.com',
            'provider' => '1',
            'password' => 'M@1234567',
            'password_confirmation' => 'M@1234567',
        ];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(422); // Validation error
        $response->assertJsonValidationErrors(['name']);
    }

    public function test_register_with_invalid_user_name()
    {
        $data = [
            'name' => 'Maha Elshawardy',
            'user_name' => '322',
            'phone' => '0501234567',
            'email' => 'melshawardy@gmail.com',
            'provider' => '1',
            'password' => 'M@1234567',
            'password_confirmation' => 'M@1234567',
        ];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(422)->assertJsonValidationErrors(['user_name']);
    }
    public function test_register_with_invalid_password()
    {
        $data = [
            'name' => 'Maha Elshawardy',
            'user_name' => 'shawardy',
            'phone' => '0501234567',
            'email' => 'melshawardy@gmail.com',
            'provider' => '1',
            'password' => 'M@11',
            'password_confirmation' => '11111',
        ];

        $response = $this->postJson('/api/register', $data);
        $response->assertValid(keys: ['password']);
        $response->assertJsonValidationErrors(['password', 'password_confirmation']);
    }
}