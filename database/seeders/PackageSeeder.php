<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run()
    {
        Package::create([
            'package_name' => 'Basic',
            'package_price' => 60000,
            'pet_hotel_id' => 1,
            'supported_pet_id' => 1,
        ]);

        Package::create([
            'package_name' => 'Plus',
            'package_price' => 70000,
            'pet_hotel_id' => 1,
            'supported_pet_id' => 1,
        ]);

        Package::create([
            'package_name' => 'Premium',
            'package_price' => 80000,
            'pet_hotel_id' => 1,
            'supported_pet_id' => 1,
        ]);

        Package::create([
            'package_name' => 'Exclusive',
            'package_price' => 1250000,
            'pet_hotel_id' => 1,
            'supported_pet_id' => 1,
        ]);
    }
}
