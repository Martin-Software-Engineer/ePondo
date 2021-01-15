<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
            'name' => 'Clothes',
            'description' => 'A product of clothes',
        ]);

        DB::table('product_categories')->insert([
            'name' => 'Kitchenware',
            'description' => 'A product of kitchenware',
        ]);

        DB::table('product_categories')->insert([
            'name' => 'Cleaning Tools',
            'description' => 'A product of cleaning tools',
        ]);

        DB::table('product_categories')->insert([
            'name' => 'Furniture',
            'description' => 'A product of furniture',
        ]);
    }
}
