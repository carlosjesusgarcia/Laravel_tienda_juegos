<?php

/**
 * Archivo: PerfilController.php
 * Función: Muestra y actualiza el perfil del usuario autenticado y su historial de compras.
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    /**
     * Muestra los datos del usuario autenticado y su historial de compras.
     */
    public function index()
    {
        $usuario = User::with([
            'rol',
            'compras.detalles.juego',
        ])
            ->where('id', Auth::id())
            ->firstOrFail();

        return view('perfil.index', [
            'usuario' => $usuario,
        ]);
    }

    /**
     * Muestra el formulario para editar el perfil.
     */
    public function editar()
    {
        $usuario = User::where('id', Auth::id())
            ->firstOrFail();

        return view('perfil.editar', [
            'usuario' => $usuario,
        ]);
    }

    /**
     * Actualiza el nombre y el correo electrónico del usuario autenticado.
     */
    public function actualizar(Request $request)
    {
        $usuario = User::where('id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
        ]);

        $usuario->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return redirect()
            ->route('perfil.index')
            ->with('feedback.message', 'Los datos del perfil se actualizaron correctamente.');
    }
}