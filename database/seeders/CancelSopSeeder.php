<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\cancel_sop;
use Illuminate\Support\Facades\DB;

class CancelSopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cancel_sops')->insert([
            'cancel_sops_description' => 'Uang anda dijamin balik saat anda melakukan pembatalan dalam h-24jam.'
        ]);
        DB::table('cancel_sops')->insert([
            'cancel_sops_description' => 'Jaminan uang kembali dan proses transaksi yang cepat.'
        ]);
    }
}
