<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineasCarrito extends Model
{
    use HasFactory;

    protected $table = 'lineas_carrito';

    /* Relationships */

    // Many to one
    public function carrito(){
        return $this->belongsTo('App\Models\Carrito', 'carrito_id'); 
    }

    // Many to one
    public function producto(){
        return $this->belongsTo('App\Models\Producto', 'producto_id'); // asi está bien
    }
}
