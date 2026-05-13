<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'titulo' => 'La Hegemonía en Civilization III',
                'subtitulo' => 'Estrategia, recursos y conflicto global',
                'contenido' => 'Una revisión exhaustiva de las mecánicas de expansión territorial. El juego modela con crudeza la diplomacia transaccional y la inevitable carrera armamentística. Estudiamos cómo la escasez de recursos estratégicos fuerza conflictos a escala global, reflejando dinámicas geopolíticas tangibles en una interfaz de casillas bidimensionales.',
                'imagen' => null,
                'imagen_descripcion' => null,
            ],
            [
                'titulo' => 'Pac-Man y la Ansiedad del Consumo',
                'subtitulo' => 'El laberinto de neón y la hiperactividad',
                'contenido' => 'Atrapado en un ciclo infinito de absorción, el avatar recorre corredores cerrados bajo la constante amenaza de entidades persistentes. Analizamos esta obra temprana como una representación interactiva del consumo compulsivo y el agotamiento psicológico en espacios cerrados, un autómata condenado a devorar para sobrevivir.',
                'imagen' => null,
                'imagen_descripcion' => null,
            ],
            [
                'titulo' => 'Super Mario Bros: Ecosistemas Colapsados',
                'subtitulo' => 'Arquitectura hostil en 8 bits',
                'contenido' => 'El Reino Champiñón se presenta como un entorno de colapso, plagado de infraestructuras fracturadas, cañerías desconectadas y fauna mutante. Exploramos la adaptación biológica de especies como los Goombas y la viabilidad estructural de un mundo definido por vacíos abismales y fortificaciones estáticas.',
                'imagen' => null,
                'imagen_descripcion' => null,
            ]
        ];

        foreach ($posts as $datos) {
            Post::create($datos);
        }
    }
}
