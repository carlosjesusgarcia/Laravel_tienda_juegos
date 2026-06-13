<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $table = 'generos';

    protected $primaryKey = 'genero_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'nombre',
    ];

    /**
     * Relación muchos a muchos entre géneros y juegos.
     */
    public function juegos()
    {
        return $this->belongsToMany(
            Juego::class,
            'juegos_tienen_generos',
            'genero_fk',
            'juego_fk',
            'genero_id',
            'juego_id'
        );
    }
}
