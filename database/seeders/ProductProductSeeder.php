<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_categories = ProductCategory::all();

        Product::all()->each( function ($products) use ($product_categories){
            $products->product_categories()->attach($product_categories->random(1)->pluck('id'));
        });
    }
}
