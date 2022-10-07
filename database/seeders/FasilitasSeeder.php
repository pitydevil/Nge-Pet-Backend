<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\fasilitas;
use Illuminate\Support\Facades\DB;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fasilitas')->insert([
            'fasilitas_name' => 'Kandang Anjing',
            'fasilitas_description' => 'Fasilitas kami dilengkapin dengan kandang anjing yang luas.'
        ]);
        DB::table('fasilitas')->insert([
            'fasilitas_name' => 'Kandang Kucing', 
            'fasilitas_description' => 'Fasilitas kami dilengkapin dengan kandang kucing yang luas.'
        ]);

        DB::table('fasilitas')->insert([
            'fasilitas_name' => 'Tempat Bermain', 
            'fasilitas_description' => 'Fasilitas kami dilengkapin dengan tempat bermain yang luas.'
        ]);

        
    }
}
