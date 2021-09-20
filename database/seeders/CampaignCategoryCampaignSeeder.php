<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Illuminate\Database\Seeder;
use App\Models\CampaignCategory;

class CampaignCategoryCampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campaign_categories = CampaignCategory::all();

        Campaign::all()->each( function ($campaigns) use ($campaign_categories){
            $campaigns->campaign_categories()->attach($campaign_categories->random(1)->pluck('id'));
        });

    }
}
