<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MonitoringImage;

class MonitoringImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MonitoringImage::create([
            'monitoring_image_url'=> 'url-image',
            'monitoring_id'=> 1,
        ]);
    }
}
