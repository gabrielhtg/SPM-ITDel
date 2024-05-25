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
            ['role' => 2, 'accountable_to' => 13],
            ['role' => 4, 'accountable_to' => 2],
            ['role' => 5, 'accountable_to' => 2],
            ['role' => 6, 'accountable_to' => 2],
            ['role' => 7, 'accountable_to' => 4],
            ['role' => 7, 'accountable_to' => 2],
            ['role' => 8, 'accountable_to' => 4],
            ['role' => 8, 'accountable_to' => 2],
            ['role' => 9, 'accountable_to' => 5],
            ['role' => 9, 'accountable_to' => 2],
            ['role' => 21, 'accountable_to' => 7],
            ['role' => 21, 'accountable_to' => 4],
            ['role' => 21, 'accountable_to' => 2],
            ['role' => 23, 'accountable_to' => 4],
            ['role' => 23, 'accountable_to' => 7],
            ['role' => 23, 'accountable_to' => 2],
            ['role' => 24, 'accountable_to' => 7],
            ['role' => 24, 'accountable_to' => 4],
            ['role' => 24, 'accountable_to' => 2],
            ['role' => 26, 'accountable_to' => 2],
            ['role' => 26, 'accountable_to' => 4],
            ['role' => 27, 'accountable_to' => 26],
            ['role' => 27, 'accountable_to' => 4],
            ['role' => 27, 'accountable_to' => 2],
            ['role' => 22, 'accountable_to' => 2],
            ['role' => 22, 'accountable_to' => 4],
            ['role' => 28, 'accountable_to' => 4],
            ['role' => 28, 'accountable_to' => 2],
            ['role' => 31, 'accountable_to' => 4],
            ['role' => 31, 'accountable_to' => 2],
            ['role' => 30, 'accountable_to' => 4],
            ['role' => 30, 'accountable_to' => 2],
            ['role' => 37, 'accountable_to' => 5],
            ['role' => 37, 'accountable_to' => 2],
            ['role' => 34, 'accountable_to' => 37],
            ['role' => 34, 'accountable_to' => 5],
            ['role' => 34, 'accountable_to' => 2],
            ['role' => 38, 'accountable_to' => 5],
            ['role' => 36, 'accountable_to' => 5],
            ['role' => 20, 'accountable_to' => 6],
            ['role' => 20, 'accountable_to' => 2],
            ['role' => 41, 'accountable_to' => 20],
            ['role' => 41, 'accountable_to' => 6],
            ['role' => 41, 'accountable_to' => 2],
            ['role' => 42, 'accountable_to' => 6],
            ['role' => 42, 'accountable_to' => 2],
            ['role' => 43, 'accountable_to' => 6],
            ['role' => 43, 'accountable_to' => 2],
            ['role' => 44, 'accountable_to' => 2],
            ['role' => 45, 'accountable_to' => 2],
            ['role' => 46, 'accountable_to' => 2],
            ['role' => 47, 'accountable_to' => 2],
            ['role' => 48, 'accountable_to' => 44],
            ['role' => 48, 'accountable_to' => 2],
            ['role' => 49, 'accountable_to' => 44],
            ['role' => 49, 'accountable_to' => 2],
            ['role' => 50, 'accountable_to' => 44],
            ['role' => 50, 'accountable_to' => 2],
            ['role' => 51, 'accountable_to' => 45],
            ['role' => 51, 'accountable_to' => 2],
            ['role' => 52, 'accountable_to' => 45],
            ['role' => 52, 'accountable_to' => 2],
            ['role' => 53, 'accountable_to' => 46],
            ['role' => 53, 'accountable_to' => 2],
            ['role' => 54, 'accountable_to' => 47],
            ['role' => 54, 'accountable_to' => 2],
            ['role' => 55, 'accountable_to' => 47],
            ['role' => 55, 'accountable_to' => 2],
            ['role' => 56, 'accountable_to' => 47],
            ['role' => 56, 'accountable_to' => 2],
            ['role' => 57, 'accountable_to' => 47],
            ['role' => 57, 'accountable_to' => 2],
        ]);
    }
}
