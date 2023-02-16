<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  run the seeders
        $this->call([
            // UserSeeder::class,
            TeamSeeder::class,
            InviteSeeder::class,
        ]);
    }
}
