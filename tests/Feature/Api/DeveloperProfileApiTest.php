<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class DeveloperProfileApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_developer_profile()
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

        $response = $this->actingAs($user)->postJson(route('newDeveloper'), $payload);

        $response->assertStatus(302);

        $this->assertDatabaseHas('developer_profiles', [
            'bio' => 'Test bio',
            'user_id' => $user->id,
        ]);
    }
}