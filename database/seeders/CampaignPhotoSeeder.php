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
    
        $photos = Photo::all();
        Campaign::all()->each( function ($campaigns) use ($photos){
            $campaigns->photos()->attach(1);
            $campaigns->photos()->attach(2);
        });
    }
}
