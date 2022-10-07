<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CancelSOP;

class CancelSopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CancelSOP::create([
            'cancel_sops_description' => 'Uang anda dijamin balik saat anda melakukan pembatalan dalam h-24jam.'
        ]);
        CancelSOP::create([
            'cancel_sops_description' => 'Anda tidak akan mendapatkan denda saat melakukan pembatalan.'
        ]);
        CancelSOP::create([
            'cancel_sops_description' => 'Jaminan uang kembali dan proses transaksi yang cepat.'
        ]);
    }
}
