<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carrito';

    /* Relationships */

    // Relación Uno a Uno
    public function user(){
        return $this->hasOne('App\Models\User', 'user_id');
   }

   // Relacion uno a muchos
   public function lineascarrito(){
       return $this->hasMany('App\Models\LineasCarrito');
   }
}
