<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class responsibleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('responsible')->insert([
//            ["role"=>3,"responsible_to" => 2],
//            ["role"=>4,"responsible_to" => 3],
//            ["role"=>4,"responsible_to" => 2],
//            ["role"=>5,"responsible_to" => 2]
            ]);
    }
}
