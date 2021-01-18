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
        $photo -> filename = 'piJd6a3QdCc0XH6lKva4JmgHQX7GWYWuFYk908Bt.png' ;
        $photo -> url = '/storage/campaign/piJd6a3QdCc0XH6lKva4JmgHQX7GWYWuFYk908Bt.png' ;
        $photo -> save();

        $photo = new Photo();
        $photo -> filename = 'PjuS8kpQSpNtY0eWwSJdUPZRu7Jzr0bs3Eevrbzg.png' ;
        $photo -> url = '/storage/campaign/PjuS8kpQSpNtY0eWwSJdUPZRu7Jzr0bs3Eevrbzg.png' ;
        $photo -> save();

    }
}
