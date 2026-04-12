<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JuegosController extends Controller
{
    /**
     * Muestra el catálogo de juegos desde la base de datos.
     */
    public function index()
    {
        /**
         * Traemos todos los juegos que tenemos en la tabla "juegos"
         * a través del Query Builder.
         *
         * El método get() retorna una Collection.
         * Cada elemento de esa colección es un objeto con los campos
         * de cada registro de la tabla.
         */
        $juegos = DB::table('juegos')->get();

        /**
         * Necesitamos pasarle los juegos a la vista.
         *
         * El segundo parámetro de view() recibe un array
         * con las variables que queremos usar en la vista.
         *
         * La clave del array será el nombre de la variable
         * disponible en el Blade.
         */
        return view('juegos.index', [
            'juegos' => $juegos,
        ]);
    }
}
