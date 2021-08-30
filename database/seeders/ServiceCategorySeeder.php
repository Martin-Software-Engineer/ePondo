<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_categories_parent')->insert([
            'name' => 'Education',
        ]);

        DB::table('service_categories')->insert([
            'name' => 'Tutor',
            'description' => 'Tutor for specific or general knowledge.',
            'parent_id' => '1',
        ]);

    }
}
