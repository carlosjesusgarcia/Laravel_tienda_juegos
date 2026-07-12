<?php
/**
 * Archivo: Compra.php
 * Función: Modelo Eloquent que representa una compra realizada por un usuario sobre uno o varios videojuegos del catálogo.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Clase Compra
 *
 * Representa una compra realizada por un usuario registrado.
 * Permite consultar los datos propios de la compra, el usuario asociado y los juegos adquiridos.
 */
class Compra extends Model
{
    protected $table = 'compras';

    protected $primaryKey = 'compra_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'user_fk',
        'fecha_compra',
        'total',
        'estado',
    ];

    protected $casts = [
        'fecha_compra' => 'date',
        'total' => 'integer',
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
     * Define la relación con los detalles incluidos en la compra.
     */
    public function detalles()
    {
        return $this->hasMany(
            CompraTieneJuego::class,
            'compra_fk',
            'compra_id'
        );
    }

    /**
     * Define la relación con los juegos incluidos en la compra.
     */
    public function juegos()
    {
        return $this->belongsToMany(
            Juego::class,
            'compras_tienen_juegos',
            'compra_fk',
            'juego_fk',
            'compra_id',
            'juego_id'
        )->withPivot(
            'cantidad',
            'precio_unitario',
            'descripcion'
        );
    }

    /**
     * Configura el accesor y mutador para el atributo 'total'.
     *
     * Mantiene el mismo criterio usado en el modelo Juego:
     * el total se almacena como entero en la base de datos y se muestra dividido por 100.
     */
    public function total(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }
}