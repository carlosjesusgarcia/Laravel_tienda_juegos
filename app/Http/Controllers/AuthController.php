<?php
/**
 * Archivo: AuthController.php
 * Función: Controlador encargado de gestionar el proceso de autenticación de usuarios.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Clase AuthController
 *
 * Gestiona la lógica de autenticación de los usuarios del sistema,
 * incluyendo el acceso, la validación de credenciales y el cierre de sesión.
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
     * Captura las credenciales proporcionadas, intenta autenticar al usuario
     * y redirige según el resultado de la operación, proveyendo feedback
     * transaccional.
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
     * Cierra la sesión del usuario autenticado.
     *
     * Finaliza la sesión actual de Auth, invalida la sesión HTTP para
     * prevenir fijación de sesión y regenera el token CSRF por seguridad.
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
