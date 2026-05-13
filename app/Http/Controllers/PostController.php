<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Muestra el listado del blog desde la base de datos.
     */
    public function index()
    {
        // Traemos todos los posts. Más adelante podríamos agregar paginación u ordenarlos por fecha.
        $posts = Post::all();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

   /**
     * Muestra la vista de lectura de una entrada específica del blog.
     *
     * @param string $id El identificador único del post (slug).
     */
    public function leer(string $id)
    {
        $post = Post::where('slug', $id)->firstOrFail();

        return view('posts.leer', [
            'post' => $post,
        ]);
    }

    public function crear()
    {
        return view('posts.crear');
    }

    /**
     * Almacenar una nueva entrada en la base de datos.
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

        // Extraemos los campos permitidos
        $data = $request->only(['titulo', 'subtitulo', 'contenido', 'imagen_descripcion']);

        // Upload de la imagen.
        if($request->hasFile('imagen')) {
            // Se guardará dentro de una subcarpeta llamada "blog" en storage/app/public
            $rutaArchivo = $request->file('imagen')->store('blog');
            $data['imagen'] = $rutaArchivo;
        }

        Post::create($data);

        return redirect()
            ->route('posts.listado')
            ->with('feedback.message', 'La entrada <b>' . e($data['titulo']) . '</b> se publicó con éxito.');
    }

    /**
     * Muestra el formulario con los datos cargados para editar una entrada.
     */
    public function editar(string $id)
    {
        return view('posts.editar', [
            'post' => Post::where('slug', $id)->firstOrFail(),
        ]);
    }

    /**
     * Procesa la actualización de la entrada en la base de datos.
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
     * Muestra la pantalla de confirmación antes de eliminar una entrada.
     */
    public function confirmarEliminacion(string $id)
    {
        $post = Post::where('slug', $id)->firstOrFail();

        return view('posts.eliminar', [
            'post' => $post,
        ]);
    }

    /**
     * Elimina un post específico de la base de datos.
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
