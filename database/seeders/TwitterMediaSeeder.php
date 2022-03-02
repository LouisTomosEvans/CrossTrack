<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TwitterMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo ">>>>>>>>>> Seeding Twitter Media Types...\n";

        DB::table('twitter_media')->insert([
            'name' => 'media'
        ]);

        DB::table('twitter_media')->insert([
            'name' => 'images'
        ]);

        DB::table('twitter_media')->insert([
            'name' => 'native_video'
        ]);
    }
}
