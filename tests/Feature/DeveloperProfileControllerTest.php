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

        $testResponse = $this->get('/developer-profiles/'.$devProfile->id);

        $testResponse->assertOk();
        $testResponse->assertViewIs('developer-profile');

        $returnedProfile = $testResponse->viewData('developerProfile');
        $this->assertEquals($devProfile->id, $returnedProfile->id);
        $this->assertEquals($devProfile->user_id, $returnedProfile->user_id);
        $this->assertEquals('open', $returnedProfile->search_status);
    }

    public function test_show_redirects_if_developer_profile_not_found(): void
    {
        $testResponse = $this->get('/developer-profiles/99999');

        $testResponse->assertRedirect(route('developers'));
        $testResponse->assertSessionHas('error', 'Developer profile not found.');
    }
}
