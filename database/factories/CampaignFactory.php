<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Campaign::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'user_id' => 1,
            'title' => $this->faker->text,
            'description' => $this->faker->text($maxNbChars = 200)
        ];

        // $table->id();
        //     $table->unsignedBigInteger('user_id');
        //     $table->string('title');
        //     $table->string('description');

        // $roles = Role::whereIn('id', [2])->get();
        // User::all()->each( function ($user) use ($roles){
        //     $user->roles()->attach($roles->random(1)->pluck('id'));
        // });
        
    }
}
