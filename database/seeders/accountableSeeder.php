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
            ['role' => 3, 'accountable_to' => 2],
            ['role' => 4, 'accountable_to' => 2],
            ['role' => 5, 'accountable_to' => 2],
            ['role' => 6, 'accountable_to' => 2],
            ['role' => 7, 'accountable_to' => 4],
            ['role' => 7, 'accountable_to' => 2],
            ['role' => 8, 'accountable_to' => 4],
            ['role' => 8, 'accountable_to' => 2],
            ['role' => 9, 'accountable_to' => 5],
            ['role' => 9, 'accountable_to' => 2],
        ]);
    }
}
