<?php

namespace Database\Factories;

use App\Models\DeveloperProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'user_type' => 'developer'
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Create a new DeveloperProfile for the User.
     */
    public function hasDeveloperProfile()
    {
        return $this->afterCreating(function (User $user) {
            $user->developerProfile()->create(DeveloperProfile::factory()->make()->toArray());
        });
    }
}
