<?php
/**
 * Archivo: Compra.php
 * Función: Modelo Eloquent que representa una compra realizada por un usuario sobre un videojuego del catálogo.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Clase Compra
 *
 * Representa la relación entre un usuario registrado y un juego comprado.
 * Permite consultar los datos propios de la compra, el usuario asociado y el juego adquirido.
 */
class Compra extends Model
{
    protected $table = 'compras';

    protected $primaryKey = 'compra_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'user_fk',
        'juego_fk',
        'fecha_compra',
        'precio',
        'estado',
    ];

    protected $casts = [
        'fecha_compra' => 'date',
        'precio' => 'integer',
    ];

    /**
     * Define la relación con el usuario que realizó la compra.
     */
    public function usuario()
    {
        return $this->belongsTo(
            User::class,
            'user_fk',
            'id'
        );
    }

    /**
     * Define la relación con el juego comprado.
     */
    public function juego()
    {
        return $this->belongsTo(
            Juego::class,
            'juego_fk',
            'juego_id'
        );
    }

    /**
     * Configura el accesor y mutador para el atributo 'precio'.
     *
     * Mantiene el mismo criterio usado en el modelo Juego:
     * el precio se almacena como entero en la base de datos y se muestra dividido por 100.
     */
    public function precio(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }
}
