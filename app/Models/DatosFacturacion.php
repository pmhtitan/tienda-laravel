<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosFacturacion extends Model
{
    use HasFactory;

    protected $table = 'datos_facturacion';

    /* Relationships */

    // Many to one
    public function usuario(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
