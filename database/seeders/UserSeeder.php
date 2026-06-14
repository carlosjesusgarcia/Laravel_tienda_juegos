<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'       => 'SuperMario',
                'email'      => 'supermario@nintendo.com',
                'password'   => Hash::make('mariobros1234'),
                'rol_fk'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Luigi',
                'email'      => 'luigi@nintendo.com',
                'password'   => Hash::make('luigi1234'),
                'rol_fk'     => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
