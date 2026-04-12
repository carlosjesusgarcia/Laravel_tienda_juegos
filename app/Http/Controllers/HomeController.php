<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function home()
    {
        // La vista es el nombre del archivo dentro de la carpeta [resources/views], sin la extensión ni ".php"
        // ni ".blade.php".
        return view('welcome');
    }

     public function about()
    {
        // La vista es el nombre del archivo dentro de la carpeta [resources/views], sin la extensión ni ".php"
        // ni ".blade.php".
        return view('about');
    }

     public function login()
    {
        // La vista es el nombre del archivo dentro de la carpeta [resources/views], sin la extensión ni ".php"
        // ni ".blade.php".
        return view('login');
    }
}
