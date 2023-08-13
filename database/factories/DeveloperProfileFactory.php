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
        $australianStates = [
            'New South Wales',
            'Victoria',
            'Queensland',
            'South Australia',
            'Western Australia',
            'Tasmania',
            'Northern Territory',
            'Australian Capital Territory'
        ];

        $cityToStateMapping = [
            'Sydney' => 'New South Wales',
            'Melbourne' => 'Victoria',
            'Brisbane' => 'Queensland',
            'Adelaide' => 'South Australia',
            'Perth' => 'Western Australia',
            'Hobart' => 'Tasmania',
            'Darwin' => 'Northern Territory',
            'Canberra' => 'Australian Capital Territory'
        ];

        $randomCity = $this->faker->randomElement(array_keys($cityToStateMapping));
        $correspondingState = $cityToStateMapping[$randomCity];

        return [
            'hero' => $this->faker->sentence,
            'city' => $randomCity,
            'state' => $correspondingState,
            'country' => 'Australia',
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
