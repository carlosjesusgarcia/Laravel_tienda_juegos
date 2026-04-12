<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JuegoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('juegos')->insert([
            [
                'titulo' => 'Space Invaders',
                'precio' => 250000,
                'fecha_lanzamiento' => '1978-06-01',
                'sinopsis' => 'El clásico arcade donde debes defender la Tierra de oleadas de alienígenas.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'titulo' => 'Pac-Man',
                'precio' => 300000,
                'fecha_lanzamiento' => '1980-05-22',
                'sinopsis' => 'Recorre el laberinto comiendo puntos y escapando de los fantasmas.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'titulo' => 'Donkey Kong',
                'precio' => 300000,
                'fecha_lanzamiento' => '1981-07-09',
                'sinopsis' => 'Salva a la damisela en apuros de las garras del gorila gigante.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'titulo' => 'Tetris',
                'precio' => 250000,
                'fecha_lanzamiento' => '1984-06-06',
                'sinopsis' => 'Encaja las piezas geométricas para completar líneas y sumar puntos.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'titulo' => 'Super Mario Bros.',
                'precio' => 450000,
                'fecha_lanzamiento' => '1985-09-13',
                'sinopsis' => 'El inicio de la gran aventura de Mario en el Reino Champiñón.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'titulo' => 'The Legend of Zelda',
                'precio' => 500000,
                'fecha_lanzamiento' => '1986-02-21',
                'sinopsis' => 'Explora Hyrule y rescata a la princesa Zelda de las manos de Ganon.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'titulo' => 'Metroid',
                'precio' => 400000,
                'fecha_lanzamiento' => '1986-08-06',
                'sinopsis' => 'Acompaña a Samus Aran en su misión para detener a los Piratas Espaciales.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'titulo' => 'Mega Man',
                'precio' => 400000,
                'fecha_lanzamiento' => '1987-12-17',
                'sinopsis' => 'Derrota a los Robot Masters del Dr. Wily para salvar el futuro.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'titulo' => 'Civilization II',
                'precio' => 650000,
                'fecha_lanzamiento' => '1996-02-29',
                'sinopsis' => 'Construye un imperio que resista el paso del tiempo.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'titulo' => 'Civilization III',
                'precio' => 750000,
                'fecha_lanzamiento' => '2001-10-30',
                'sinopsis' => 'Lleva a tu civilización a la gloria con nuevas mecánicas.',
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);
    }
}
