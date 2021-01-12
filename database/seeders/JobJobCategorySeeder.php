<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\JobCategory;
use Illuminate\Database\Seeder;

class JobJobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job_categories = JobCategory::all();

        Job::all()->each( function ($jobs) use ($job_categories){
            $jobs->job_categories()->attach($job_categories->random(1)->pluck('id'));
        });
    }
}
