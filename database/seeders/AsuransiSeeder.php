<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Asuransi;

class AsuransiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Asuransi::create([
            'asuransi_description' => 'Pertanggung jawaban pertama saat hewan anda mengalami kecelakaan.',
            'pet_hotel_id'=> 1,
        ]);
        Asuransi::create([
            'asuransi_description' => 'Hewan anda dijamin memiliki kesahjeteraan yang sangat mumpuni.',
            'pet_hotel_id'=> 1,
        ]);
        Asuransi::create([
            'asuransi_description' => 'Jaminan kesehatan dan tenaga ahli selama 24 jam.',
            'pet_hotel_id'=> 1,
        ]);
    }
}
