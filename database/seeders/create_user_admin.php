<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class create_user_admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'User Admin',
                'email' => 'useradmin@gmail.com',
                'password' => Hash::make("admin"),
                'role' => 1,
                'status' => true,
                'online' => false,
                'username' => 'admin',
                'phone' => '082165646255',
                'created_at' => now(),
                'verified' => true,
                'profile_pict' => 'src/img/useradmin_profile.png'
            ],
            [
                'name' => 'Gabriel Cesar Hutagalung',
                'email' => 'ifs21010@students.del.ac.id',
                'username' => 'gabrielhtg',
                'phone' => '082165646255',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 1,
                'created_at' => now(),
                'profile_pict' => 'src/img/useradmin_profile.png'
            ],
        ]);

        require_once 'vendor/autoload.php';

        $faker = Factory::create();

//        foreach (range(1, 20) as $index) {
//            try {
//                DB::table('users')->insert([
//                    'name' => $faker->name(),
//                    'email' => $faker->email(),
//                    'profile_pict' => $faker->imageUrl(480,480),
//                    'password' => Hash::make('kelompok1hore'),
//                    'status' => false,
//                    'role' => rand(1, 39),
//                    'created_at' => now(),
//                    'last_login_at' => now()
//                ]);
//            } catch (UniqueConstraintViolationException $e) {
//                // do nothin
//            }
//        }
    }
}
