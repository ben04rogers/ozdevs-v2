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

    public function test_authenticated_user_can_update_developer_profile(): void
    {
        Storage::fake('s3');

        $user = User::factory()->create();
        DeveloperProfile::factory()->create([
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

        $testResponse = $this->actingAs($user)->putJson('/developer-profiles/' . $user->id, $payload);

        $testResponse->assertStatus(302);

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

    public function test_cannot_update_someone_elses_profile(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        DeveloperProfile::factory()->create([
            'user_id' => $otherUser->id,
            'hero' => 'Other Hero',
        ]);


        $testResponse = $this->actingAs($user)->putJson('/developer-profiles/' . $otherUser->id, [
            'hero' => 'Hacked Hero',
        ]);

        $testResponse->assertStatus(302);

        $testResponse->assertSessionHas('error', 'You are not authorized to update this profile.');

        $this->assertDatabaseHas('developer_profiles', [
            'user_id' => $otherUser->id,
            'hero' => 'Other Hero',
        ]);
    }

    public function test_validation_errors_are_returned_for_invalid_data(): void
    {
        $user = User::factory()->create();
        DeveloperProfile::factory()->create(['user_id' => $user->id]);

        $payload = [
            'state' => 'InvalidStateName',
            'country' => 'NotAustralia',
            'role_level' => 'superhero',
        ];

        $testResponse = $this->actingAs($user)->putJson('/developer-profiles/' . $user->id, $payload);

        $testResponse->assertStatus(422);
        $testResponse->assertJsonValidationErrors(['state', 'country', 'role_level']);
    }

    public function test_unauthenticated_user_cannot_update_profile(): void
    {
        $user = User::factory()->create();
        DeveloperProfile::factory()->create(['user_id' => $user->id]);

        $payload = ['hero' => 'Unauthenticated update'];

        $testResponse = $this->putJson('/developer-profiles/' . $user->id, $payload);

        $testResponse->assertStatus(401);
    }

    public function test_partial_update_does_not_clear_unspecified_fields(): void
    {
        $user = User::factory()->create();
        $profile = DeveloperProfile::factory()->create([
            'user_id' => $user->id,
            'bio' => 'Bio',
            'city' => 'Melbourne',
        ]);

        $payload = [
            'bio' => 'Updated bio',
        ];

        $testResponse = $this->actingAs($user)->putJson('/developer-profiles/' . $user->id, $payload);

        $testResponse->assertStatus(302);

        $profile->refresh();
        $this->assertEquals('Updated bio', $profile->bio);
        $this->assertEquals('Melbourne', $profile->city);
    }
}