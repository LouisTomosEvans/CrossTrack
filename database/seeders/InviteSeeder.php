<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InviteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Invite::factory()->count(50)->create();
    }
}
