<?php

namespace Database\Factories;

use App\Models\UserInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserInformationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserInformation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fistname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName
        ];
    }
}
