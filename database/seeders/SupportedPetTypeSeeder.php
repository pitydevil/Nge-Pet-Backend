<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SupportedPetType;

class SupportedPetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SupportedPetType::create([
            'supported_pet_type_short_size'=> 'S',
            'supported_pet_type_size'=> 'Kecil',
            'supported_pet_id' => 1
        ]);
        SupportedPetType::create([
            'supported_pet_type_short_size'=> 'M',
            'supported_pet_type_size'=> 'Sedang',
            'supported_pet_id' => 1
        ]);
        SupportedPetType::create([
            'supported_pet_type_short_size'=> 'L',
            'supported_pet_type_size'=> 'Besar',
            'supported_pet_id' => 1
        ]);
        SupportedPetType::create([
            'supported_pet_type_short_size'=> 'M',
            'supported_pet_type_size'=> 'Sedang',
            'supported_pet_id' => 2
        ]);
        SupportedPetType::create([
            'supported_pet_type_short_size'=> 'L',
            'supported_pet_type_size'=> 'Besar',
            'supported_pet_id' => 2
        ]);
        SupportedPetType::create([
            'supported_pet_type_short_size'=> 'S',
            'supported_pet_type_size'=> 'Kecil',
            'supported_pet_id' => 3
        ]);
        SupportedPetType::create([
            'supported_pet_type_short_size'=> 'S',
            'supported_pet_type_size'=> 'Kecil',
            'supported_pet_id' => 4
        ]);
    }
}
