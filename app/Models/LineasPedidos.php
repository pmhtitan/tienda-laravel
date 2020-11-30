<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineasPedidos extends Model
{
    use HasFactory;

    protected $table = 'lineas_pedidos';

    /* Relationships */

   // Many to one
    public function pedido(){
        return $this->belongsTo('App\Models\Pedido', 'pedido_id');
    }

    // Many to one
    public function producto(){
        return $this->belongsTo('App\Models\Producto', 'producto_id');
    }

}
