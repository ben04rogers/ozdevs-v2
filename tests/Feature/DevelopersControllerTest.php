<?php

namespace Tests\Feature;

use App\Models\DeveloperProfile;
use App\Models\User;
use Tests\TestCase;

class DevelopersControllerTest extends TestCase
{
    public function test_developers_page_displays_the_correct_developers(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $user3 = User::factory()->create();

        $dev1 = DeveloperProfile::factory()->create([
            'user_id' => $user1->id,
            'search_status' => 'open',
        ]);

        $dev2 = DeveloperProfile::factory()->create([
            'user_id' => $user2->id,
            'search_status' => 'actively looking',
        ]);

        $dev3 = DeveloperProfile::factory()->create([
            'user_id' => $user3->id,
            'search_status' => 'not looking',
        ]);

        $testResponse = $this->get('/developers');

        $testResponse->assertOk()->assertViewIs('developers');

        $developers = $testResponse->viewData('developers');

        $this->assertTrue($developers->contains($dev1));
        $this->assertTrue($developers->contains($dev2));
        $this->assertFalse($developers->contains($dev3));
    }

    public function test_developer_search_is_case_insensitive_and_checks_multiple_fields(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // 'hero' field should match
        $dev1 = DeveloperProfile::factory()->create([
            'user_id' => $user1->id,
            'search_status' => 'open',
            'hero' => 'Vue.js Ninja',
        ]);

        // 'city' field should match
        $dev2 = DeveloperProfile::factory()->create([
            'user_id' => $user2->id,
            'search_status' => 'actively looking',
            'city' => 'Adelaide',
        ]);

        // Search for "vue"
        $testResponse = $this->get('/developers?search=vue');
        $testResponse->assertOk();

        $devs1 = $testResponse->viewData('developers');
        $this->assertTrue($devs1->contains($dev1));
        $this->assertFalse($devs1->contains($dev2));

        // Search for "adelaide"
        $resp2 = $this->get('/developers?search=Adelaide');
        $resp2->assertOk();

        $devs2 = $resp2->viewData('developers');

        $this->assertTrue($devs2->contains($dev2));
        $this->assertFalse($devs2->contains($dev1));
    }
}
