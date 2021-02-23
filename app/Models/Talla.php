<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    use HasFactory;

    protected $table = 'talla';

    /* Relationships */

     // One to many
     public function tallasproducto(){
        return $this->hasMany('App\Models\TallasProducto', 'id');
    }

     // One to many
    public function lineaspedidos(){
        return $this->hasMany('App\Models\LineasPedidos');
    }
    
}
