<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class allowedUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('allowed_user')->insert([
        ]);
    }
}
