<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make('12341234'),   
        ]);
        
        $AdminNicole = User::create([
            'name' => 'Nicole',
            'email' =>'n@gmail.com',
            'password' => Hash::make('12341234'),   
        ]);

        $AdminPat = User::create([
            'name' => 'Pat',
            'email' =>'p@gmail.com',
            'password' => Hash::make('12341234'),   
        ]);
        
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
