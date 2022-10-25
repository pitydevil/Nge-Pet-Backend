<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CustomSOP;

class CustomSOPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomSOP::create([
            'custom_sop_name'=> 'Ajak main setiap 30 menit sekali',
            'order_detail_id' => 1,
            'monitoring_id' => 1,
        ]);
        CustomSOP::create([
            'custom_sop_name'=> 'Ajak main setiap 60 menit sekali',
            'order_detail_id' => 2,
            'monitoring_id' => 1,
        ]);
        CustomSOP::create([
            'custom_sop_name'=> 'Ajak main setiap 60 menit sekali',
            'order_detail_id' => 3,
            'monitoring_id' => 1,
        ]);
    }
}
