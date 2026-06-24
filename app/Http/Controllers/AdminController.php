<?php

/**
 * Archivo: AdminController.php
 * Función: Muestra la pantalla principal del panel de administración.
 */

namespace App\Http\Controllers;

class AdminController extends Controller
{
    /**
     * Muestra el inicio del panel administrador.
     */
    public function index()
    {
        return view('admin.index');
    }
}
