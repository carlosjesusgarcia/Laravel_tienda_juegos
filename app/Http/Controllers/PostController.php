<?php
/**
 * Archivo: PostController.php
 * Función: Controlador responsable de gestionar el ciclo ABM (Alta, Baja y Modificación) y la visualización de las entradas del blog.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

/**
 * Clase PostController
 *
 * Gestiona la lógica de negocio y la capa de presentación asociada a las publicaciones del blog.
 * Implementa los métodos requeridos para listar, visualizar detalles, registrar, modificar y eliminar entradas en el sistema.
 */
class PostController extends Controller
{
    /**
     * Recupera y expone el listado completo de las entradas del blog.
     *
     */
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Recupera y expone el contenido detallado de una entrada específica basada en su identificador único.
     *
     * @param string $id El identificador único (slug) de la entrada a consultar.
     */
    public function leer(string $id)
    {
        $post = Post::where('slug', $id)->firstOrFail();

        return view('posts.leer', [
            'post' => $post,
        ]);
    }

    /**
     * Retorna la vista correspondiente al formulario de creación de una nueva entrada.
     *
     */
    public function crear()
    {
        return view('posts.crear');
    }

    /**
     * Valida y persiste una nueva entrada en la base de datos.
     *
     * Aplica reglas de validación sobre los datos provenientes del formulario y gestiona
     * el almacenamiento del archivo de imagen asociado en el sistema de archivos público,
     * previo a la instanciación e inserción del modelo.
     *
     */
    public function guardar(Request $request)
    {
        $request->validate([
            'titulo'    => 'required|min:2',
            'contenido' => 'required',
        ], [
            'titulo.required'    => 'El título de la entrada debe tener un valor.',
            'titulo.min'         => 'El título de la entrada debe tener al menos :min caracteres.',
            'contenido.required' => 'El contenido de la entrada no puede estar vacío.',
        ]);

        $data = $request->only(['titulo', 'subtitulo', 'contenido', 'imagen_descripcion']);

        if($request->hasFile('imagen')) {
            $rutaArchivo = $request->file('imagen')->store('blog');
            $data['imagen'] = $rutaArchivo;
        }

        Post::create($data);

        return redirect()
            ->route('posts.listado')
            ->with('feedback.message', 'La entrada <b>' . e($data['titulo']) . '</b> se publicó con éxito.');
    }

    /**
     * Retorna la vista que contiene el formulario de edición, pre-poblado con los datos de una entrada existente.
     *
     * @param string $id El identificador único (slug) de la entrada a modificar.
     */
    public function editar(string $id)
    {
        return view('posts.editar', [
            'post' => Post::where('slug', $id)->firstOrFail(),
        ]);
    }

    /**
     * Valida y procesa la actualización de una entrada existente en la base de datos.
     *
     * Evalúa los datos suministrados mediante reglas de validación estrictas y gestiona
     * la carga de un nuevo archivo de imagen en caso de ser proveído, actualizando la
     * entidad correspondiente de forma persistente.
     * @param string $id El identificador único (slug) de la entrada a actualizar.
     */
    public function actualizar(Request $request, string $id)
    {
        $post = Post::where('slug', $id)->firstOrFail();

        $request->validate([
            'titulo'    => 'required|min:2',
            'contenido' => 'required',
        ], [
            'titulo.required'    => 'El título de la entrada debe tener un valor.',
            'titulo.min'         => 'El título de la entrada debe tener al menos :min caracteres.',
            'contenido.required' => 'El contenido de la entrada no puede estar vacío.',
        ]);

        $data = $request->only(['titulo', 'subtitulo', 'contenido', 'imagen_descripcion']);

        if($request->hasFile('imagen')) {
            $rutaArchivo = $request->file('imagen')->store('blog');
            $data['imagen'] = $rutaArchivo;
        }

        $post->update($data);

        return redirect()
            ->route('posts.listado')
            ->with('feedback.message', 'La entrada <b>' . e($post->titulo) . '</b> se actualizó correctamente.');
    }

    /**
     * Retorna la vista de confirmación requerida de forma previa a la eliminación de un registro.
     *
     * @param string $id El identificador único (slug) de la entrada a eliminar.
     */
    public function confirmarEliminacion(string $id)
    {
        $post = Post::where('slug', $id)->firstOrFail();

        return view('posts.eliminar', [
            'post' => $post,
        ]);
    }

    /**
     * Ejecuta la eliminación física y definitiva de una entrada en la base de datos.
     *
     * @param string $id El identificador único (slug) de la entrada a eliminar.
     */
    public function eliminar(string $id)
    {
        $post = Post::where('slug', $id)->firstOrFail();

        $post->delete();

        return redirect()
            ->route('posts.listado')
            ->with('feedback.message', 'La entrada <b>' . e($post->titulo) . '</b> fue eliminada de forma permanente.');
    }
}
