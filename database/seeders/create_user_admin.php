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
            'name' => 'User Admin',
            'email' => 'useradmin@gmail.com',
            'password' => Hash::make("user_admin"),
            'role' => 1,
            'created_at' => now()
        ]);

        require_once 'vendor/autoload.php';

        $faker = Factory::create();

        foreach (range(1, 1000) as $index) {
            try {
                DB::table('users')->insert([
                    'name' => $faker->name(),
                    'email' => $faker->email(),
                    'password' => Hash::make('kelompok1hore'),
                    'role' => rand(1, 4),
                    'created_at' => now()
                ]);
            } catch (UniqueConstraintViolationException $e) {
                // do nothin
            }
        }
    }
}
