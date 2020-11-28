<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    
    protected $table = 'pedido';

    /* Relationships */

   // Many to one
    public function user(){
        return $this->belongsTo('App\Models\User');
}

    // One to many
    public function lineaspedidos(){
        return $this->hasMany('App\Models\LineasPedidos');
    }
}
