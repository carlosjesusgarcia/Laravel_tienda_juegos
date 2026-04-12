<?php

namespace App\Http\Controllers;

use App\Models\Juego;
use Illuminate\Http\Request;

class JuegosController extends Controller
{
    /**
     * Muestra el catálogo de juegos desde la base de datos.
     */
    public function index()
    {
        /**
         * Recupera TODOS los registros de la tabla "juegos".
         * Equivale a: SELECT * FROM juegos;
         *
         * Devuelve una colección de objetos Juego.
         */
        $juegos = Juego::all();

        /**
         * Retorna la vista "juegos.index" y le pasa los datos.
         *
         * compact('juegos') es equivalente a:
         * ['juegos' => $juegos]
         *
         * En la vista podrás usar:
         * $juegos
         */
        return view('juegos.index', compact('juegos'));
    }
}
