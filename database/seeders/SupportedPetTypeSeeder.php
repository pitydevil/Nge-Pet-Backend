<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SupportedPetType;

class SupportedPetTypeSeeder extends Seeder
{
    public function run()
    {
        SupportedPetType::create([
            'supported_pet_type_id' => 1,
            'supported_pet_type_short_size'=> 'S',
            'supported_pet_type_size'=> 'Kecil',
            'supported_pet_type_description' => 'Merupakan kucing dengan berat badan di bawah 4kg. Biasanya berumur dibawah satu tahun atau merupakan ras kucing kecil seperti Munchkin dan American Curl.',
            'supported_pet_id' => 1
        ]);
        SupportedPetType::create([
            'supported_pet_type_id' => 2,
            'supported_pet_type_short_size'=> 'M',
            'supported_pet_type_size'=> 'Sedang',
            'supported_pet_type_description' => 'Merupakan kucing dengan berat badan 4 - 6kg. Kebanyakan kucing besar pada umumnya termasuk dalam kelompok ini, seperti ras Siamese dan kucing domestik.',
            'supported_pet_id' => 1
        ]);
        SupportedPetType::create([
            'supported_pet_type_id' => 3,
            'supported_pet_type_short_size'=> 'L',
            'supported_pet_type_size'=> 'Besar',
            'supported_pet_type_description' => 'Merupakan kucing dengan berat badan lebih dari 6kg. Beberapa ras yang termasuk kelompok ini adalah Savannah dan Ragdoll.',
            'supported_pet_id' => 1
        ]);
    }
}
