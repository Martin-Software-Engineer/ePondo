<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\Campaign;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$campaign->photos()->attach($photo->id);

        // $campaign_categories = CampaignCategory::all();

        // Campaign::all()->each( function ($campaigns) use ($campaign_categories){
        //     $campaigns->campaign_categories()->attach($campaign_categories->random(1)->pluck('id'));
        // });

        // $campaign = Campaign::all();
        // $campaign->photos()->attach(2);

        // $path = Storage::disk('s3')->put('campaign',$data['image']);

        // Storage::disk('s3')->setVisibility($path, 'public');

        // // $image = Photo::create([
        // //     'filename' => basename($path),
        // //     'url' => Storage::url($path)
        // // ]);

        $photo = new Photo();
        $photo -> filename = 'i9p08P13g8U33V1IlrtuhKlMk3nMycKRlZEDfV8R.jpeg' ;
        $photo -> url = '/storage/campaign/i9p08P13g8U33V1IlrtuhKlMk3nMycKRlZEDfV8R.jpeg' ;
        $photo -> save();

    }
}
