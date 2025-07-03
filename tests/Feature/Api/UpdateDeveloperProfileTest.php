<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\DeveloperProfile;

class UpdateDeveloperProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_update_developer_profile()
    {
        Storage::fake('s3');

        $user = User::factory()->create();
        $profile = DeveloperProfile::factory()->create([
            'user_id' => $user->id,
            'hero' => 'Old Hero',
            'bio' => 'Old bio',
        ]);

        $payload = [
            'name' => 'Updated Name',
            'hero' => 'New Hero',
            'bio' => 'New bio',
            'city' => 'Sydney',
            'state' => 'New South Wales',
            'country' => 'Australia',
            'search_status' => 'actively looking',
            'role_level' => 'senior',
            'part_time' => false,
            'full_time' => true,
            'contract' => true,
        ];

        $response = $this->actingAs($user)->putJson("/developer-profiles/{$user->id}", $payload);

        $response->assertStatus(302);

        $this->assertDatabaseHas('developer_profiles', [
            'user_id' => $user->id,
            'hero' => 'New Hero',
            'bio' => 'New bio',
            'city' => 'Sydney',
            'state' => 'New South Wales',
            'country' => 'Australia',
            'search_status' => 'actively looking',
            'role_level' => 'senior',
            'part_time' => false,
            'full_time' => true,
            'contract' => true,
        ]);

        $user->refresh();
        
        $this->assertEquals('Updated Name', $user->name);
    }

    public function test_cannot_update_someone_elses_profile()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $profile = DeveloperProfile::factory()->create([
            'user_id' => $otherUser->id,
            'hero' => 'Other Hero',
        ]);


        $response = $this->actingAs($user)->putJson("/developer-profiles/{$otherUser->id}", [
            'hero' => 'Hacked Hero',
        ]);

        $response->assertStatus(302);

        $response->assertSessionHas('error', 'You are not authorized to update this profile.');

        $this->assertDatabaseHas('developer_profiles', [
            'user_id' => $otherUser->id,
            'hero' => 'Other Hero',
        ]);
    }
}