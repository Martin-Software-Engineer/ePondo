<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reward;
use App\Models\User;

class RewardUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rewards = Reward::all();

        User::all()->each( function ($user) use ($rewards){
            $user->rewards()->attach($rewards->random(1)->pluck('id'));
        });
    }
}
