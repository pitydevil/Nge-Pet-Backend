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
            'pet_hotel_name' => 'Amore Pet Hotel',
            'pet_hotel_description' => 'Kami telah beroperasi selama 9 tahun berturut-turut',
            'pet_hotel_longitude' => 6.1271137,
            'pet_hotel_latitude' => 106.6512708,
            'pet_hotel_address' => 'Jalan Ayani no. 15',
            'pet_hotel_kelurahan' => 'Kelurahan Suka Maju',
            'pet_hotel_kecamatan' => 'Kecamatan Suka Makan',
            'pet_hotel_kota' => 'Sukabumi',
            'pet_hotel_provinsi' => 'Jawa Barat',
            'pet_hotel_pos' => 12123,
        ]);
        PetHotel::create([
            'pet_hotel_id' => 2,
            'pet_hotel_name' => 'Amore Pet Hotel 2',
            'pet_hotel_description' => 'Kami telah beroperasi selama 9 tahun berturut-turut',
            'pet_hotel_longitude' => 15.2351252,
            'pet_hotel_latitude' => 12.1325135,
            'pet_hotel_address' => 'Jalan Ayani no. 16',
            'pet_hotel_kelurahan' => 'Kelurahan Suka Maju',
            'pet_hotel_kecamatan' => 'Kecamatan Suka Makan',
            'pet_hotel_kota' => 'Sukabumi',
            'pet_hotel_provinsi' => 'Jawa Barat',
            'pet_hotel_pos' => 12124,
        ]);
        PetHotel::create([
            'pet_hotel_id' => 3,
            'pet_hotel_name' => 'Amore Pet Hotel 3',
            'pet_hotel_description' => 'Kami telah beroperasi selama 9 tahun berturut-turut',
            'pet_hotel_longitude' => 15.2351255,
            'pet_hotel_latitude' => 102.1325135,
            'pet_hotel_address' => 'Jalan Ayani no. 16',
            'pet_hotel_kelurahan' => 'Kelurahan Suka Maju',
            'pet_hotel_kecamatan' => 'Kecamatan Suka Makan',
            'pet_hotel_kota' => 'Sukabumi',
            'pet_hotel_provinsi' => 'Jawa Barat',
            'pet_hotel_pos' => 12124,
        ]);
    }
}
