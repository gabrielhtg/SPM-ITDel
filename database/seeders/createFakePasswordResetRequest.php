<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class createFakePasswordResetRequest extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        require_once 'vendor/autoload.php';

        $faker = Factory::create();

        foreach (range(1, 10) as $index) {
            try {
                DB::table('password_reset_tokens')->insert([
                   [
                       'email' => 'ifs21010@students.del.ac.id',
                       'token' => Uuid::uuid1()->toString(),
                       'created_at' => now(),
                       'updated_at' => now()
                   ],
                    [
                        'email' => 'ifs21005@students.del.ac.id',
                        'token' => Uuid::uuid1()->toString(),
                        'created_at' => now(),
                        'updated_at' => now()
                    ],
                ]);
            } catch (UniqueConstraintViolationException $e) {
                // do nothin
            }
        }
    }
}
