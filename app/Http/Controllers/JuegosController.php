<?php

/**
 * Archivo: JuegosController.php
 * Función: Maneja el catálogo de juegos: listado, detalle, carga, edición y borrado.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Juego;
use App\Models\Rating;
use App\Models\Genero;
use Illuminate\Support\Facades\Storage;

class JuegosController extends Controller
{
    /**
     * Muestra el listado de juegos con sus filtros.
     */
    public function index(Request $request)
    {
        $parametrosBusqueda = [
            's-title' => $request->query('s-title'),
            's-clasificacion' => $request->query('s-clasificacion'),
            's-genero' => $request->query('s-genero'),
        ];

        if($parametrosBusqueda['s-genero']) {
            $genero = Genero::findOrFail($parametrosBusqueda['s-genero']);

            $consultaJuegos = $genero->juegos()
                ->with(['rating', 'generos']);
        } else {
            $consultaJuegos = Juego::with(['rating', 'generos']);
        }

        if($parametrosBusqueda['s-title'] !== null) {
            $consultaJuegos->where('titulo', 'LIKE', '%' . $parametrosBusqueda['s-title'] . '%');
        }

        if($parametrosBusqueda['s-clasificacion']) {
            $consultaJuegos->where('rating_fk', $parametrosBusqueda['s-clasificacion']);
        }

        $juegos = $consultaJuegos
            ->orderBy('titulo')
            ->paginate(4);

        return view('juegos.index', [
            'juegos' => $juegos,
            'clasificaciones' => Rating::all(),
            'generos' => Genero::all(),
            'parametrosBusqueda' => $parametrosBusqueda,
        ]);
    }

    /**
     * Muestra el detalle de un juego.
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
     * Muestra el formulario para crear un juego.
     */
    public function crear()
    {
        return view('juegos.crear', [
            'ratings' => Rating::all(),
            'generos' => Genero::all(),
        ]);
    }

    /**
     * Guarda un juego nuevo.
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
            'portada'           => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
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

        $juego->generos()->attach($request->input('generos', []));

        return redirect()
            ->route('juegos.listado')
            ->with('feedback.message', 'El cartucho <b>' . e($data['titulo']) . '</b> se guardó con éxito en el archivo.');
    }

    /**
     * Muestra el formulario para editar un juego.
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
     * Actualiza los datos de un juego.
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

        $juego->generos()->sync($request->input('generos', []));

        if(isset($data['portada']) && $portadaAnterior !== null && Storage::exists($portadaAnterior)) {
            Storage::delete($portadaAnterior);
        }

        return redirect()
            ->route('juegos.listado')
            ->with('feedback.message', 'El juego <b>' . e($juego->titulo) . '</b> se actualizó correctamente.');
    }

    /**
     * Muestra la pantalla para confirmar el borrado.
     */
    public function confirmarEliminacion(string $id)
    {
        $juego = Juego::where('slug', $id)->firstOrFail();

        if($juego->detallesCompras()->count() > 0) {
            return redirect()
                ->route('juegos.listado')
                ->with(
                    'feedback.message',
                    'El juego <b>' . e($juego->titulo) . '</b> no puede eliminarse porque forma parte de una compra registrada.'
                );
        }

        return view('juegos.eliminar', [
            'juego' => $juego,
        ]);
    }

    /**
     * Borra un juego.
     */
    public function eliminar(string $id)
    {
        $juego = Juego::where('slug', $id)->firstOrFail();

        if($juego->detallesCompras()->count() > 0) {
            return redirect()
                ->route('juegos.listado')
                ->with(
                    'feedback.message',
                    'El juego <b>' . e($juego->titulo) . '</b> no puede eliminarse porque forma parte de una compra registrada.'
                );
        }

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