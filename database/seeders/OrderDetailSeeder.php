<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\OrderDetail;

class OrderDetailSeeder extends Seeder
{
    public function run()
    {

        // $dt = Carbon::now();
        // $dateNow = $dt->toDateTimeString();

        OrderDetail::create([
            'pet_name' => 'Dea',
            'pet_type' => 'Kucing',
            'pet_size' => 'Besar',
            'order_detail_price' => 10000,
            'order_id' => 1,
            'package_id' => 1,

        ]);

        OrderDetail::create([
            'pet_name' => 'Cita',
            'pet_type' => 'Meong',
            'pet_size' => 'Sangat Besar',
            'order_detail_price' => 10000000,
            'order_id' => 1,
            'package_id' => 1,

        ]);

        OrderDetail::create([
            'pet_name' => 'test',
            'pet_type' => 'ria',
            'pet_size' => 'asff',
            'order_detail_price' => 5000,
            'order_id' => 2,
            'package_id' => 1,

        ]);
    }
}
