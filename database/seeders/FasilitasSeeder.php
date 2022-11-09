<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fasilitas;
use Illuminate\Support\Facades\DB;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Fasilitas Status
        // 1 -> Fasilitas yang pasti didapat
        // 2 -> Fasilitas dengan kondisi dan paket tertentu ( dengan tanda *)
        Fasilitas::create([
            'fasilitas_name' => 'Antar Jemput',
            'fasilitas_icon_url' => '#',
            'fasilitas_status' => 2,
            'pet_hotel_id' => 1,
        ]);
        Fasilitas::create([
            'fasilitas_name' => 'Grooming',
            'fasilitas_icon_url' => '#',
            'fasilitas_status' => 2,
            'pet_hotel_id' => 1,
        ]);
        Fasilitas::create([
            'fasilitas_name' => 'AC dan Kipas Angin',
            'fasilitas_icon_url' => '#',
            'fasilitas_status' => 1,
            'pet_hotel_id' => 1,
        ]);
        Fasilitas::create([
            'fasilitas_name' => 'Pembersihan Kandang',
            'fasilitas_icon_url' => '#',
            'fasilitas_status' => 1,
            'pet_hotel_id' => 1,
        ]);
        Fasilitas::create([
            'fasilitas_name' => 'Pembersihan Tempat Makan',
            'fasilitas_icon_url' => '#',
            'fasilitas_status' => 1,
            'pet_hotel_id' => 1,
        ]);
        Fasilitas::create([
            'fasilitas_name' => 'Antar Jemput',
            'fasilitas_icon_url' => '#',
            'fasilitas_status' => 2,
            'pet_hotel_id' => 1,
        ]);
        Fasilitas::create([
            'fasilitas_name' => 'Grooming',
            'fasilitas_icon_url' => '#',
            'fasilitas_status' => 2,
            'pet_hotel_id' => 1,
        ]);
        Fasilitas::create([
            'fasilitas_name' => 'AC dan Kipas Angin',
            'fasilitas_icon_url' => '#',
            'fasilitas_status' => 1,
            'pet_hotel_id' => 1,
        ]);
        Fasilitas::create([
            'fasilitas_name' => 'Pembersihan Kandang',
            'fasilitas_icon_url' => '#',
            'fasilitas_status' => 1,
            'pet_hotel_id' => 1,
        ]);
        Fasilitas::create([
            'fasilitas_name' => 'Pembersihan Tempat Makan',
            'fasilitas_icon_url' => '#',
            'fasilitas_status' => 1,
            'pet_hotel_id' => 1,
        ]);
    }
}
