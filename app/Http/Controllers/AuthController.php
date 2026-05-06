<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importación obligatoria para usar Auth::

class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function login()
    {
        // El punto indica que busque dentro de la carpeta 'auth' el archivo 'login.blade.php'
        return view('auth.login');
    }

    /**
     * Procesa los datos del formulario de login e intenta autenticar al usuario.
     */
    public function process(Request $request)
    {
        // TODO: Validar...

        // Empezamos por capturar los datos que necesitamos. Esto es, los valores
        // que sirven como "credenciales" (los datos que usamos para autenticar).
        // Como mínimo, necesitamos dos:
        // 1. Un campo "password" (con ese nombre) que contenga la contraseña.
        // 2. Al menos un campo que sirva para identificar al usuario.
        $credentials = $request->only(['email', 'password']);

        /*
         * # Autenticando
         * Para interactuar con la autenticación necesitamos acceder a la clase
         * de autenticación.
         * Hay varias formas de hacerlo, incluyendo:
         *     - Usar la función auth().
         *     - Usar la façade Auth.
         *
         * Dentro de la clase de autenticación tenemos el método "attempt" (intentar).
         * Este método recibe las credenciales y retorna true o false indicando si
         * se pudo autenticar al usuario, o no.
         * Si tuvo éxito, autentica al usuario y retorna true.
         * De lo contrario, retorna false.
         *
         * También tiene un método "user()" que nos permite obtener el usuario autenticado.
         * Si usamos el "provider" de Eloquent, será la instancia del modelo de Eloquent
         * correspondiente.
         */

        // if(auth()->attempt()) {
        if(Auth::attempt($credentials) === false) {
            // Tiramos algún error.
            return redirect()
                ->route('login')
                // withInput() agrega como una variable flash en la sesión los datos
                // del form. Nos permite usar la función "old()" para obtener.
                ->withInput()
                ->with('feedback.message', 'Las credenciales ingresadas no coinciden con nuestros registros.');
        }

        // El usuario está autenticado :D
        return redirect()
            ->route('juegos.listado')
            ->with('feedback.message', '¡Hola de nuevo, ' . Auth::user()->email . '!');
    }

    public function logout(Request $request)
    {
        // Para cerrar sesión simplemente llamamos al método logout() de Auth.
        Auth::logout();

        // Para mejorar la seguridad de nuestro sitio y protegernos de "session
        // fixation", vamos a regenerar la sesión de Laravel, y recrear el token
        // de CSRF.
        $request->session()->invalidate(); // Invalidamos la sesión para que se genere una nueva
        $request->session()->regenerateToken(); // Regeneramos el token de CSRF.

        return redirect()
            ->route('login')
            ->with('feedback.message', 'Sesión terminada. ¡Te esperamos de nuevo pronto!');
    }
}
