<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SupportedPetType;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'=> 'Fitra',
            'email' => 'fitra@gmail.com',
            'password'=>'12345678'
        ]);
    }
}
