<?php

namespace Tests\Feature;

use App\Models\DeveloperProfile;
use App\Models\User;
use Tests\TestCase;

class DeveloperProfileControllerTest extends TestCase
{
    public function test_show_displays_correct_developer_profile(): void
    {
        $user = User::factory()->create();
        $devProfile = DeveloperProfile::factory()->create([
            'user_id' => $user->id,
            'search_status' => 'open',
        ]);

        $response = $this->get('/developer-profiles/'.$devProfile->id);

        $response->assertOk();
        $response->assertViewIs('developer-profile');

        $returnedProfile = $response->viewData('developerProfile');
        $this->assertEquals($devProfile->id, $returnedProfile->id);
        $this->assertEquals($devProfile->user_id, $returnedProfile->user_id);
        $this->assertEquals('open', $returnedProfile->search_status);
    }

    public function test_show_redirects_if_developer_profile_not_found(): void
    {
        $response = $this->get('/developer-profiles/99999');

        $response->assertRedirect(route('developers'));
        $response->assertSessionHas('error', 'Developer profile not found.');
    }
}
