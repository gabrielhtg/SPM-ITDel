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
            ["role"=>2,"bawahan" => 3],
            ["role"=>2,"bawahan" => 4],
            ["role"=>2,"bawahan" => 6],
            ["role"=>3,"bawahan" => 4],
            ["role"=>2,"bawahan" => 7],
            ["role"=>2,"bawahan" => 8],
            ["role"=>6,"bawahan" => 9],
            ["role"=>6,"bawahan" => 10],
            ["role"=>7,"bawahan" => 11],
            ]); 
    }
}
