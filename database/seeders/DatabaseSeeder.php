<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CustomSOPSeeder::class);
        $this->call(SupportedPetTypeSeeder::class);
        $this->call(MonitoringImageSeeder::class);
        $this->call(PetHotelImageSeeder::class);
    }
}
