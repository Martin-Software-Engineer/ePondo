<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; //Use to include User

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->times(30)->create(); //used to generate 10 fake users
    }
}
