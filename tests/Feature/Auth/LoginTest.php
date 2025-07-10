<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_the_login_form(): void
    {
        $testResponse = $this->get(route('login'));
        $testResponse->assertStatus(200);
        $testResponse->assertViewIs('auth.login');
    }

    public function test_user_can_login_with_correct_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $testResponse = $this->post(route('login.store'), [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $testResponse->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_incorrect_credentials(): void
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $testResponse = $this->from(route('login'))->post(route('login.store'), [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $testResponse->assertRedirect(route('login'));
        $testResponse->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_user_can_logout(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->actingAs($user);

        $testResponse = $this->post(route('logout'));

        $testResponse->assertRedirect('/');
        $this->assertGuest();
    }
}
