<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class accountableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accountable')->insert([
        ["role"=>3,"accountable_to" => 2],
        ["role"=>4,"accountable_to" => 3],
        ["role"=>4,"accountable_to" => 2]
        ]);
    }
}
