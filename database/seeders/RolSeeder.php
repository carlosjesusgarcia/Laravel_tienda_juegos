<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'rol_id'     => 1,
                'nombre'     => 'administrador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rol_id'     => 2,
                'nombre'     => 'usuario',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
