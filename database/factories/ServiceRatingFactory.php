<?php

namespace Database\Factories;

use App\Models\ServiceRating;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
class ServiceRatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServiceRating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => Order::all()->random()->id,
            'rating' => $this->faker->numberBetween($min = 1, $max = 5),
            'feedback' => $this->faker->text,
            'from' => $this->faker->randomElement(['backer', 'jobseeker'])
        ];
    }
}
