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
            'cancel_sops_description' => 'Tidak ada pengembalian uang untuk pesanan ini.',
            'pet_hotel_id'=> 1,
        ]);
    }
}
