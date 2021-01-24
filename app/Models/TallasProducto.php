<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TallasProducto extends Model
{
    use HasFactory;

    protected $table = 'tallas_producto';

    /* Relationships */

    // Many to one
    public function producto(){
        return $this->belongsTo('App\Models\Producto', 'producto_id');
    }

     // Many to one
     public function talla(){
        return $this->belongsTo('App\Models\Talla', 'talla_id');
    }
}
