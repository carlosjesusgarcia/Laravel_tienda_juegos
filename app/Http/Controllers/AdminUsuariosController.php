<?php
/**
 * Archivo: AdminUsuariosController.php
 * Función: Controlador responsable de gestionar la visualización de usuarios dentro del panel administrador.
 */

namespace App\Http\Controllers;

use App\Models\User;

/**
 * Clase AdminUsuariosController
 *
 * Permite al administrador consultar el listado de usuarios registrados
 * y acceder al detalle de cada usuario junto con sus compras realizadas.
 */
class AdminUsuariosController extends Controller
{
    /**
     * Muestra el listado de usuarios registrados.
     */
    public function index()
    {
        $usuarios = User::with(['rol'])
            ->orderBy('name')
            ->get();

        return view('admin.usuarios.index', [
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * Muestra el detalle de un usuario junto con sus compras.
     */
    public function detalles(int $id)
    {
        $usuario = User::with(['rol', 'compras.juego'])
            ->where('id', $id)
            ->firstOrFail();

        return view('admin.usuarios.detalles', [
            'usuario' => $usuario,
        ]);
    }
}
