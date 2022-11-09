<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\SupportedPet;

class SupportedPetSeeder extends Seeder
{
    public function run()
    {
        SupportedPet::create([
            'supported_pet_id' => 1,
            'supported_pet_name'=> 'Kucing',
            'pet_hotel_id' => 1
        ]);
    }
}
