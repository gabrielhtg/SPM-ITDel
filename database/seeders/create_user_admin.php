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
                'role' => 49,
                'status' => true,
                'online' => false,
                'username' => 'admin',
                'phone' => '082165646255',
                'created_at' => now(),
                'verified' => true,
                'profile_pict' => null
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
                'role' => 49,
                'created_at' => now(),
                'profile_pict' => 'src/img/profil_gabriel.png'
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
                'profile_pict' => 'src/img/vincent.jpg'
            ],
            [
                'name' => 'Dr. Arnaldo Marulitua Sinaga, S.T, M.InfoTech',
                'email' => 'aldo@del.ac.id',
                'username' => 'aldo',
                'phone' => '082122232425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 1,
                'created_at' => now(),
                'profile_pict' => null
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
                'profile_pict' => null
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
                'profile_pict' => null
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
                'profile_pict' => null
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
                'profile_pict' => null
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
                'profile_pict' => null
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
                'profile_pict' => null
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
                'profile_pict' => null
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
                'profile_pict' => null
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
                'profile_pict' => null
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
                'profile_pict' => null
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
                'profile_pict' => null
            ],
            [
                'name' => 'Guntur Purba Siboro, S.T, M.T',
                'email' => 'guntur.siboro@del.ac.id',
                'username' => 'guntur',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 7,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Josua Boyke William Jawak, ST., M.Ds',
                'email' => 'josua.jawak@del.ac.id',
                'username' => 'josua',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 7,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Ardiles Sinaga, S.T., M.T.',
                'email' => 'ardiles.sinaga@del.ac.id',
                'username' => 'ardiles',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 7,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Eka Stephani Sinambela, SST., M.Sc',
                'email' => 'eka@del.ac.id',
                'username' => 'eka',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 7,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Goklas Henry Agus Panjaitan, S.Tr.Kom',
                'email' => 'goklas.panjaitan@del.ac.id',
                'username' => 'goklas',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 7,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Yoke Aprilia Purba S.Kom',
                'email' => 'yoke@del.ac.id',
                'username' => 'yoke',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 12,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Anggiat Saud Parulian, S.Tr.Kom.',
                'email' => 'anggiat.parulian@del.ac.id',
                'username' => 'anggiat',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 11,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Oka Simatupang, S.Sos',
                'email' => 'oka.simatupang@del.ac.id',
                'username' => 'oka',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 11,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Monalisa Pasaribu, S.S, M.Ed (TESOL)',
                'email' => 'monalisa.pasaribu@del.ac.id',
                'username' => 'monalisa',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 21,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Rentauli Mariah Silalahi, S.Pd, M. Ed',
                'email' => 'rentauli@del.ac.id',
                'username' => 'rentauli',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 21,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Rusneni Vitaria',
                'email' => 'rusneni.vitaria@del.ac.id',
                'username' => 'rusneni',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 26,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Natal Sijabat',
                'email' => 'natal.sijabat@del.ac.id',
                'username' => 'natal',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 26,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Dr. Arlinta Christy Barus S.T., M.InfoTech',
                'email' => 'arlinta@del.ac.id',
                'username' => 'arlinta',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 47,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Iustisia Natalia Simbolon, S.Kom.,M.T',
                'email' => 'iustisia.simbolon@del.ac.id',
                'username' => 'iustisia',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 47,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Ranty Deviana Siahaan, S.Kom, M.Eng.',
                'email' => 'ranty.siahaan@del.ac.id',
                'username' => 'ranty',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 47,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Herimanto, S.Kom., M.Kom',
                'email' => 'herimanto.pardede@del.ac.id',
                'username' => 'herimanto',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 47,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Junita Amalia, S.Pd, M.Si',
                'email' => 'junita.amalia@del.ac.id',
                'username' => 'junita',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 4,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Mario Elyezer Subekti Simaremare, S.Kom., M.Sc',
                'email' => 'mario@del.ac.id',
                'username' => 'mario',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 48,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Tennov Simanjuntak, S.T, M.Sc.',
                'email' => 'tennov@del.ac.id',
                'username' => 'tennov',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 48,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Albert Sagala, S.T, M.T',
                'email' => 'albert@del.ac.id',
                'username' => 'albert',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 46,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Deni P. Lumbantoruan, S.T, M.Eng., Ph.D.',
                'email' => 'toruan@del.ac.id',
                'username' => 'deni',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 46,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Good Fried Panggabean, ST, MT, Ph.D',
                'email' => 'good@del.ac.id',
                'username' => 'goodfried',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 46,
                'created_at' => now(),
                'profile_pict' => null
            ],
            [
                'name' => 'Philippians Manurung, S.T., M.T.',
                'email' => 'philippians.manurung@del.ac.id',
                'username' => 'good@del.ac.id',
                'phone' => '082123222425',
                'online' => false,
                'password' => Hash::make("admin"),
                'status' => true,
                'verified' => true,
                'role' => 46,
                'created_at' => now(),
                'profile_pict' => null
            ],



        ]);

        require_once 'vendor/autoload.php';

        $faker = Factory::create();
    }
}
