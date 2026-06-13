<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. LLAMAMOS AL SEEDER DE USUARIOS
        $this->call(UserSeeder::class);

        // 2. LLAMAMOS AL SEEDER DE RATINGS
        // Debe ejecutarse antes de JuegoSeeder porque juegos.rating_fk depende de ratings.
        $this->call(RatingSeeder::class);

        // 3. LLAMAMOS AL SEEDER DE GÉNEROS
        // Debe ejecutarse antes de JuegoSeeder porque luego los juegos se relacionan con géneros.
        $this->call(GeneroSeeder::class);

        // 4. LLAMAMOS AL SEEDER DE JUEGOS
        // Crea los juegos y, si está configurado, carga la tabla pivot juegos_tienen_generos.
        $this->call(JuegoSeeder::class);

        // 5. LLAMAMOS AL SEEDER DE POSTS
        $this->call(PostSeeder::class);
    }
}
