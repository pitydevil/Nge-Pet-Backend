<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\SupportedPet;

class SupportedPetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SupportedPet::create([
            'supported_pet_name'=> 'Pang Pang',
            'supported_pet_type_id' => 1,
            'pet_hotel_id' => 1
        ]);
        SupportedPet::create([
            'supported_pet_name'=> 'Pong Pong',
            'supported_pet_type_id' => 2,
            'pet_hotel_id' => 1
        ]);
    }
}
