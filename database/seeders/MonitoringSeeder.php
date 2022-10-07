<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MonitoringImage;
use App\Models\Monitoring;

class MonitoringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $monitoring_image_id = MonitoringImage::create([
            'monitoring_image_id' => 2,
            'monitoring_image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/Google_Images_2015_logo.svg/800px-Google_Images_2015_logo.svg.png'
        ]);

        Monitoring::create([
            'monitoring_id' => 1, 
            'monitoring_name' => 'Anjing Makan',
            'monitoring_image_id' => $monitoring_image_id->monitoring_image_id
        ]);
    }
}
