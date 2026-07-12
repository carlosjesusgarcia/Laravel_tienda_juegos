<?php

/**
 * Archivo: AuthController.php
 * Función: Maneja el login, registro y cierre de sesión.
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de login.
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Revisa los datos del login.
     */
    public function process(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if(Auth::attempt($credentials) === false) {
            return redirect()
                ->route('login')
                ->withInput()
                ->with('feedback.message', 'Las credenciales ingresadas no coinciden con nuestros registros.');
        }

        return redirect()
            ->route('juegos.listado')
            ->with('feedback.message', '¡Hola de nuevo, ' . Auth::user()->email . '!');
    }

    /**
     * Muestra el formulario de registro.
     */
    public function registro()
    {
        return view('auth.registro');
    }

    /**
     * Guarda un usuario nuevo.
     */
    public function guardarRegistro(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'rol_fk' => 2,
        ]);

        return redirect()
            ->route('login')
            ->with('feedback.message', 'Usuario registrado correctamente. Ya podés iniciar sesión.');
    }

    /**
     * Cierra la sesión actual.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('feedback.message', 'Sesión terminada. ¡Te esperamos de nuevo pronto!');
    }
}