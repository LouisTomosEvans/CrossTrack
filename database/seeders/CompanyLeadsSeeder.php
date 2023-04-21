<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyLeadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create company leads with lead score and visits
        \App\Models\CompanyLeads::factory()->count(10)->create()->each(function ($lead) {
            $lead->leadScore()->save(\App\Models\LeadScore::factory()->make());
            $lead->visits()->saveMany(\App\Models\Visits::factory()->count(10)->make());
            // save 
            $lead->save();
        });
    }
}
