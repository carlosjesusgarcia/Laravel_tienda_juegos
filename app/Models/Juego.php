<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     * Laravel por defecto usaría "juegos" igualmente (plural de Juego),
     * pero aquí lo dejamos explícito para mayor claridad.
     *
     * @var string
     */
    protected $table = 'juegos';

    /**
     * La clave primaria de la tabla.
     * Laravel por defecto espera una columna llamada "id",
     * pero en tu caso se llama "juego_id", así que hay que indicarlo.
     *
     * @var string
     */
    protected $primaryKey = 'juego_id';

    /**
     * Indica si la clave primaria es autoincremental.
     * En tu migración usaste $table->id('juego_id'), así que sí lo es.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Tipo de dato de la clave primaria.
     * Como es un entero autoincremental, usamos 'int'.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Campos que se pueden asignar de forma masiva (mass assignment).
     * Esto permite usar Juego::create([...]) sin que Laravel lo bloquee.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'precio',
        'fecha_lanzamiento',
        'sinopsis',
    ];

    /**
     * Conversión automática de tipos.
     * Laravel transformará estos campos cuando los uses:
     *
     * - fecha_lanzamiento → objeto fecha (Carbon)
     * - precio → entero
     *
     * Esto permite hacer cosas como:
     * $juego->fecha_lanzamiento->format('Y')
     *
     * @var array
     */
    protected $casts = [
        'fecha_lanzamiento' => 'date',
        'precio' => 'integer',
    ];
}
