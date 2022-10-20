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
            'sop_generals_description' => 'Asuransi untuk semua!',
            'pet_hotel_id' => 1, 
        ]);

        SOPGeneral::create([
            'sop_generals_description' => 'Makanan yang jelas!', 
            'pet_hotel_id' => 1,
        ]);
    }
}
