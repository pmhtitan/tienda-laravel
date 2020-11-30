<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';

    /* Relationships */
    
    // Many to one
    public function categoria(){
        return $this->belongsTo('App\Models\Categoria', 'categoria_id');
    }

    // One to many
    public function lineaspedidos(){
        return $this->hasMany('App\Models\LineasPedidos');
    }

    // One to many
    public function lineascarrito(){
        return $this->hasMany('App\Models\LineasCarrito');
    }

   
}
