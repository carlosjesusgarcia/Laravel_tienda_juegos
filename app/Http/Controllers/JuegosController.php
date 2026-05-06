<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Juego;
use Illuminate\Support\Str;

class JuegosController extends Controller
{
    /**
     * Muestra el catálogo de juegos desde la base de datos.
     */
    public function index()
    {
        /**
         * Traemos todos los juegos que tenemos en la tabla "juegos"
         * a través del Query Builder.
         *
         * El método get() retorna una Collection.
         * Cada elemento de esa colección es un objeto con los campos
         *  $juegos = DB::table('juegos')->get();
         * de cada registro de la tabla.
         */

        $juegos = Juego::all(); // Alternativamente, usando Eloquent ORM

        /**
         * Necesitamos pasarle los juegos a la vista.
         *
         * El segundo parámetro de view() recibe un array
         * con las variables que queremos usar en la vista.
         *
         * La clave del array será el nombre de la variable
         * disponible en el Blade.
         */
        return view('juegos.index', [
            'juegos' => $juegos,
        ]);
    }

    /**
     * Muestra los detalles de un juego específico.
     *
     * @param string $id El identificador único del juego (slug).
     */
    public function detalles(string $id)
    {
        /**
         * Búsqueda manual estricta adaptada a URLs amigables (slugs).
         * firstOrFail() asegura que si el slug no existe, el sistema
         * devuelva un error 404 de forma segura.
         */
        $juego = Juego::where('slug', $id)->firstOrFail();

        return view('juegos.detalles-juego', [
            'juego' => $juego,
        ]);
    }

    public function crear()
    {
        // Buscamos la vista en resources/views/juegos/crear.blade.php
        return view('juegos.crear');
    }

    /**
     * Almacenar un nuevo juego en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request  La petición HTTP entrante con los datos del formulario.
     * @return \Illuminate\Http\RedirectResponse   Redirige al listado de juegos tras el registro exitoso.
     */
    public function guardar(Request $request)
    {
        /**
         * 1. Validación de los datos de entrada.
         * Se valida que los campos obligatorios estén presentes y cumplan con los formatos requeridos.
         * Se incluye un segundo array asociativo (clave 'campo.regla') para proveer
         * mensajes en español.
         */
        $request->validate([
            'titulo'            => 'required|min:2',
            'precio'            => 'required|numeric',
            'fecha_lanzamiento' => 'required',
            'sinopsis'          => 'required',
        ], [
            'titulo.required'            => 'El título del juego debe tener un valor.',
            'titulo.min'                 => 'El título del juego debe tener al menos :min caracteres.',
            'precio.required'            => 'El precio del juego debe tener un valor.',
            'precio.numeric'             => 'El precio del juego debe ser un valor numérico.',
            'fecha_lanzamiento.required' => 'La fecha de lanzamiento debe tener un valor.',
            'sinopsis.required'          => 'La sinopsis del archivo debe tener un valor.',
        ]);

        /**
         * 2. Filtrado de datos.
         * Se utiliza el método only() para extraer estrictamente los campos permitidos,
         * previniendo la inyección de datos no deseados en la petición.
         */
        $data = $request->only(['titulo', 'precio', 'fecha_lanzamiento', 'sinopsis']);

        /**
         * 3. Persistencia de datos mediante Asignación Masiva (Mass Assignment).
         * Se emplea el método create() de Eloquent para mayor eficiencia. Este método:
         * - Verifica la propiedad $fillable del modelo por seguridad.
         * - Dispara el evento 'creating' (previamente configurado en el modelo) para autogenerar el slug.
         * - Inserta el registro en la base de datos.
         */
        Juego::create($data);

        /**
         * 4. Redirección con notificación de éxito.
         * Se redirige el flujo al catálogo general.
         * Se implementa el helper e() por seguridad contra vulnerabilidades XSS,
         * saneando la entrada del usuario antes de concatenarla con etiquetas HTML sin escapar.
         */
        return redirect()
            ->route('juegos.listado')
            ->with('feedback.message', 'El cartucho <b>' . e($data['titulo']) . '</b> se guardó con éxito en el archivo.');
    }

    /**
     * Muestra el formulario con los datos cargados para editar.
     *
     * @param string $id El slug del juego a editar.
     */
    public function editar(string $id)
    {
        /**
         * Adaptación del método del profesor:
         * Retornamos la vista inyectando el resultado de la búsqueda manual.
         */
        return view('juegos.editar', [
            'juego' => Juego::where('slug', $id)->firstOrFail(),
        ]);
    }

    /**
     * Procesa la actualización del registro en la base de datos.
     *
     * @param Request $request
     * @param string $id
     */
    public function actualizar(Request $request, string $id)
    {
        $juego = Juego::where('slug', $id)->firstOrFail();

        $request->validate([
            'titulo'            => 'required|min:2',
            'precio'            => 'required|numeric',
            'fecha_lanzamiento' => 'required',
            'sinopsis'          => 'required',
        ], [
            'titulo.required'            => 'El título del juego debe tener un valor.',
            'titulo.min'                 => 'El título del juego debe tener al menos :min caracteres.',
            'precio.required'            => 'El precio del juego debe tener un valor.',
            'precio.numeric'             => 'El precio del juego debe ser un valor numérico.',
            'fecha_lanzamiento.required' => 'La fecha de lanzamiento debe tener un valor.',
            'sinopsis.required'          => 'La sinopsis del archivo debe tener un valor.',
        ]);

        $data = $request->only(['titulo', 'precio', 'fecha_lanzamiento', 'sinopsis']);

        $juego->update($data);

        return redirect()
            ->route('juegos.listado')
            ->with('feedback.message', 'El juego <b>' . e($juego->titulo) . '</b> se actualizó correctamente.');
    }

    /**
     * Muestra la pantalla de confirmación antes de eliminar un registro.
     *
     * @param  string $id El identificador único del juego a eliminar (slug).
     * @return \Illuminate\View\View Renderiza la vista de advertencia.
     */
    public function confirmarEliminacion(string $id)
    {
        /**
         * Instanciamos el modelo de forma manual usando el campo slug.
         * El método firstOrFail garantiza la seguridad: si el ID provisto en la URL
         * no existe en la base de datos, aborta automáticamente con un error 404,
         * previniendo operaciones nulas.
         */
        $juego = Juego::where('slug', $id)->firstOrFail();

        return view('juegos.eliminar', [
            'juego' => $juego,
        ]);
    }

    /**
     * Elimina un juego específico de la base de datos.
     *
     * @param  string $id El identificador único del juego a eliminar (slug).
     * @return \Illuminate\Http\RedirectResponse Redirige al catálogo general tras confirmar la eliminación.
     */
    public function eliminar(string $id)
    {
        $juego = Juego::where('slug', $id)->firstOrFail();

        /**
         * Eliminamos usando el método delete().
         */
        $juego->delete();

        /**
         * Redireccionamos con retroalimentación.
         * Se aplica e() al título para asegurar que el contenido dinámico esté
         * debidamente saneado antes de imprimirse en la vista de confirmación.
         */
        return redirect()
            ->route('juegos.listado')
            ->with('feedback.message', 'El expediente de <b>' . e($juego->titulo) . '</b> fue eliminado de forma permanente.');
    }
}
