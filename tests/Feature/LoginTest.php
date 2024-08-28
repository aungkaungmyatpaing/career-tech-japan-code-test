<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_logs_in_a_user_with_correct_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->dump();

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Login successful',
        ]);

        $data = $response->json('data');
        $this->assertArrayHasKey('token', $data);
        $this->assertNotEmpty($data['token']);

        $token = $data['token'];

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->getJson('/api/posts');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_fails_to_login_with_incorrect_password()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(500);
        // $response->assertJson([
        //     'message' => 'Email or password is incorrect',
        // ]);
    }



    /** @test */
    public function it_fails_to_login_with_non_existent_email()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(500);
        // $response->assertJson([
        //     'message' => 'User not found',
        // ]);
        $this->assertGuest();
    }


   /** @test */
    public function it_requires_an_email_and_password()
    {
        $response = $this->postJson('/api/login', []);

        $response->assertStatus(400);
        // $response->assertJsonValidationErrors(['email', 'password']);
        $this->assertGuest();
    }


    /** @test */
    public function it_fails_to_login_with_invalid_email_format()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'invalid-email',
            'password' => 'password123',
        ]);

        $response->assertStatus(400);
        // $response->assertJsonValidationErrors(['email']);
        $this->assertGuest();
    }


    /** @test */
    public function it_fails_to_login_with_password_less_than_min_length()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'short',
        ]);

        $response->assertStatus(400);
        // $response->assertJsonValidationErrors(['password']);
        $this->assertGuest();
    }
}
