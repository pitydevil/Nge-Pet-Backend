<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SOPGeneral;

class SopGeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SOPGeneral::create([
            'sop_generals_description' => 'Asuransi untuk semua!', 
            'sop_generals_asuransi' => 'Hewan dijamin memiliki perlindungan hewan selama dititipkan di tempat kami.'
        ]);

        SOPGeneral::create([
            'sop_generals_description' => 'Makanan yang jelas!', 
            'sop_generals_asuransi' => 'Hewan dijamin memiliki kejelassan tempat tinggal dan makanan di tempat kami.'
        ]);
    }
}
