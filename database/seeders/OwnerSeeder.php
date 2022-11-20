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
        Owner::create([
            'username'=> 'owner_test_5',
            'email' => 'owner@test5.com',
            'password'=>'12345678'
        ]);
        Owner::create([
            'username'=> 'owner_test_6',
            'email' => 'owner@test6.com',
            'password'=>'12345678'
        ]);
        Owner::create([
            'username'=> 'owner_test_7',
            'email' => 'owner@test7.com',
            'password'=>'12345678'
        ]);
        Owner::create([
            'username'=> 'owner_test_8',
            'email' => 'owner@test8.com',
            'password'=>'12345678'
        ]);
        Owner::create([
            'username'=> 'owner_test_9',
            'email' => 'owner@test9.com',
            'password'=>'12345678'
        ]);
        Owner::create([
            'username'=> 'owner_test_10',
            'email' => 'owner@test10.com',
            'password'=>'12345678'
        ]);
        Owner::create([
            'username'=> 'owner_test_11',
            'email' => 'owner@test11.com',
            'password'=>'12345678'
        ]);
    }
}
