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
            [
                'name' => 'David Vincent Gurning',
                'email' => 'ifs21001@students.del.ac.id',
                'username' => 'Davidgrng',
                'phone' => '082164084465',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 1,
                'created_at' => now(),
                'profile_pict' => 'src/img/useradmin_profile.png'
            ],
            [
                'name' => 'Dr. Arnaldo Marulitua Sinaga, S.T, M.InfoTech',
                'email' => 'aldo@del.ac.id',
                'username' => 'aldo',
                'phone' => '082122232425',
                'online' => true,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 1,
                'created_at' => now(),
                'profile_pict' => 'src/img/useradmin_profile.png'
            ],
            [
                'name' => 'Dr. Johannes Harungguan Sianipar, S.T., M.T.',
                'email' => 'johannes@del.ac.id',
                'username' => 'johannes',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 2,
                'created_at' => now(),
                'profile_pict' => 'src/img/useradmin_profile.png'
            ],
            [
                'name' => 'Rosni Lumbantoruan, ST, M.ISD,Ph.D',
                'email' => 'rosni@del.ac.id',
                'username' => 'rosni',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 22,
                'created_at' => now(),
                'profile_pict' => 'src/img/useradmin_profile.png'
            ],
            [
                'name' => 'Humasak Tommy Argo Simanjuntak, ST, M.ISD',
                'email' => 'humasak@del.ac.id',
                'username' => 'humasak',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 29,
                'created_at' => now(),
                'profile_pict' => 'src/img/useradmin_profile.png'
            ],
            [
                'name' => 'Mariana Simanjuntak, S.S, M.Sc',
                'email' => 'anna@del.ac.id',
                'username' => 'anna',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 10,
                'created_at' => now(),
                'profile_pict' => 'src/img/useradmin_profile.png'
            ],
            [
                'name' => 'Indra Hartarto Tambunan, ST., M.S.,Ph.D',
                'email' => 'indra.tambunan@del.ac.id',
                'username' => 'indra',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 3,
                'created_at' => now(),
                'profile_pict' => 'src/img/useradmin_profile.png'
            ],
            [
                'name' => 'Riyanthi Angrainy Sianturi, S.Sos, M.Ds',
                'email' => 'riyanthi@del.ac.id',
                'username' => 'riyanthi',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 3,
                'created_at' => now(),
                'profile_pict' => 'src/img/useradmin_profile.png'
            ],
            [
                'name' => 'Dr. Fitriani Tupa Ronauli Silalahi, S.Si, M.Si',
                'email' => 'fitri.silalahi@del.ac.id',
                'username' => 'fitri',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 3,
                'created_at' => now(),
                'profile_pict' => 'src/img/useradmin_profile.png'
            ],
            [
                'name' => 'Dr. Merry Meryam Martgrita, S.Si., M.Si',
                'email' => 'merry.martgrita@del.ac.id',
                'username' => 'merry',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 3,
                'created_at' => now(),
                'profile_pict' => 'src/img/useradmin_profile.png'
            ],
            [
                'name' => 'Parmonangan Rotua Togatorop, S.Kom., M.T.I',
                'email' => 'mona.togatorop@del.ac.id',
                'username' => 'mona',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 34,
                'created_at' => now(),
                'profile_pict' => 'src/img/useradmin_profile.png'
            ],
            [
                'name' => 'Arie Satia Dharma, S.T, M.Kom',
                'email' => 'ariesatia@del.ac.id',
                'username' => 'arie',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 7,
                'created_at' => now(),
                'profile_pict' => 'src/img/useradmin_profile.png'
            ],
            [
                'name' => 'Samuel Indra Gunawan Situmeang, S.Ti., M.Sc.',
                'email' => 'samuel.situmeang@del.ac.id',
                'username' => 'samuelstmg',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 7,
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
