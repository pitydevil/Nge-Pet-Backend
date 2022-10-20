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

        Fasilitas::create([
            'fasilitas_name' => 'Kandang Anjing',
            'fasilitas_icon_url' => 'contoh-url',
            'fasilitas_status' => 'tersedia',
            'pet_hotel_id' => 1,
        ]);
        Fasilitas::create([
            'fasilitas_name' => 'Kandang Kucing',
            'fasilitas_icon_url' => 'contoh-url',
            'fasilitas_status' => 'tersedia',
            'pet_hotel_id' => 1, 
        ]);
        Fasilitas::create([
            'fasilitas_name' => 'Tempat Bermain',
            'fasilitas_icon_url' => 'contoh-url',
            'fasilitas_status' => 'tersedia',
            'pet_hotel_id' => 1, 
        ]);
    }
}
