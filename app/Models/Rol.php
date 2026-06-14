<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';

    protected $primaryKey = 'rol_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'nombre',
    ];

    public function usuarios()
    {
        return $this->hasMany(
            User::class,
            'rol_fk',
            'rol_id'
        );
    }
}
