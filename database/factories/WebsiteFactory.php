<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Website>
 */
class WebsiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'active' => true,
            'team_id' => rand(1, 10),
            'tracking_code' => $this->faker->uuid(),
            'tracking_status' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
