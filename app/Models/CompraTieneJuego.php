<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CompraTieneJuego extends Model
{
    protected $table = 'compras_tienen_juegos';

    protected $primaryKey = 'compra_juego_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'compra_fk',
        'juego_fk',
        'cantidad',
        'precio_unitario',
        'descripcion',
    ];

    protected $casts = [
        'cantidad' => 'integer',
        'precio_unitario' => 'integer',
    ];

    /**
     * Define la relación con la compra a la que pertenece el detalle.
     */
    public function compra()
    {
        return $this->belongsTo(
            Compra::class,
            'compra_fk',
            'compra_id'
        );
    }

    /**
     * Define la relación con el juego incluido en la compra.
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
     * Configura el accesor y mutador para el atributo 'precio_unitario'.
     *
     * El precio se almacena como entero en la base de datos
     * y se muestra dividido por 100.
     */
    public function precioUnitario(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }
}