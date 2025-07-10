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

        $response = $this->get('/developers');

        $response->assertOk()->assertViewIs('developers');

        $developers = $response->viewData('developers');

        $this->assertTrue($developers->contains($dev1));
        $this->assertTrue($developers->contains($dev2));
        $this->assertFalse($developers->contains($dev3));
    }
}
