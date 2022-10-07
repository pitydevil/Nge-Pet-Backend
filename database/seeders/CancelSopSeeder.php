<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\cancel_sop;
class CancelSopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        cancel_sop::create(['cancel_sops_id' => 1, 'cancel_sops_description' => 'Uang anda dijamin balik saat anda melakukan pembatalan dalam h-24jam.']);
        cancel_sop::create(['cancel_sops_id' => 2, 'cancel_sops_description' => 'Anda tidak akan mendapatkan denda saat melakukan pembatalan.']);
        cancel_sop::create(['cancel_sops_id' => 3, 'cancel_sops_description' => 'Jaminan uang kembali dan proses transaksi yang cepat.']);
    }
}
