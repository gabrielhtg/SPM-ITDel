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
        ["role"=>4,"accountable_to" => 2],
        ["role"=>6,"accountable_to" => 2],
        ["role"=>6,"accountable_to" => 5],
        ["role"=>7,"accountable_to" => 2],
        ["role"=>7,"accountable_to" => 5],
        ["role"=>8,"accountable_to" => 2],
        ["role"=>8,"accountable_to" => 5],
        ["role"=>9,"accountable_to" => 6],
        ["role"=>9,"accountable_to" => 2],
        ["role"=>9,"accountable_to" => 5],
        ["role"=>10,"accountable_to" => 6],
        ["role"=>10,"accountable_to" => 2],
        ["role"=>10,"accountable_to" => 5],
        ["role"=>11,"accountable_to" => 7],
        ["role"=>11,"accountable_to" => 2],
        ["role"=>11,"accountable_to" => 5],
        ]);
    }
}
