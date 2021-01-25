<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialPedidos extends Model
{
    use HasFactory;

    protected $table = 'historial_pedidos';

    /* Relationships */

    // Many to one
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    // One to many
    public function lineashistorial(){
        return $this->hasMany('App\Models\LineasHistorial');
    }
}
