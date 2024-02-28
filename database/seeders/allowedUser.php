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
            [
                'email' => 'ifs21005@students.del.ac.id',
                'created_at' =>now(),
                'created_by' => "admin"
            ],
        ]);
    }
}
