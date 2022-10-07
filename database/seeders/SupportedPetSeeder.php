<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SupportedPetType;
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
        $supportedPetType = SupportedPetType::create([
            'supported_pet_type_name'=> 'Persian 2'
        ]);

        SupportedPet::create([
            'supported_pet_name' => 'Pang pang', 
            'supported_pet_type_id' => $supportedPetType->supported_pet_type_id
        ]);
    }
}
