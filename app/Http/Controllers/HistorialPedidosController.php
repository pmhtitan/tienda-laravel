<?php

namespace App\Http\Controllers;

use App\Models\HistorialPedidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistorialPedidosController extends Controller
{
    //

    public function mostrar(){

        $logeado = Auth::user();

        $historial_user = HistorialPedidos::where('usuario_id', $logeado->id)->get();

        if(count($historial_user) != 0){
            $hayhistorial = true;
        }else{
            $hayhistorial = false;
        }

        return view('historial.mostrar', [
            'hayhistorial' => $hayhistorial,
            'historial' => $historial_user,
        ]);
    }
}
