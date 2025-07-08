<?php

namespace Database\Factories;

use App\Models\CompanyProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyProfileFactory extends Factory
{
    protected $model = CompanyProfile::class;

    public function definition()
    {
        return [
            'company_name' => $this->faker->company,
            'website' => $this->faker->url,
            'staff_role' => $this->faker->jobTitle,
            'bio' => $this->faker->paragraph,
            'email_notifications' => $this->faker->boolean,
            'image' => null,
        ];
    }
}
