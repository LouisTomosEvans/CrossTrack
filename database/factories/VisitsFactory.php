<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visits>
 */
class VisitsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'timestamp' => $this->faker->dateTime(),
            'visitor_id' => $this->faker->uuid(),
            'company_leads_id' => rand(1, 10),
            'referrer' => $this->faker->url(),
            'url' => $this->faker->url(),
            'title' => $this->faker->sentence(),
            'ip_address' => $this->faker->ipv4(),
            'session_duration' => rand(1, 1000),
            'query_string_params' => $this->faker->url(),
            'screen_size_width' => $this->faker->numberBetween(1, 1000),
            'screen_size_height' => $this->faker->numberBetween(1, 1000),
            'device_type' => $this->faker->randomElement(['desktop', 'mobile', 'tablet']),
            'operating_system' => $this->faker->randomElement(['windows', 'mac', 'linux']),
            'browser_version' => $this->faker->randomElement(['chrome', 'firefox', 'safari']),
        ];
    }
}
