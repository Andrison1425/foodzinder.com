<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'nombre',
        'direccion',
        'ciudad',
        'pais',
        'telefono',
        'posiciones'
    ];

    public function platos()
    {
        return $this->hasMany(Plato::class, 'restaurant_id', 'id');
    }
}
