<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class createRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
           ['role' => 'Rektor'],
           ['role' => 'Wakil Rektor'],
           ['role' => 'Ketua SPM'],
           ['role' => 'Anggota SPM'],
        ]);
    }
}
