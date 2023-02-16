<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed the database with 5 teams
        \App\Models\Team::factory()->count(3)->hasAttached(\App\Models\User::factory()->count(15))->create();
    }
}
