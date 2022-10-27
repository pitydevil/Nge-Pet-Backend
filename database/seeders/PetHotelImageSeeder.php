<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PetHotelImage;

class PetHotelImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PetHotelImage::create([
            'pet_hotel_image_id' => 1,
            'pet_hotel_image_url'=> 'url-image-1',
            'pet_hotel_id'=> 1,
        ]);
        PetHotelImage::create([
            'pet_hotel_image_id' => 2,
            'pet_hotel_image_url'=> 'url-image-2',
            'pet_hotel_id'=> 2,
        ]);
        PetHotelImage::create([
            'pet_hotel_image_id' => 3,
            'pet_hotel_image_url'=> 'url-image-3',
            'pet_hotel_id'=> 3,
        ]);
    }
}
