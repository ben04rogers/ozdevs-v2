<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_the_registration_form(): void
    {
        $testResponse = $this->get(route('register'));
        $testResponse->assertStatus(200);
        $testResponse->assertViewIs('auth.register');
    }

    public function test_user_can_register_with_valid_data(): void
    {
        $testResponse = $this->post(route('register.store'), [
            'user_type' => 'developer',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $testResponse->assertRedirect(route('getStarted'));

        $this->assertAuthenticated();

        $this->assertDatabaseHas('users', [
            'user_type' => 'developer',
            'email' => 'test@example.com',
            'name' => 'Test User',
        ]);
    }

    public function test_user_cannot_register_with_invalid_data(): void
    {
        $testResponse = $this->post(route('register.store'), [
            'user_type' => 'invalid_type',
            'name' => '',
            'email' => 'not-an-email',
            'password' => 'short',
            'password_confirmation' => 'mismatch',
        ]);

        $testResponse->assertSessionHasErrors(['user_type', 'name', 'email', 'password']);

        $this->assertGuest();
    }
}
