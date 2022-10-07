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
            'asuransi_name' => 'Pertanggung jawaban pertama saat hewan anda mengalami kecelakaan.'
        ]);
        Asuransi::create([
            'asuransi_name' => 'Hewan anda dijamin memiliki kesahjeteraan yang sangat mumpuni.'
        ]);
        Asuransi::create([
            'asuransi_name' => 'Jaminan kesehatan dan tenaga ahli selama 24 jam.'
        ]);
    }
}
