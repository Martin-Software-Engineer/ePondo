<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\Job;
use Illuminate\Database\Seeder;

class JobPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $photos = Photo::all();
        Job::all()->each( function ($campaigns) use ($photos){
            $campaigns->photos()->attach(1);
            $campaigns->photos()->attach(2);
        });
    }
}
