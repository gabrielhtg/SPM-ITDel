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
            ["role"=>3, "responsible_to" => 2],
            ["role"=>2, "responsible_to" => 13],
        ]);
    }
}
