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
        $this->call(UserSeeder::class);
        $this->call(OwnerSeeder::class);
        $this->call(PetHotelSeeder::class);
        $this->call(PetHotelImageSeeder::class);
        $this->call(SupportedPetSeeder::class);
        $this->call(SupportedPetTypeSeeder::class);
        $this->call(AsuransiSeeder::class);
        $this->call(CancelSopSeeder::class);
        $this->call(FasilitasSeeder::class);
        $this->call(SopGeneralSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(PackageSeeder:: class);
        $this->call(PackageDetailSeeder:: class);
        $this->call(OrderDetailSeeder::class);
        $this->call(MonitoringSeeder::class);
        $this->call(MonitoringImageSeeder::class);
        $this->call(CustomSOPSeeder::class);
    }
}
