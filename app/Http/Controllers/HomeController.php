<?php
/**
 * Archivo: HomeController.php
 * Función: Controlador encargado de gestionar las vistas principales e institucionales del sitio.
 */

namespace App\Http\Controllers;

use App\Models\Post;

/**
 * Clase HomeController
 *
 * Gestiona la lógica de presentación para la página de inicio, integrando
 * contenido dinámico reciente, así como las vistas de carácter estático.
 */
class HomeController extends Controller
{
    /**
     * Retorna la vista de inicio del sistema.
     *
     * Recupera de la base de datos las últimas cuatro entradas publicadas
     * y las inyecta en la plantilla principal para su renderizado.
     */
    public function home()
    {
        $posts = Post::latest()->take(4)->get();

        return view('welcome', [
            'posts' => $posts,
        ]);
    }

    /**
     * Retorna la vista con la información institucional del proyecto.
     *
     */
    public function about()
    {
        return view('about');
    }
}
