<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineasHistorial extends Model
{
    use HasFactory;

    protected $table = 'lineas_historial';

    /* Relationships */

    // Many to one
    public function historial(){
        return $this->belongsTo('App\Models\HistorialPedidos', 'historial_id');
    }
}
