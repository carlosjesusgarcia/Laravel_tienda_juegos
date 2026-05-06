<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Juego extends Model
{
    use HasFactory;

    protected $table = 'juegos';

    protected $primaryKey = 'juego_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'titulo',
        'slug',
        'precio',
        'fecha_lanzamiento',
        'sinopsis',
    ];

    protected $casts = [
        'fecha_lanzamiento' => 'date',
        'precio' => 'integer',
    ];

    /**
     * Configuración de eventos del modelo.
     *
     * Como parte del desarrollo profesional del sistema, se ha implementado una lógica
     * automatizada para la generación de "slugs". Esta técnica permite transformar títulos
     * legibles (ej: "Super Mario") en cadenas optimizadas para URLs (ej: "super-mario").
     *
     * Se utilizan los "model hooks" para garantizar la integridad de los datos:
     * 1. creating: Genera el slug inicial al registrar un cartucho.
     * 2. updating: Detecta si el título ha sido modificado mediante isDirty() y,
     *    en tal caso, regenera el slug para mantener la coherencia en las rutas.
     */
    protected static function booted()
    {
        static::creating(function ($juego) {
            $juego->slug = Str::slug($juego->titulo);
        });

        static::updating(function ($juego) {
            if ($juego->isDirty('titulo')) {
                $juego->slug = Str::slug($juego->titulo);
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

    /*--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    | Los accessors y mutators son funciones que nos permite modificar
    | el valor de un atributo de Eloquent cuando se lo accede para
    | lectura o cuando le asignamos un nuevo valor, respectivamente.
    | Para crearlos tenemos que definir un método que se llame igual
    | que el atributo, pero en camelCase.
    | Adicionalmente, este método *debe* tipar el retorno como una
    | instancia de \Illuminate\Database\Eloquent\Casts\Attribute.
    +--------------------------------------------------------------------------*/
    public function precio(): Attribute
    {
        // Finalmente, tenemos que retornar una llamada al método Attribute::make().
        // Este método recibe 2 parámetros, ambos opcionales:
        // 1. ?callable. get. La función que transforma el valor en el acceso a lectura.
        // El callable recibe el valor actual como parámetro, y debe retornar el valor modificado.
        // 2. ?callable. set. La función que transforma el valor en la asignación.
        // El callable recibe como parámetro el valor nuevo a asignar, y debe retornar el valor modificado.
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }
}
