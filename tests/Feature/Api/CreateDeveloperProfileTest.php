<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;

class CreateDeveloperProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_developer_profile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/new-developer', [
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

        $response->assertStatus(302);

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

    public function test_guest_cannot_create_developer_profile()
    {
        $response = $this->postJson('/new-developer', []);

        $response->assertStatus(401);
    }

    public function test_validation_error_for_missing_fields()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/new-developer', []);

        $response->assertStatus(422);
        
        $response->assertJsonValidationErrors(['name', 'hero', 'state', 'country']);
    }

    public function test_user_cannot_create_multiple_developer_profiles()
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
        $response = $this->actingAs($user)->postJson('/new-developer', $payload);
        
        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'Developer profile already exists',
        ]);
    }
}