<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('generos')->insert([
            [
                'genero_id' => 1,
                'nombre' => 'Acción',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genero_id' => 2,
                'nombre' => 'Aventura',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genero_id' => 3,
                'nombre' => 'Plataformas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genero_id' => 4,
                'nombre' => 'RPG',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genero_id' => 5,
                'nombre' => 'Lucha',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genero_id' => 6,
                'nombre' => 'Carreras',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genero_id' => 7,
                'nombre' => 'Puzzle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'genero_id' => 8,
                'nombre' => 'Deportes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
