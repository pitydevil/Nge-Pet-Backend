<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\fasilitas;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        fasilitas::create(['fasilitas_id' => 1, 'fasilitas_name' => 'Kandang Anjing', 'fasilitas_description' => 'Fasilitas kami dilengkapin dengan kandang anjing yang luas.']);
        fasilitas::create(['fasilitas_id' => 2, 'fasilitas_name' => 'Kandang Kucing', 'fasilitas_description' => 'Fasilitas kami dilengkapin dengan kandang kucing yang luas.']);
        fasilitas::create(['fasilitas_id' => 3, 'fasilitas_name' => 'Tempat Bermain', 'fasilitas_description' => 'Fasilitas kami dilengkapin dengan tempat bermain yang luas.']);
    }
}
