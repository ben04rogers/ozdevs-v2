<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateDeveloperProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_developer_profile(): void
    {
        $user = User::factory()->create();

        $testResponse = $this->actingAs($user)->postJson('/new-developer', [
            'name' => 'Test User',
            'hero' => 'Software Engineer',
            'bio' => 'Test bio',
            'city' => 'Sydney',
            'state' => 'New South Wales',
            'country' => 'Australia',
            'search_status' => 'actively looking',
            'role_level' => 'junior',
            'part_time' => true,
            'full_time' => true,
            'contract' => false,
        ]);

        $testResponse->assertStatus(302);

        $this->assertDatabaseHas('developer_profiles', [
            'user_id' => $user->id,
            'hero' => 'Software Engineer',
            'bio' => 'Test bio',
            'city' => 'Sydney',
            'state' => 'New South Wales',
            'country' => 'Australia',
            'search_status' => 'actively looking',
            'role_level' => 'junior',
            'part_time' => true,
            'full_time' => true,
            'contract' => false,
        ]);
    }

    public function test_guest_cannot_create_developer_profile(): void
    {
        $testResponse = $this->postJson('/new-developer', []);

        $testResponse->assertStatus(401);
    }

    public function test_validation_error_for_missing_fields(): void
    {
        $user = User::factory()->create();

        $testResponse = $this->actingAs($user)->postJson('/new-developer', []);

        $testResponse->assertStatus(422);

        $testResponse->assertJsonValidationErrors(['name', 'hero', 'state', 'country']);
    }

    public function test_user_cannot_create_multiple_developer_profiles(): void
    {
        $user = User::factory()->create();

        $payload = [
            'name' => 'Test User',
            'hero' => 'Software Engineer',
            'bio' => 'Test bio',
            'city' => 'Sydney',
            'state' => 'New South Wales',
            'country' => 'Australia',
            'search_status' => 'actively looking',
            'role_level' => 'junior',
            'part_time' => true,
            'full_time' => true,
            'contract' => false,
        ];

        // Create the first profile
        $this->actingAs($user)->postJson('/new-developer', $payload);

        // Attempt to create a second profile
        $testResponse = $this->actingAs($user)->postJson('/new-developer', $payload);

        $testResponse->assertStatus(400);
        $testResponse->assertJson([
            'message' => 'Developer profile already exists',
        ]);
    }
}
