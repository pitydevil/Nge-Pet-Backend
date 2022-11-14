<?php

namespace Database\Seeders;

use App\Models\PetHotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetHotelSeeder extends Seeder
{
    public function run()
    {
        PetHotel::create([
            'pet_hotel_id' => 1,
            'pet_hotel_name' => 'Katze Nesia Cat Hotel',
            'pet_hotel_description' => 'Penitipan Kucing di Katze Nesia Cat House merupakan layanan penitipan kucing terbaik. Mempunyai pengalaman sejak tahun 2015 dan menjadi tempat penitipan kucing terpercaya dan terekomendasi.',
            'pet_hotel_longitude' => -6.24642,
            'pet_hotel_latitude' => 107.021243,
            'pet_hotel_address' => 'Jalan Ampera 102.D ruko no 4',
            'pet_hotel_kelurahan' => 'Kelurahan Duren Jaya Kecamatan Bekasi Timur',
            'pet_hotel_kecamatan' => 'Kecamatan Rawalumbu',
            'pet_hotel_kota' => 'Bekasi',
            'pet_hotel_provinsi' => 'Jawa Barat',
            'pet_hotel_pos' => 17111,
            'owner_id'      => 1
        ]);
    }
}
