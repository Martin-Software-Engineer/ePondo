<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(AdminSeeder::class);

        $this->call(CampaignCategorySeeder::class);
        $this->call(CampaignSeeder::class);
        $this->call(CampaignCategoryCampaignSeeder::class);

        $this->call(JobSeeder::class);
        $this->call(JobCategorySeeder::class);
        $this->call(JobJobCategorySeeder::class);

        $this->call(ProductSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductProductSeeder::class);

        $this->call(PhotoSeeder::class);
        $this->call(CampaignPhotoSeeder::class);
        $this->call(JobPhotoSeeder::class);
        
    }
}
