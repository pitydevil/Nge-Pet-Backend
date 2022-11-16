<?php

namespace Database\Seeders;

use App\Models\Owner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Owner::create([
            'username'=> 'owner_test',
            'email' => 'owner@test.com',
            'password'=>'12345678'
        ]);
        Owner::create([
            'username'=> 'owner_test2',
            'email' => 'owner@test2.com',
            'password'=>'12345678'
        ]);
        Owner::create([
            'username'=> 'owner_test_3',
            'email' => 'owner@test3.com',
            'password'=>'12345678'
        ]);
        Owner::create([
            'username'=> 'owner_test_4',
            'email' => 'owner@test4.com',
            'password'=>'12345678'
        ]);
    }
}
