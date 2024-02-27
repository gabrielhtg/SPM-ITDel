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
                'password' => Hash::make("user_admin"),
                'role' => 1,
                'status' => false,
                'created_at' => now(),
                'last_login_at' => now(),
                'profile_pict' => 'src/img/useradmin_profile.png'
            ],
            [
                'name' => 'Gabriel Cesar Hutagalung',
                'email' => 'ifs21010@students.del.ac.id',
                'password' => Hash::make("user_admin"),
                'status' => false,
                'role' => 1,
                'created_at' => now(),
                'last_login_at' => now(),
                'profile_pict' => 'src/img/useradmin_profile.png'
            ],
            [
                'name' => 'Rafael Manurung',
                'email' => 'ifs21028@students.del.ac.id',
                'password' => Hash::make("user_admin"),
                'role' => 1,
                'status' => false,
                'created_at' => now(),
                'last_login_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'David Gurning',
                'email' => 'ifs21001@students.del.ac.id',
                'password' => Hash::make("user_admin"),
                'role' => 1,
                'status' => false,
                'created_at' => now(),
                'last_login_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Dr. Arnaldo Marulitua Sinaga, S.T, M.InfoTech',
                'email' => 'aldo@del.ac.id',
                'password' => Hash::make("admin"),
                'role' => 1,
                'status' => false,
                'created_at' => now(),
                'last_login_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Dr. Johannes Harungguan Sianipar, S.T., M.T.',
                'email' => 'johannes@del.ac.id',
                'password' => Hash::make("admin"),
                'role' => 2,
                'status' => false,
                'created_at' => now(),
                'last_login_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Rosni Lumbantoruan, ST, M.ISD,Ph.D',
                'email' => 'rosni@del.ac.id',
                'password' => Hash::make("admin"),
                'role' => 22,
                'status' => false,
                'created_at' => now(),
                'last_login_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Humasak Tommy Argo Simanjuntak, ST, M.ISD',
                'email' => 'humasak@del.ac.id',
                'password' => Hash::make("admin"),
                'role' => 29,
                'status' => false,
                'created_at' => now(),
                'last_login_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Mariana Simanjuntak, S.S, M.Sc, M.ISD',
                'email' => 'anna@del.ac.id',
                'password' => Hash::make("admin"),
                'role' => 10,
                'status' => false,
                'created_at' => now(),
                'last_login_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Indra Hartarto Tambunan, ST., M.S.,Ph.D',
                'email' => 'indra.tambunan@del.ac.id',
                'password' => Hash::make("admin"),
                'role' => 3,
                'status' => false,
                'created_at' => now(),
                'last_login_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Riyanthi Angrainy Sianturi, S.Sos, M.Ds',
                'email' => 'riyanthi@del.ac.id',
                'password' => Hash::make("admin"),
                'role' => 3,
                'status' => false,
                'created_at' => now(),
                'last_login_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Dr. Fitriani Tupa Ronauli Silalahi, S.Si, M.Si',
                'email' => 'fitri.silalahi@del.ac.id',
                'password' => Hash::make("admin"),
                'role' => 3,
                'status' => false,
                'created_at' => now(),
                'last_login_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Arie Satia Dharma, S.T, M.Kom',
                'email' => 'ariesatia@del.ac.id',
                'password' => Hash::make("admin"),
                'role' => 7,
                'status' => false,
                'created_at' => now(),
                'last_login_at' => now(),
                'profile_pict' => null
            ],
        ]);



        require_once 'vendor/autoload.php';

        $faker = Factory::create();

        foreach (range(1, 20) as $index) {
            try {
                DB::table('users')->insert([
                    'name' => $faker->name(),
                    'email' => $faker->email(),
                    'profile_pict' => $faker->imageUrl(480,480),
                    'password' => Hash::make('kelompok1hore'),
                    'status' => false,
                    'role' => rand(1, 39),
                    'created_at' => now(),
                    'last_login_at' => now()
                ]);
            } catch (UniqueConstraintViolationException $e) {
                // do nothin
            }
        }
    }
}
