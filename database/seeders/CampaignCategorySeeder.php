<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaign_categories')->insert([
            'name' => 'Education',
            'description' => 'Education funds ex. tuition, allowance, supplies',
        ]);

        DB::table('campaign_categories')->insert([
            'name' => 'Food',
            'description' => 'Food to provide energy and nourishment',
        ]);

        DB::table('campaign_categories')->insert([
            'name' => 'Electrical Bill',
            'description' => 'Electrical Bill payment to provide electricity to the home',
        ]);

        DB::table('campaign_categories')->insert([
            'name' => 'Water Bill',
            'description' => 'Water Bill payment to provide water to the home',
        ]);
    }
}
