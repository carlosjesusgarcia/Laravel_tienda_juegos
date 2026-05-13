<?php
/**
 * Archivo: Juego.php
 * Función: Modelo Eloquent que representa la entidad de un producto o servicio (videojuego), gestionando su persistencia, eventos del ciclo de vida y mutación de atributos.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Clase Juego
 *
 * Abstracción ORM de la tabla 'juegos' en la base de datos. Establece los atributos
 * de asignación masiva, los tipos de casting nativos, la generación automatizada
 * de identificadores amigables (slugs) y la gestión de accesores/mutadores de estado.
 */
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
        'portada',
        'portada_descripcion',
    ];

    protected $casts = [
        'fecha_lanzamiento' => 'date',
        'precio' => 'integer',
    ];

    /**
     * Inicializa la configuración de eventos del modelo Eloquent.
     *
     * Registra los observadores estáticos de ciclo de vida. Aplica lógica transaccional
     * para derivar y asignar un 'slug' semántico a partir del atributo 'titulo' antes
     * de la inserción inicial. De igual manera, intercepta el evento de actualización
     * para regenerar el 'slug' si ocurre una mutación comprobada en el título.
     *
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
     * Sobrescribe el atributo predeterminado para la resolución del "Route Model Binding".
     *
     * Modifica el comportamiento estándar de la inyección de dependencias en las rutas
     * de Laravel para resolver instancias del modelo utilizando la columna 'slug',
     * optimizando las URLs bajo criterios SEO.
     *
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Configura el accesor y mutador para el atributo 'precio'.
     *
     * Aplica el patrón de diseño para operaciones financieras en bases de datos relacionales.
     * Transforma el flujo de entrada a una representación entera para garantizar
     * la integridad y precisión aritmética en el almacenamiento.
     */
    public function precio(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }
}
