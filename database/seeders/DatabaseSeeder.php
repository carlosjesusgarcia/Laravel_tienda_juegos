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
    $this->call(RatingSeeder::class);

    // 3. LLAMAMOS AL SEEDER DE JUEGOS
    $this->call(JuegoSeeder::class);

    // 4. LLAMAMOS AL SEEDER DE POSTS
    $this->call(PostSeeder::class);
}
}
