<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo ">>>>>>>>>> Seeding static websites...\n";

        DB::table('websites')->insert([
            'name' => 'google_maps'
        ]);

        DB::table('websites')->insert([
            'name' => 'snap_maps'
        ]);

        DB::table('websites')->insert([
            'name' => 'yandex_maps'
        ]);

        DB::table('websites')->insert([
            'name' => 'bing_maps'
        ]);

        DB::table('websites')->insert([
            'name' => 'sunCalc'
        ]);

        DB::table('websites')->insert([
            'name' => 'mapillary'
        ]);

        DB::table('websites')->insert([
            'name' => 'kartaView'
        ]);

        DB::table('websites')->insert([
            'name' => 'sentinelHub_playground'
        ]);

        DB::table('websites')->insert([
            'name' => 'wikiMapia'
        ]);

        DB::table('websites')->insert([
            'name' => 'peakVisor'
        ]);
    }
}
