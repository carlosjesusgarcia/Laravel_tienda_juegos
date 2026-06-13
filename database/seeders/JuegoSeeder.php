<?php
/**
 * Archivo: JuegoSeeder.php
 * Función: Poblador de base de datos para la entidad Juego, encargado de insertar registros iniciales y de prueba junto con sus recursos gráficos.
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Juego;

/**
 * Clase JuegoSeeder
 *
 * Gestiona la inserción automatizada de registros predeterminados en la tabla 'juegos'.
 * Útil para inicializar el entorno de desarrollo con datos de prueba consistentes,
 * vinculando cada registro con su respectivo archivo físico en el almacenamiento público.
 */
class JuegoSeeder extends Seeder
{
    /**
     * Ejecuta las operaciones de inserción en la base de datos.
     *
     * Itera sobre un conjunto de datos predefinido, instanciando y persistiendo
     * modelos de la clase Juego en el esquema relacional, asegurando la carga
     * de las rutas de las imágenes estructuradas previamente.
     *
     * @return void
     */
    public function run(): void
    {
        $juegos = [
            [
                'titulo' => 'Space Invaders',
                'precio' => 25000,
                'fecha_lanzamiento' => '1978-06-01',
                'sinopsis' => 'El clásico arcade donde debes defender la Tierra de oleadas de alienígenas.',
                'portada' => 'portadas/juego1.jpg',
                'portada_descripcion' => 'Portada del cartucho original de Space Invaders',
                'rating_fk' => 1,
                'generos' => [1, 2],
            ],
            [
                'titulo' => 'Pac-Man',
                'precio' => 30000,
                'fecha_lanzamiento' => '1980-05-22',
                'sinopsis' => 'Recorre el laberinto comiendo puntos y escapando de los fantasmas.',
                'portada' => 'portadas/juego2.jpg',
                'portada_descripcion' => 'Arte de la recreativa clásica de Pac-Man',
                'rating_fk' => 1,
                'generos' => [2, 7],
            ],
            [
                'titulo' => 'Donkey Kong',
                'precio' => 30000,
                'fecha_lanzamiento' => '1981-07-09',
                'sinopsis' => 'Salva a la damisela en apuros de las garras del gorila gigante.',
                'portada' => 'portadas/juego3.jpg',
                'portada_descripcion' => 'Portada promocional de Donkey Kong',
                'rating_fk' => 1,
                'generos' => [3, 2],
            ],
            [
                'titulo' => 'Tetris',
                'precio' => 25000,
                'fecha_lanzamiento' => '1984-06-06',
                'sinopsis' => 'Encaja las piezas geométricas para completar líneas y sumar puntos.',
                'portada' => 'portadas/juego4.jpg',
                'portada_descripcion' => 'Portada de la edición original de Tetris',
                'rating_fk' => 1,
                'generos' => [7],
            ],
            [
                'titulo' => 'Super Mario Bros.',
                'precio' => 45000,
                'fecha_lanzamiento' => '1985-09-13',
                'sinopsis' => 'El inicio de la gran aventura de Mario en el Reino Champiñón.',
                'portada' => 'portadas/juego5.jpg',
                'portada_descripcion' => 'Caja clásica de Super Mario Bros. para NES',
                'rating_fk' => 1,
                'generos' => [3, 2],
            ],
            [
                'titulo' => 'The Legend of Zelda',
                'precio' => 50000,
                'fecha_lanzamiento' => '1986-02-21',
                'sinopsis' => 'Explora Hyrule y rescata a la princesa Zelda de las manos de Ganon.',
                'portada' => 'portadas/juego6.jpg',
                'portada_descripcion' => 'Cartucho dorado de The Legend of Zelda',
                'rating_fk' => 2,
                'generos' => [2, 4],
            ],
            [
                'titulo' => 'Metroid',
                'precio' => 40000,
                'fecha_lanzamiento' => '1986-08-06',
                'sinopsis' => 'Acompaña a Samus Aran en su misión para detener a los Piratas Espaciales.',
                'portada' => 'portadas/juego7.jpg',
                'portada_descripcion' => 'Portada de Metroid para NES',
                'rating_fk' => 3,
                'generos' => [1, 2],
            ],
            [
                'titulo' => 'Mega Man',
                'precio' => 40000,
                'fecha_lanzamiento' => '1987-12-17',
                'sinopsis' => 'Derrota a los Robot Masters del Dr. Wily para salvar el futuro.',
                'portada' => 'portadas/juego8.jpg',
                'portada_descripcion' => 'Arte conceptual de la portada de Mega Man',
                'rating_fk' => 2,
                'generos' => [1, 3],
            ],
            [
                'titulo' => 'Civilization II',
                'precio' => 65000,
                'fecha_lanzamiento' => '1996-02-29',
                'sinopsis' => 'Construye un imperio que resista el paso del tiempo.',
                'portada' => 'portadas/juego9.jpg',
                'portada_descripcion' => 'Caja de distribución de PC de Civilization II',
                'rating_fk' => 3,
                'generos' => [4, 8],
            ],
            [
                'titulo' => 'Civilization III',
                'precio' => 75000,
                'fecha_lanzamiento' => '2001-10-30',
                'sinopsis' => 'Lleva a tu civilización a la gloria con nuevas mecánicas.',
                'portada' => 'portadas/juego10.jpg',
                'portada_descripcion' => 'Portada oficial de Civilization III',
                'rating_fk' => 3,
                'generos' => [4, 8],
            ],
        ];

        foreach ($juegos as $datos) {
            $generos = $datos['generos'];

            unset($datos['generos']);

            $juego = Juego::create($datos);

            $juego->generos()->attach($generos);
        }
    }
}
