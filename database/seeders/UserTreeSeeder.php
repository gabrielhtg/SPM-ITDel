<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'User 1',
                'email' => 'user1@gmail.com',
                'password' => Hash::make("12345678"),
                'role' => 2,
                'online' => false,
                'username' => 'user1',
                'phone' => '082165646255',
                'created_at' => now(),
                'verified' => true,
                'profile_pict' => null
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@gmail.com',
                'password' => Hash::make("12345678"),
                'role' => 3,
                'online' => false,
                'username' => 'user2',
                'phone' => '082165646255',
                'created_at' => now(),
                'verified' => true,
                'profile_pict' => null
            ],
            [
                'name' => 'User 3',
                'email' => 'user3@gmail.com',
                'password' => Hash::make("12345678"),
                'role' => 4,
                'online' => false,
                'username' => 'user3',
                'phone' => '082165646255',
                'created_at' => now(),
                'verified' => true,
                'profile_pict' => null
            ],
            [
                'name' => 'User 4',
                'email' => 'user4@gmail.com',
                'password' => Hash::make("12345678"),
                'role' => 5,
                'online' => false,
                'username' => 'user4',
                'phone' => '082165646255',
                'created_at' => now(),
                'verified' => true,
                'profile_pict' => null
            ],
            [
                'name' => 'User 6',
                'email' => 'user6@gmail.com',
                'password' => Hash::make("12345678"),
                'role' => 7,
                'online' => false,
                'username' => 'user6',
                'phone' => '082165646255',
                'created_at' => now(),
                'verified' => true,
                'profile_pict' => null
            ],
//            [
//                'name' => 'User 7',
//                'email' => 'user7@gmail.com',
//                'password' => Hash::make("12345678"),
//                'role' => 8,
//                'online' => false,
//                'username' => 'user7',
//                'phone' => '082165646255',
//                'created_at' => now(),
//                'verified' => true,
//                'profile_pict' => null
//            ],
        ]);
    }
}
