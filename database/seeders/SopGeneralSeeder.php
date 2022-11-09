<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SOPGeneral;

class SopGeneralSeeder extends Seeder
{
    public function run()
    {
        SOPGeneral::create([
            'sop_generals_description' => 'Charge dihitung per hari',
            'pet_hotel_id' => 1,
        ]);

        SOPGeneral::create([
            'sop_generals_description' => 'Fasilitas tambahan akan dikenakan biaya tambahan',
            'pet_hotel_id' => 1,
        ]);

        SOPGeneral::create([
            'sop_generals_description' => 'Kucing dengan kondisi kesehatan tertentu akan dipisahkan',
            'pet_hotel_id' => 1,
        ]);

        SOPGeneral::create([
            'sop_generals_description' => 'Charge dihitung per hari',
            'pet_hotel_id' => 1,
        ]);

        SOPGeneral::create([
            'sop_generals_description' => 'Fasilitas tambahan akan dikenakan biaya tambahan',
            'pet_hotel_id' => 1,
        ]);

        SOPGeneral::create([
            'sop_generals_description' => 'Kucing dengan kondisi kesehatan tertentu akan dipisahkan',
            'pet_hotel_id' => 1,
        ]);
    }
}
