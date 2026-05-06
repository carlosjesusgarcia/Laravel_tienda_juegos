<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Juego; // IMPORTANTE: Importamos el modelo

class JuegoSeeder extends Seeder
{
    public function run(): void
    {
        $juegos = [
            [
                'titulo' => 'Space Invaders',
                'precio' => 250000,
                'fecha_lanzamiento' => '1978-06-01',
                'sinopsis' => 'El clásico arcade donde debes defender la Tierra de oleadas de alienígenas.',
            ],
            [
                'titulo' => 'Pac-Man',
                'precio' => 300000,
                'fecha_lanzamiento' => '1980-05-22',
                'sinopsis' => 'Recorre el laberinto comiendo puntos y escapando de los fantasmas.',
            ],
            [
                'titulo' => 'Donkey Kong',
                'precio' => 300000,
                'fecha_lanzamiento' => '1981-07-09',
                'sinopsis' => 'Salva a la damisela en apuros de las garras del gorila gigante.',
            ],
            [
                'titulo' => 'Tetris',
                'precio' => 250000,
                'fecha_lanzamiento' => '1984-06-06',
                'sinopsis' => 'Encaja las piezas geométricas para completar líneas y sumar puntos.',
            ],
            [
                'titulo' => 'Super Mario Bros.',
                'precio' => 450000,
                'fecha_lanzamiento' => '1985-09-13',
                'sinopsis' => 'El inicio de la gran aventura de Mario en el Reino Champiñón.',
            ],
            [
                'titulo' => 'The Legend of Zelda',
                'precio' => 500000,
                'fecha_lanzamiento' => '1986-02-21',
                'sinopsis' => 'Explora Hyrule y rescata a la princesa Zelda de las manos de Ganon.',
            ],
            [
                'titulo' => 'Metroid',
                'precio' => 400000,
                'fecha_lanzamiento' => '1986-08-06',
                'sinopsis' => 'Acompaña a Samus Aran en su misión para detener a los Piratas Espaciales.',
            ],
            [
                'titulo' => 'Mega Man',
                'precio' => 400000,
                'fecha_lanzamiento' => '1987-12-17',
                'sinopsis' => 'Derrota a los Robot Masters del Dr. Wily para salvar el futuro.',
            ],
            [
                'titulo' => 'Civilization II',
                'precio' => 650000,
                'fecha_lanzamiento' => '1996-02-29',
                'sinopsis' => 'Construye un imperio que resista el paso del tiempo.',
            ],
            [
                'titulo' => 'Civilization III',
                'precio' => 750000,
                'fecha_lanzamiento' => '2001-10-30',
                'sinopsis' => 'Lleva a tu civilización a la gloria con nuevas mecánicas.',
            ],
        ];

        // Recorremos el array y usamos el MODELO para insertar
        foreach ($juegos as $datos) {
            Juego::create($datos);
        }
    }
}
