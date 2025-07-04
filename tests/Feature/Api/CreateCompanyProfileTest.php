<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use App\Models\User;

class CreateCompanyProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_company_profile(): void
    {
        // Set the queue driver to 'sync' so jobs run immediately
        config(['queue.default' => 'sync']);

        $user = User::factory()->create();

        $payload = [
            'company_name' => 'Test Company',
            'website' => 'https://testcompany.com',
            'staff_name' => 'Jane Doe',
            'staff_role' => 'HR Manager',
            'bio' => 'We build amazing stuff.',
            'email_notifications' => true,
        ];

        $testResponse = $this->actingAs($user)->postJson('/new-company', $payload);

        $testResponse->assertStatus(302);

        $this->assertDatabaseHas('company_profiles', [
            'user_id' => $user->id,
            'company_name' => 'Test Company',
            'website' => 'https://testcompany.com',
            'staff_role' => 'HR Manager',
            'bio' => 'We build amazing stuff.',
            'email_notifications' => true
         ]);
    }

    public function test_guest_cannot_create_company_profile(): void
    {
        $payload = [
            'company_name' => 'Test Company',
            'website' => 'https://testcompany.com',
            'staff_name' => 'Jane Doe',
            'staff_role' => 'HR Manager',
            'bio' => 'We build amazing stuff.',
        ];

        $testResponse = $this->postJson('/new-company', $payload);

        $testResponse->assertStatus(401);
    }

    public function test_cannot_create_duplicate_company_profile(): void
    {
        config(['queue.default' => 'sync']);

        $user = User::factory()->create();

        $payload = [
            'company_name' => 'Test Company',
            'website' => 'https://testcompany.com',
            'staff_name' => 'Jane Doe',
            'staff_role' => 'HR Manager',
            'bio' => 'We build amazing stuff.',
        ];

        // Create profile
        $this->actingAs($user)->postJson('/new-company', $payload);

        // Attempt to create another profile
        $testResponse = $this->actingAs($user)->postJson('/new-company', $payload);

        $testResponse->assertStatus(400);
        $testResponse->assertJson(['message' => 'Company profile already exists']);
    }

    public function test_validation_error_for_missing_fields(): void
    {
        $user = User::factory()->create();

        $testResponse = $this->actingAs($user)->postJson('/new-company', []);

        $testResponse->assertStatus(422);
        $testResponse->assertJsonValidationErrors([
            'company_name', 'website', 'staff_name', 'staff_role'
        ]);
    }

    public function test_email_notifications_field_defaults_to_false_if_not_specified(): void
    {
        config(['queue.default' => 'sync']);
 
        $user = User::factory()->create();

        $payload = [
            'company_name' => 'Test Company',
            'website' => 'https://testcompany.com',
            'staff_name' => 'Jane Doe',
            'staff_role' => 'HR Manager',
            'bio' => 'We build amazing stuff.',
            // 'email_notifications' is omitted
        ];

        $this->actingAs($user)->postJson('/new-company', $payload);

        $this->assertDatabaseHas('company_profiles', [
            'user_id' => $user->id,
            'company_name' => 'Test Company',
            'email_notifications' => false,
        ]);
    }

    public function test_staff_name_is_saved_to_user_name(): void
    {
        config(['queue.default' => 'sync']);

        $user = User::factory()->create([
            'name' => 'Original Name'
        ]);

        $payload = [
            'company_name' => 'Test Company',
            'website' => 'https://testcompany.com',
            'staff_name' => 'Updated Staff Name',
            'staff_role' => 'HR Manager',
            'bio' => 'We build amazing stuff.',
        ];

        $this->actingAs($user)->postJson('/new-company', $payload);

        $user->refresh();
        
        $this->assertEquals('Updated Staff Name', $user->name);
    }
}
