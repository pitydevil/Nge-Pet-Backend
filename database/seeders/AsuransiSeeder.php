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
            'asuransi_id' => 1,
            'asuransi_description' => 'Hewan yang kembali dalam keadaan sakit akan memperoleh ganti rugi',
            'pet_hotel_id'=> 1,
        ]);
        Asuransi::create([
            'asuransi_id' => 2,
            'asuransi_description' => 'Contoh jaminan singkat',
            'pet_hotel_id'=> 1,
        ]);
        Asuransi::create([
            'asuransi_id' => 3,
            'asuransi_description' => 'Hewan yang kembali dalam keadaan sakit akan memperoleh ganti rugi',
            'pet_hotel_id'=> 1,
        ]);
        Asuransi::create([
            'asuransi_id' => 4,
            'asuransi_description' => 'Hewan yang kembali dalam keadaan sakit akan memperoleh ganti rugi',
            'pet_hotel_id'=> 1,
        ]);
        Asuransi::create([
            'asuransi_id' => 5,
            'asuransi_description' => 'Contoh jaminan singkat',
            'pet_hotel_id'=> 1,
        ]);
        Asuransi::create([
            'asuransi_id' => 6,
            'asuransi_description' => 'Hewan yang kembali dalam keadaan sakit akan memperoleh ganti rugi',
            'pet_hotel_id'=> 1,
        ]);

    }
}
