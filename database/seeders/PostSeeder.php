<?php
/**
 * Archivo: PostSeeder.php
 * Función: Poblador de base de datos para la entidad Post, encargado de insertar artículos iniciales del blog junto con sus imágenes de prueba.
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

/**
 * Clase PostSeeder
 *
 * Gestiona la inserción automatizada de registros predeterminados en la tabla 'posts'.
 * Inicializa el entorno del blog con artículos de temática de videojuegos clásica,
 * vinculando cada entrada con su respectivo archivo físico de imagen en el almacenamiento público.
 */
class PostSeeder extends Seeder
{
    /**
     * Ejecuta las operaciones de inserción en la base de datos.
     *
     * Itera sobre un conjunto de datos predefinido, instanciando y persistiendo
     * modelos de la clase Post en el esquema relacional, asegurando la carga
     * de las rutas de las imágenes y la metadata descriptiva de las mismas.
     *
     * @return void
     */
    public function run(): void
    {
        $posts = [
            [
                'titulo' => 'Guía de Estrategia para Civilization III',
                'subtitulo' => 'Cómo dominar el mapa y ganar la partida',
                'contenido' => 'Una revisión exhaustiva de las mecánicas de expansión en el juego. Aprende a gestionar tus recursos, construir las mejores unidades y conquistar a tus rivales para conseguir la victoria en este clásico de la estrategia por turnos. Un repaso por las civilizaciones más fuertes y las maravillas del mundo indispensables.',
                'imagen' => 'blog/post1.jpg',
                'imagen_descripcion' => 'Captura de pantalla de una partida estratégica de Civilization III',
            ],
            [
                'titulo' => 'El Legado Arcade de Pac-Man',
                'subtitulo' => 'Secretos del laberinto clásico',
                'contenido' => 'Repasamos la historia de uno de los arcades más famosos de todos los tiempos. Conoce los patrones de movimiento de los fantasmas (Blinky, Pinky, Inky y Clyde), las mejores rutas para limpiar el tablero rápidamente y los trucos para maximizar tu puntuación antes de que aumente la dificultad.',
                'imagen' => 'blog/post2.jpg',
                'imagen_descripcion' => 'Pantalla clásica del juego arcade de Pac-Man',
            ],
            [
                'titulo' => 'Curiosidades de Super Mario Bros.',
                'subtitulo' => 'Plataformas de 8 bits inolvidables',
                'contenido' => 'El Reino Champiñón está lleno de secretos y atajos. Exploramos los niveles más emblemáticos, la ubicación de las tuberías ocultas (warp zones) y los trucos clásicos de vidas infinitas para rescatar a la princesa Peach y derrotar a Bowser en este pilar fundamental de los videojuegos de plataformas.',
                'imagen' => 'blog/post3.jpg',
                'imagen_descripcion' => 'Nivel inicial de Super Mario Bros. en la consola NES',
            ]
        ];

        foreach ($posts as $datos) {
            Post::create($datos);
        }
    }
}
