<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_categories')->insert([
            'name' => 'Tutor',
            'description' => 'Tutoring skills for elementary to highschool education',
        ]);

        DB::table('job_categories')->insert([
            'name' => 'Cooking',
            'description' => 'Cook/ Chef of Filipino cuisine',
        ]);

        DB::table('job_categories')->insert([
            'name' => 'Plumber',
            'description' => 'Plumbing skills anything dealing with water pipes and such a like',
        ]);

        DB::table('job_categories')->insert([
            'name' => 'Electrician',
            'description' => 'Electrician skills anything dealing with house electrical circuits',
        ]);
    }
}
