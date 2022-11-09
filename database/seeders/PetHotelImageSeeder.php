<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PetHotelImage;

class PetHotelImageSeeder extends Seeder
{
    public function run()
    {
        PetHotelImage::create([
            'pet_hotel_image_id' => 1,
            'pet_hotel_image_url'=> 'https://fluffy.umkmbedigital.com/public/katze_nesia_cat_hotel_1.png',
            'pet_hotel_id'=> 1,
        ]);
        PetHotelImage::create([
            'pet_hotel_image_id' => 2,
            'pet_hotel_image_url'=> 'https://fluffy.umkmbedigital.com/public/katze_nesia_cat_hotel_2.png',
            'pet_hotel_id'=> 1,
        ]);
    }
}
