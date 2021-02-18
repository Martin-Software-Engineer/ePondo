<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Invoice;
use App\Models\Order;
class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => Order::all()->random()->id,
            'price' => $this->faker->randomDigit,
            'add_charges' => $this->faker->randomDigit,
            'date_due' => $this->faker->date
        ];
    }
}
