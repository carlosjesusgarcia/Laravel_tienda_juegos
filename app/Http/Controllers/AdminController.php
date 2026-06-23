<?php
/**
 * Archivo: AdminController.php
 * Función: Controlador responsable de mostrar la pantalla principal del panel de administración.
 */

namespace App\Http\Controllers;

/**
 * Clase AdminController
 *
 * Gestiona el acceso inicial al panel de administración del sitio.
 * Esta sección está pensada para usuarios autenticados con rol administrador.
 */
class AdminController extends Controller
{
    /**
     * Muestra la pantalla principal del panel administrador.
     */
    public function index()
    {
        return view('admin.index');
    }
}
