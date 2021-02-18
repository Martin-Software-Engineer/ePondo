<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory()->times(20)->create();
    }
}
