<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\sop_general;
use Illuminate\Support\Facades\DB;

class SopGeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sop_generals')->insert([
            'sop_generals_description' => 'Asuransi untuk semua!', 
            'sop_generals_asuransi' => 'Hewan dijamin memiliki perlindungan hewan selama dititipkan di tempat kami.'
        ]);
        DB::table('sop_generals')->insert([
            'sop_generals_description' => 'Makanan yang jelas!', 
            'sop_generals_asuransi' => 'Hewan dijamin memiliki kejelassan tempat tinggal dan makanan di tempat kami.'
        ]);
    }
}
