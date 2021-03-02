<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => 'Rey Martin',
        //     'email' => 'remorrey24@gmail.com',
        //     'password' => Hash::make('password'),
        // ]);
        $AdminRey = User::create([
            'name' => 'Rey',
            'email' =>'remorrey24@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12341234'),
            'remember_token' => Str::random(10),   
        ]);
        
        $AdminNicole = User::create([
            'name' => 'Nicole',
            'email' =>'n@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12341234'),
            'remember_token' => Str::random(10),     
        ]);

        $AdminPat = User::create([
            'name' => 'Pat',
            'email' =>'p@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12341234'),
            'remember_token' => Str::random(10),   
        ]);

            // 'name' => $this->faker->name,
            // 'email' => $this->faker->unique()->safeEmail,
            // 'email_verified_at' => now(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // 'remember_token' => Str::random(10),
        
        // $roles = Role::where('id',[1])->get();
        $AdminRey->roles()->attach(1);
        $AdminNicole->roles()->attach(2);
        $AdminPat->roles()->attach(3);

        // $AdminRey->attach($roles->random(1)->pluck('id'));
        // $AdminNicole->attach($roles->random(1)->pluck('id'));
        // $AdminPat->attach($roles->random(1)->pluck('id'));

        // $roles = Role::where('id',[1])->get();

        // User::whereIn('email',['r@gmail.com','n@gmail.com','p@gmail.com'])->each( function ($user) use ($roles){
        //     $user->roles()->attach($roles->random(1)->pluck('id'));
        // });
    }
}
