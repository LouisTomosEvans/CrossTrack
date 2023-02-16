<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InviteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 10),
            'email' => $this->faker->unique()->safeEmail(),
            'accept_token' => Str::random(32),
            'deny_token' => Str::random(32),
            'created_at' => now(),
            'updated_at' => now(),
            'team_id' => rand(1, 5),
        ];
    }
}
