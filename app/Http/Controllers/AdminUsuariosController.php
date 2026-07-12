<?php

/**
 * Archivo: AdminUsuariosController.php
 * Función: Muestra los usuarios registrados y el detalle de sus compras.
 */

namespace App\Http\Controllers;

use App\Models\User;

class AdminUsuariosController extends Controller
{
    /**
     * Muestra el listado de usuarios.
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
     * Muestra los datos de un usuario y sus compras.
     */
    public function detalles(int $id)
    {
        $usuario = User::with(['rol', 'compras.juegos'])
            ->where('id', $id)
            ->firstOrFail();

        return view('admin.usuarios.detalles', [
            'usuario' => $usuario,
        ]);
    }
}