<?php
/**
 * Archivo: JuegosController.php
 * Función: Controlador encargado de gestionar el ciclo ABM (Alta, Baja y Modificación) y la visualización del catálogo de juegos.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Juego;
use App\Models\Rating;
use App\Models\Genero;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

/**
 * Clase JuegosController
 *
 * Gestiona la lógica de negocio y presentación para la entidad Juego.
 * Implementa los métodos necesarios para listar, detallar, crear,
 * actualizar y eliminar registros en el sistema.
 */
class JuegosController extends Controller
{
    /**
     * Recupera y muestra el catálogo completo de juegos.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('juegos.index', [
            'juegos' => Juego::with(['rating', 'generos'])->get(),
        ]);
    }

    /**
     * Recupera y muestra los detalles de un juego específico basado en su identificador único.
     *
     * @param string $id El identificador único (slug) del juego a consultar.
     */
    public function detalles(string $id)
    {
        $juego = Juego::with(['rating', 'generos'])
            ->where('slug', $id)
            ->firstOrFail();

        return view('juegos.detalles-juego', [
            'juego' => $juego,
        ]);
    }

    /**
     * Retorna la vista con el formulario para la creación de un nuevo juego.
     */
    public function crear()
    {
        return view('juegos.crear', [
            'ratings' => Rating::all(),
            'generos' => Genero::all(),
        ]);
    }

    /**
     * Valida y almacena un nuevo registro de juego en la base de datos.
     *
     * Gestiona la validación de los datos de entrada y el procesamiento del archivo
     * de portada, almacenándolo en el sistema de archivos público antes de persistir
     * el modelo.
     */
    public function guardar(Request $request)
    {
        $request->validate([
            'titulo'            => 'required|min:2',
            'precio'            => 'required|numeric',
            'fecha_lanzamiento' => 'required',
            'rating_fk'         => 'required|exists:ratings,rating_id',
            'generos'           => 'required',
            'generos.*'         => 'exists:generos,genero_id',
            'sinopsis'          => 'required',
        ], [
            'titulo.required'            => 'El título del juego debe tener un valor.',
            'titulo.min'                 => 'El título del juego debe tener al menos :min caracteres.',
            'precio.required'            => 'El precio del juego debe tener un valor.',
            'precio.numeric'             => 'El precio del juego debe ser un valor numérico.',
            'fecha_lanzamiento.required' => 'La fecha de lanzamiento debe tener un valor.',
            'rating_fk.required'         => 'Hay que elegir una clasificación para el juego.',
            'rating_fk.exists'           => 'La clasificación elegida no existe.',
            'generos.required'           => 'Hay que elegir al menos un género para el juego.',
            'generos.*.exists'           => 'Uno de los géneros elegidos no existe.',
            'sinopsis.required'          => 'La sinopsis del archivo debe tener un valor.',
        ]);

        $data = $request->only([
            'titulo',
            'precio',
            'fecha_lanzamiento',
            'rating_fk',
            'sinopsis',
            'portada_descripcion',
        ]);

        if($request->hasFile('portada')) {
            $rutaArchivo = $request->file('portada')->store('portadas');
            $data['portada'] = $rutaArchivo;
        }

        $juego = Juego::create($data);

        $juego->generos()->attach($request->input('generos'));

        return redirect()
            ->route('juegos.listado')
            ->with('feedback.message', 'El cartucho <b>' . e($data['titulo']) . '</b> se guardó con éxito en el archivo.');
    }

    /**
     * Retorna la vista con el formulario de edición pre-poblado con los datos del juego.
     *
     * @param string $id El identificador único (slug) del juego a editar.
     */
    public function editar(string $id)
    {
        return view('juegos.editar', [
            'juego' => Juego::with(['generos'])->where('slug', $id)->firstOrFail(),
            'ratings' => Rating::all(),
            'generos' => Genero::all(),
        ]);
    }

    /**
     * Valida y procesa la actualización de un registro existente en la base de datos.
     *
     * Aplica las reglas de validación sobre los datos modificados y gestiona
     * la carga de una nueva imagen de portada en caso de que se haya provisto,
     * actualizando el modelo correspondiente.
     */
    public function actualizar(Request $request, string $id)
    {
        $juego = Juego::where('slug', $id)->firstOrFail();

        $request->validate([
            'titulo'            => 'required|min:2',
            'precio'            => 'required|numeric',
            'fecha_lanzamiento' => 'required',
            'rating_fk'         => 'required|exists:ratings,rating_id',
            'generos'           => 'required',
            'generos.*'         => 'exists:generos,genero_id',
            'sinopsis'          => 'required',
            'portada'           => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'titulo.required'            => 'El título del juego debe tener un valor.',
            'titulo.min'                 => 'El título del juego debe tener al menos :min caracteres.',
            'precio.required'            => 'El precio del juego debe tener un valor.',
            'precio.numeric'             => 'El precio del juego debe ser un valor numérico.',
            'fecha_lanzamiento.required' => 'La fecha de lanzamiento debe tener un valor.',
            'rating_fk.required'         => 'Hay que elegir una clasificación para el juego.',
            'rating_fk.exists'           => 'La clasificación elegida no existe.',
            'generos.required'           => 'Hay que elegir al menos un género para el juego.',
            'generos.*.exists'           => 'Uno de los géneros elegidos no existe.',
            'sinopsis.required'          => 'La sinopsis del archivo debe tener un valor.',
            'portada.mimes'              => 'La portada debe ser una imagen JPG, JPEG, PNG o WEBP.',
            'portada.max'                => 'La portada no puede pesar más de 2 MB.',
        ]);

        $data = $request->only([
            'titulo',
            'precio',
            'fecha_lanzamiento',
            'rating_fk',
            'sinopsis',
            'portada_descripcion',
        ]);

        $portadaAnterior = $juego->portada;

        if($request->hasFile('portada')) {
            $rutaArchivo = $request->file('portada')->store('portadas');
            $data['portada'] = $rutaArchivo;
        }

        $juego->update($data);

        $juego->generos()->sync($request->input('generos'));

        if(isset($data['portada']) && $portadaAnterior !== null && Storage::exists($portadaAnterior)) {
            Storage::delete($portadaAnterior);
        }

        return redirect()
            ->route('juegos.listado')
            ->with('feedback.message', 'El juego <b>' . e($juego->titulo) . '</b> se actualizó correctamente.');
    }

    /**
     * Retorna la vista de confirmación requerida de forma previa a la eliminación de un registro.
     *
     * @param string $id El identificador único (slug) del juego a eliminar.
     */
    public function confirmarEliminacion(string $id)
    {
        $juego = Juego::where('slug', $id)->firstOrFail();

        return view('juegos.eliminar', [
            'juego' => $juego,
        ]);
    }

    /**
     * Ejecuta la eliminación física de un registro de juego en la base de datos.
     *
     * @param string $id El identificador único (slug) del juego a eliminar.
     */
    public function eliminar(string $id)
    {
        $juego = Juego::where('slug', $id)->firstOrFail();

        $portada = $juego->portada;

        $juego->generos()->detach();

        $juego->delete();

        if($portada !== null && Storage::exists($portada)) {
            Storage::delete($portada);
        }

        return redirect()
            ->route('juegos.listado')
            ->with('feedback.message', 'El juego <b>' . e($juego->titulo) . '</b> fue eliminado de forma permanente.');
    }
}
