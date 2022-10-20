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
    }
}
