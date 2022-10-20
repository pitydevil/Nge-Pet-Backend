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
            'package_name' => 'paket 1',
            'package_price' => 40000,
            'pet_hotel_id' => 1,
            'supported_pet_id' => 1,
        ]);
    }
}
