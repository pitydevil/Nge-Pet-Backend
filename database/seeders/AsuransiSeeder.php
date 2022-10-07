<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\asuransi;

class AsuransiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        asuransi::create([ 'asuransi_id' => 1, 'asuransi_name' => 'Pertanggung jawaban pertama saat hewan anda mengalami kecelakaan.']);
        asuransi::create([ 'asuransi_id' => 2, 'asuransi_name' => 'Hewan anda dijamin memiliki kesahjeteraan yang sangat mumpuni.']);
        asuransi::create([ 'asuransi_id' => 3, 'asuransi_name' => 'Jaminan kesehatan dan tenaga ahli selama 24 jam.']);
    }
}
