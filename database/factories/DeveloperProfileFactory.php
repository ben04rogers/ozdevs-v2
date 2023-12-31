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

        $developerRoles = [
            'Software Engineer',
            'Web Developer',
            'Frontend Developer',
            'Backend Developer',
            'Full Stack Developer',
            'DevOps Engineer',
            'Mobile App Developer'
        ];

        $randomCity = $this->faker->randomElement(array_keys($cityToStateMapping));
        $correspondingState = $cityToStateMapping[$randomCity];
        $randomDeveloperRole = $this->faker->randomElement($developerRoles);

        // Fetch a random user data from randomuser.me API
        $response = json_decode(file_get_contents('https://randomuser.me/api/?inc=picture'));
        $profileImage = $response->results[0]->picture->large;

        return [
            'hero' => $randomDeveloperRole,
            'city' => $randomCity,
            'state' => $correspondingState,
            'country' => 'Australia',
            'bio' => $this->faker->paragraph,
            'search_status' => $this->faker->randomElement(['actively looking', 'open', 'not interested', 'invisible']),
            'role_level' => $this->faker->randomElement(['junior', 'mid', 'senior', 'principal']),
            'part_time' => $this->faker->boolean,
            'full_time' => true,
            'contract' => $this->faker->boolean,
            'website' => $this->faker->url,
            'github' => $this->faker->userName,
            'twitter' => $this->faker->userName,
            'stack_overflow' => $this->faker->userName,
            'linkedin' => $this->faker->userName,
            'email_notifications' => $this->faker->boolean,
            'image' => $profileImage,
        ];
    }
}
