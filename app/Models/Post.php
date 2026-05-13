<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
     * Configuración de eventos del modelo para la generación automática del slug.
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
     * Indica a Laravel que use el 'slug' para las rutas en lugar del ID.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
