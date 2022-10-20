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
        Monitoring::create([
            'monitoring_activity' => 'Anjingnya sedang Makan lagi',
            'order_detail_id' => 1,
        ]);
    }
}
