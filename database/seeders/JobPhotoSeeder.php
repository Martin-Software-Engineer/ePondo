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
        Job::all()->each( function ($jobs) use ($photos){
            $jobs->photos()->attach(3);
            $jobs->photos()->attach(4);
        });
    }
}
