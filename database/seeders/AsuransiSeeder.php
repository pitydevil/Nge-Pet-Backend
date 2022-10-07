<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\asuransi;
use Illuminate\Support\Facades\DB;

class AsuransiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('asuransis')->insert([
            'asuransi_name' => 'Pertanggung jawaban pertama saat hewan anda mengalami kecelakaan.',
        ]);
        DB::table('asuransis')->insert([
            'asuransi_name' => 'Jaminan kesehatan dan tenaga ahli selama 24 jam.',
        ]);
    }
}
