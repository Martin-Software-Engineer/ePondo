<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Photo;
use Illuminate\Database\Seeder;

class CampaignPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $campaign = Campaign::all();
        // $campaign->photos()->attach(1);
        // Campaign::all()->each( function ($campaigns) use ($photos){
        //     $campaigns->photos()->attach(1);
        // });
        $photos = Photo::all();
        Campaign::all()->each( function ($campaigns) use ($photos){
            $campaigns->photos()->attach(1);
            $campaigns->photos()->attach(2);
        });
    }
}
