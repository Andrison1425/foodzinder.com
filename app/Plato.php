<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plato extends Model
{
    protected $table = 'platos';

    protected $fillable = [
        'nombre',
        'precio',
        'imagen',
        'descripcion',
        'categoria',
        'status'
    ];
}
