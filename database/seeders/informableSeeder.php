<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class informableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('informable')->insert([
            ["role"=>3,"informable_to" => 2],
            ["role"=>4,"informable_to" => 3],
            ["role"=>4,"informable_to" => 2],
            ["role"=>5,"informable_to" => 2],
            ]); 
    }
}
