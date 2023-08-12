<?php

namespace Database\Factories;

use App\Models\DeveloperProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeveloperProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeveloperProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hero' => $this->faker->sentence,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'country' => $this->faker->country,
            'bio' => $this->faker->paragraph,
            'search_status' => $this->faker->randomElement(['actively looking', 'open', 'not interested', 'invisible']),
            'role_level' => $this->faker->randomElement(['junior', 'mid', 'senior', 'principal']),
            'part_time' => $this->faker->boolean,
            'full_time' => $this->faker->boolean,
            'contract' => $this->faker->boolean,
            'website' => $this->faker->url,
            'github' => $this->faker->userName,
            'twitter' => $this->faker->userName,
            'stack_overflow' => $this->faker->userName,
            'linkedin' => $this->faker->userName,
            'email_notifications' => $this->faker->boolean,
        ];
    }
}
