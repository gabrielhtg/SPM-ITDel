<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class bawahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bawahan')->insert([
            ["role"=>2, "bawahan" => 3],
            ["role"=>2, "bawahan" => 4],
            ["role"=>2, "bawahan" => 5],
            ["role"=>2, "bawahan" => 6],
            ["role"=>2, "bawahan" => 15],
            ["role"=>4, "bawahan" => 7],
            ["role"=>4, "bawahan" => 8],
            ["role"=>4, "bawahan" => 25],
            ["role"=>4, "bawahan" => 26],
            ["role"=>4, "bawahan" => 28],
            ["role"=>4, "bawahan" => 29],
            ["role"=>4, "bawahan" => 30],
            ["role"=>4, "bawahan" => 31],
            ["role"=>5, "bawahan" => 37],
            ["role"=>5, "bawahan" => 38],
            ["role"=>5, "bawahan" => 36],
            ["role"=>5, "bawahan" => 39],
            ["role"=>6, "bawahan" => 40],
            ["role"=>6, "bawahan" => 41],
            ["role"=>6, "bawahan" => 42],
            ["role"=>6, "bawahan" => 43],
        ]);
    }
}
