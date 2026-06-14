<?php
/**
 * Archivo: AuthController.php
 * Función: Controlador encargado de gestionar el proceso de autenticación y registro de usuarios.
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Clase AuthController
 *
 * Gestiona la lógica de autenticación de los usuarios del sistema,
 * incluyendo el acceso, la validación de credenciales, el registro y el cierre de sesión.
 */
class AuthController extends Controller
{
    /**
     * Retorna la vista correspondiente al formulario de inicio de sesión.
     *
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Procesa la solicitud de inicio de sesión.
     *
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
     * Retorna la vista correspondiente al formulario de registro.
     *
     */
    public function registro()
    {
        return view('auth.registro');
    }

    /**
     * Procesa el registro de un nuevo usuario común.
     *
     */
    public function guardarRegistro(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'El nombre de usuario es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresá un correo electrónico válido.',
            'email.unique' => 'Ese correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
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
     * Cierra la sesión del usuario autenticado.
     *
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
