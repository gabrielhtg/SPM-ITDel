<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Asumsi Anda menggunakan User untuk menentukan responsible, accountable, informable

class createRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['role' => 'Admin', 'status' => true, 'is_admin' => true, 'atasan_id' => null],
            ['role' => 'Rektor', 'status' => true, 'is_admin' => false, 'atasan_id' => null],
            ['role' => 'SPM', 'status' => true, 'is_admin' => false, 'atasan_id' => 2],
            ['role' => 'WR 1', 'status' => true, 'is_admin' => false, 'atasan_id' => 2],
            ['role' => 'WR 2', 'status' => true, 'is_admin' => false, 'atasan_id' => 2],
            ['role' => 'WR 3', 'status' => true, 'is_admin' => false, 'atasan_id' => 2],
            ['role' => 'BAAK', 'status' => true, 'is_admin' => false, 'atasan_id' => 4],
            ['role' => 'PPKHA', 'status' => true, 'is_admin' => false, 'atasan_id' => 4],
            ['role' => 'UPT Kantin', 'status' => true, 'is_admin' => false, 'atasan_id' => 5],
        ]);
    }
}
