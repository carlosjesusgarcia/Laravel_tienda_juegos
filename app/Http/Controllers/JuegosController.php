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
        $juegos = Juego::all();

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
        $juego = Juego::where('slug', $id)->firstOrFail();

        return view('juegos.detalles-juego', [
            'juego' => $juego,
        ]);
    }

    public function crear()
    {
        return view('juegos.crear');
    }

    /**
     * Almacenar un nuevo juego en la base de datos.
     */
    public function guardar(Request $request)
    {
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

        // 1. Extraemos los campos de texto, incluyendo ahora la descripción de la portada
        $data = $request->only(['titulo', 'precio', 'fecha_lanzamiento', 'sinopsis', 'portada_descripcion']);

        // 2. Upload de la imagen. Primero, preguntamos si existe una imagen.
        if($request->hasFile('portada')) {
            // Vamos a guardar este archivo en el "disk" configurado del file system (que pusimos en public).
            // Se guardará dentro de una subcarpeta llamada "portadas".
            $rutaArchivo = $request->file('portada')->store('portadas');

            // Agregamos este valor generado (ej: "portadas/hashunico.jpg") al array de datos.
            $data['portada'] = $rutaArchivo;
        }

        Juego::create($data);

        return redirect()
            ->route('juegos.listado')
            ->with('feedback.message', 'El cartucho <b>' . e($data['titulo']) . '</b> se guardó con éxito en el archivo.');
    }

    /**
     * Muestra el formulario con los datos cargados para editar.
     */
    public function editar(string $id)
    {
        return view('juegos.editar', [
            'juego' => Juego::where('slug', $id)->firstOrFail(),
        ]);
    }

    /**
     * Procesa la actualización del registro en la base de datos.
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

        // Actualizamos la captura de datos igual que en guardar()
        $data = $request->only(['titulo', 'precio', 'fecha_lanzamiento', 'sinopsis', 'portada_descripcion']);

        // Procesamiento de la nueva imagen si el usuario decidió subir una
        if($request->hasFile('portada')) {
            $rutaArchivo = $request->file('portada')->store('portadas');
            $data['portada'] = $rutaArchivo;
        }

        $juego->update($data);

        return redirect()
            ->route('juegos.listado')
            ->with('feedback.message', 'El juego <b>' . e($juego->titulo) . '</b> se actualizó correctamente.');
    }

    /**
     * Muestra la pantalla de confirmación antes de eliminar un registro.
     */
    public function confirmarEliminacion(string $id)
    {
        $juego = Juego::where('slug', $id)->firstOrFail();

        return view('juegos.eliminar', [
            'juego' => $juego,
        ]);
    }

    /**
     * Elimina un juego específico de la base de datos.
     */
    public function eliminar(string $id)
    {
        $juego = Juego::where('slug', $id)->firstOrFail();

        $juego->delete();

        return redirect()
            ->route('juegos.listado')
            ->with('feedback.message', 'El expediente de <b>' . e($juego->titulo) . '</b> fue eliminado de forma permanente.');
    }
}
