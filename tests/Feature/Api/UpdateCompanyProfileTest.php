<?php

namespace Tests\Feature\Api;

use App\Models\CompanyProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateCompanyProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_update_company_profile(): void
    {
        Storage::fake('s3');

        $user = User::factory()->create(['name' => 'Old Staff']);
        CompanyProfile::factory()->create([
            'user_id' => $user->id,
            'company_name' => 'Old Company',
            'bio' => 'Old bio',
            'staff_role' => 'Old Role',
            'website' => 'https://old.com',
            'email_notifications' => false,
        ]);

        $payload = [
            'staff_name' => 'Updated Staff',
            'staff_role' => 'Updated Role',
            'company_name' => 'Updated Company',
            'bio' => 'New bio',
            'website' => 'https://updated.com',
            'email_notifications' => true,
        ];

        $testResponse = $this->actingAs($user)->putJson('/company-profiles/'.$user->id, $payload);

        $testResponse->assertStatus(302);

        $this->assertDatabaseHas('company_profiles', [
            'user_id' => $user->id,
            'company_name' => 'Updated Company',
            'bio' => 'New bio',
            'staff_role' => 'Updated Role',
            'website' => 'https://updated.com',
            'email_notifications' => true,
        ]);

        $user->refresh();
        $this->assertEquals('Updated Staff', $user->name);
    }

    public function test_cannot_update_someone_elses_company_profile(): void
    {
        $user = User::factory()->create(['name' => 'User']);
        $otherUser = User::factory()->create(['name' => 'Other Staff']);
        CompanyProfile::factory()->create([
            'user_id' => $otherUser->id,
            'company_name' => 'Other Company',
            'staff_role' => 'Other Role',
        ]);

        $testResponse = $this->actingAs($user)->putJson('/company-profiles/'.$otherUser->id, [
            'company_name' => 'Hacked Company',
            'staff_name' => 'Hacker',
        ]);

        $testResponse->assertStatus(302);
        $testResponse->assertSessionHas('error', 'You are not authorized to update this profile.');

        $this->assertDatabaseHas('company_profiles', [
            'user_id' => $otherUser->id,
            'company_name' => 'Other Company',
            'staff_role' => 'Other Role',
        ]);
        $otherUser->refresh();
        $this->assertEquals('Other Staff', $otherUser->name);
    }

    public function test_validation_errors_are_returned_for_invalid_data(): void
    {
        $user = User::factory()->create(['name' => 'Staff']);
        CompanyProfile::factory()->create(['user_id' => $user->id]);

        $payload = [
            'company_name' => str_repeat('a', 300),
            'staff_name' => '',
            'staff_role' => '',
            'bio' => str_repeat('b', 2000),
            'email_notifications' => 'not-a-boolean',
        ];

        $testResponse = $this->actingAs($user)->putJson('/company-profiles/'.$user->id, $payload);

        $testResponse->assertStatus(422);
        $testResponse->assertJsonValidationErrors([
            'company_name', 'staff_name', 'staff_role', 'bio', 'email_notifications',
        ]);
    }

    public function test_unauthenticated_user_cannot_update_company_profile(): void
    {
        $user = User::factory()->create(['name' => 'Staff']);
        CompanyProfile::factory()->create(['user_id' => $user->id]);

        $payload = ['company_name' => 'Unauthenticated update'];

        $testResponse = $this->putJson('/company-profiles/'.$user->id, $payload);

        $testResponse->assertStatus(401);
    }

    public function test_partial_update_does_not_clear_unspecified_fields(): void
    {
        $user = User::factory()->create(['name' => 'Keep Staff']);

        /** @var CompanyProfile $profile */
        $profile = CompanyProfile::factory()->create([
            'user_id' => $user->id,
            'bio' => 'Bio',
            'company_name' => 'Keep Company',
            'staff_role' => 'Keep Role',
        ]);

        $payload = [
            'bio' => 'Updated bio',
            'staff_name' => 'Updated Staff',
        ];

        $testResponse = $this->actingAs($user)->putJson('/company-profiles/'.$user->id, $payload);

        $testResponse->assertStatus(302);

        $profile->refresh();
        $this->assertEquals('Updated bio', $profile->bio);
        $this->assertEquals('Keep Company', $profile->company_name);
        $this->assertEquals('Keep Role', $profile->staff_role);
        $user->refresh();
        $this->assertEquals('Updated Staff', $user->name);
    }
}
