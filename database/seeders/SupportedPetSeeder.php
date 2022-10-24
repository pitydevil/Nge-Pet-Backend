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
            'supported_pet_name'=> 'Anjing',
            'pet_hotel_id' => 1
        ]);
        SupportedPet::create([
            'supported_pet_name'=> 'Kucing',
            'pet_hotel_id' => 1
        ]);
    }
}
