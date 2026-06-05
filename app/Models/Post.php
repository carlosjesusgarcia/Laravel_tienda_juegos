<?php
/**
 * Archivo: Post.php
 * Función: Modelo Eloquent que representa una publicación o entrada de blog, gestionando su persistencia en la base de datos y la automatización de sus atributos.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Clase Post
 *
 * Abstracción ORM correspondiente a la tabla 'posts' en el sistema relacional.
 * Define la estructura de datos habilitada para asignación masiva, la clave primaria
 * personalizada y gestiona la generación automatizada de identificadores semánticos (slugs).
 */
class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $primaryKey = 'post_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'titulo',
        'slug',
        'subtitulo',
        'contenido',
        'imagen',
        'imagen_descripcion',
    ];

    /**
     * Inicializa la configuración de eventos estáticos del modelo Eloquent.
     *
     * Implementa observadores del ciclo de vida (hooks) para la generación automática
     * y mantenimiento del atributo 'slug'. Registra un evento de creación para la
     * derivación inicial a partir del título, y un evento de actualización que evalúa
     * transaccionalmente la mutación del título (isDirty) para regenerar el slug
     * correspondiente.
     *
     */
    protected static function booted()
    {
        static::creating(function ($post) {
            $post->slug = Str::slug($post->titulo);
        });

        static::updating(function ($post) {
            if ($post->isDirty('titulo')) {
                $post->slug = Str::slug($post->titulo);
            }
        });
    }

    /**
     * Define la clave de resolución para el enrutamiento implícito (Route Model Binding).
     *
     * Sobrescribe el comportamiento estándar de inyección de dependencias de Laravel,
     * determinando que las instancias de este modelo deben ser resueltas y consultadas
     * a través de la columna 'slug' en lugar del identificador autoincremental primario.
     *
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
