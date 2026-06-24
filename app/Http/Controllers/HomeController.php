<?php

/**
 * Archivo: HomeController.php
 * Función: Muestra la home y la página institucional.
 */

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Muestra la página de inicio.
     */
    public function home()
    {
        $posts = Post::latest()->take(4)->get();

        return view('welcome', [
            'posts' => $posts,
        ]);
    }

    /**
     * Muestra la página Nosotros.
     */
    public function about()
    {
        return view('about');
    }
}
