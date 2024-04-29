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
            ["role"=>3,"bawahan" => 4],
            ]); 
    }
}
