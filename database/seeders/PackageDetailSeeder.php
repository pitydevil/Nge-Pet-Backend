<?php

namespace Database\Seeders;

use App\Models\PackageDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageDetailSeeder extends Seeder
{
    public function run()
    {
        PackageDetail::create([
            'package_detail_name' => 'Premium biasa',
            'package_id' => 1,
        ]);
        PackageDetail::create([
            'package_detail_name' => 'Premium luar biasa',
            'package_id' => 1,
        ]);
        PackageDetail::create([
            'package_detail_name' => 'Premium',
            'package_id' => 2,
        ]);
    }
}
