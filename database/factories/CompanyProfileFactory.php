<?php

namespace Database\Factories;

use App\Models\CompanyProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyProfileFactory extends Factory
{
    protected $model = CompanyProfile::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'company_name' => $this->faker->company,
            'bio' => $this->faker->paragraph,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'country' => $this->faker->country,
            'website' => $this->faker->url,
            'image' => null,
        ];
    }
}