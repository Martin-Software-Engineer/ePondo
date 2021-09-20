<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\Campaign;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $photo = new Photo();
        $photo -> filename = 'piJd6a3QdCc0XH6lKva4JmgHQX7GWYWuFYk908Bt.png' ;
        $photo -> url = '/storage/campaign/piJd6a3QdCc0XH6lKva4JmgHQX7GWYWuFYk908Bt.png' ;
        $photo -> save();

        $photo = new Photo();
        $photo -> filename = 'PjuS8kpQSpNtY0eWwSJdUPZRu7Jzr0bs3Eevrbzg.png' ;
        $photo -> url = '/storage/campaign/PjuS8kpQSpNtY0eWwSJdUPZRu7Jzr0bs3Eevrbzg.png' ;
        $photo -> save();

        $photo = new Photo();
        $photo -> filename = 'sbwxF06sqsl9TRmy22dcHYvITMwKAOKtJ0mXoOsR.webp' ;
        $photo -> url = '/storage/job/sbwxF06sqsl9TRmy22dcHYvITMwKAOKtJ0mXoOsR.webp' ;
        $photo -> save();

        $photo = new Photo();
        $photo -> filename = 'xQDzCLjjQSnMeDTOGtY7Iy2YDQtEQtrJm0PmEbx7.jpeg' ;
        $photo -> url = '/storage/job/xQDzCLjjQSnMeDTOGtY7Iy2YDQtEQtrJm0PmEbx7.jpeg' ;
        $photo -> save();

    }
}
