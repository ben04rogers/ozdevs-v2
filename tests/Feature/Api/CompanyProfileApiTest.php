<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use App\Models\User;

class CompanyProfileApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_company_profile()
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

        $response = $this->actingAs($user)->postJson('/new-company', $payload);

        $response->assertStatus(302);

        $this->assertDatabaseHas('company_profiles', [
            'user_id' => $user->id,
            'company_name' => 'Test Company',
            'website' => 'https://testcompany.com',
            'staff_role' => 'HR Manager',
            'bio' => 'We build amazing stuff.',
            'email_notifications' => true
         ]);
    }
}
