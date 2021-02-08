<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenesProd extends Model
{
    use HasFactory;

    protected $table = 'imagenes_prod';

    /* Relationships */

    // Many to one
    public function producto(){
        return $this->belongsTo('App\Models\Producto', 'producto_id');
    }

}
