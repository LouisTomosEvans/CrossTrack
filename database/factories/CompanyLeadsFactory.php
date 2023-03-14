<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CompanyLeads;
use App\Models\Website;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyLeads>
 */
class CompanyLeadsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // company name
            'name' => $this->faker->company(),
            // company size
            'size' => rand(1, 1000),
            // company industry
            'industry' => $this->faker->company(),
            // company website
            'domain' => $this->faker->domainName(),
            // company phone
            'phone' => $this->faker->phoneNumber(),
            // company email
            'email' => $this->faker->unique()->safeEmail(),
            // company address
            'address' => $this->faker->streetAddress(),
            // company city
            'city' => $this->faker->city(),
            // company state
            'state' => $this->faker->state(),
            // company zip
            'zip' => $this->faker->postcode(),
            // company country
            'country' => $this->faker->country(),
            // company description
            'description' => $this->faker->text(),
            // company logo
            'logo' => $this->faker->imageUrl(),
            // company facebook url
            'facebook_url' => 'www.facebook.com/' . $this->faker->uuid(),
            // company twitter url
            'twitter_url' => 'www.twitter.com/' . $this->faker->uuid(),
            // company linkedin url
            'linkedin_url' => 'www.linkedin.com/' . $this->faker->uuid(),
            // company instagram url
            'instagram_url' => 'www.instagram.com/' . $this->faker->uuid(),
            // company youtube url
            'youtube_url' => 'www.youtube.com/' . $this->faker->uuid(),
            // company tiktok url
            'tiktok_url' => 'www.tiktok.com/' . $this->faker->uuid(),
            // company longitude
            'longitude' => $this->faker->latitude(),
            // company latitude
            'latitude' => $this->faker->longitude(), 
            // website id
            'website_id' => rand(1, 50),
        ];
    }
}
