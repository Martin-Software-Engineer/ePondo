<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceRating;
class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceRating::factory()->times(20)->create();
    }
}
