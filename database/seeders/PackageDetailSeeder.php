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
            'package_detail_name' => 'Memakai kandang besi ukuran 60 cm',
            'package_id' => 1,
        ]);
        PackageDetail::create([
            'package_detail_name' => 'Pakan Whiskas (Kitten/Adult)',
            'package_id' => 1,
        ]);
        PackageDetail::create([
            'package_detail_name' => 'Memakai kandang besi ukuran 75 cm',
            'package_id' => 2,
        ]);
        PackageDetail::create([
            'package_detail_name' => 'Pakan Whiskas atau Meo (Kitten/Adult)',
            'package_id' => 2,
        ]);
        PackageDetail::create([
            'package_detail_name' => 'Memakai kandang besi ukuran 90 cm',
            'package_id' => 3,
        ]);
        PackageDetail::create([
            'package_detail_name' => 'Pakan Proplan (Kitten/Adult)',
            'package_id' => 3,
        ]);
        PackageDetail::create([
            'package_detail_name' => 'Memakai kandang aluminium ukuran 100 cm',
            'package_id' => 4,
        ]);
        PackageDetail::create([
            'package_detail_name' => 'Pakan Royal Canin (Kitten/Adult)',
            'package_id' => 4,
        ]);
    }
}
