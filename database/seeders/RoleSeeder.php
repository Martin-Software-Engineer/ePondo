<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB; //Included this use to access DB in the code

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::factory()->times(count(10))->create(); //use to call if you want to generate

        DB::table('roles')->insert([
            'name' => 'Admin'
        ]);
        DB::table('roles')->insert([
            'name' => 'JobSeeker'
        ]);
        DB::table('roles')->insert([
            'name' => 'Backer'
        ]);

        
    }
}
