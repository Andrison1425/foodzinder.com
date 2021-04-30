<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $guarded = [];

    public function platos()
    {
        return $this->hasMany(Plato::class, 'restaurant_id', 'id');
    }
}
