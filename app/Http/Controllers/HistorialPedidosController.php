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

        $historial_user = HistorialPedidos::where('usuario_id', $logeado->id)->orderBy('created_at', 'DESC')->paginate(8);

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

    public function gestion(){

        $historial_pedidos = HistorialPedidos::orderBy('created_at', 'DESC')->paginate(8);
        if(count($historial_pedidos) != 0){
            $hayhistorial = true;
        }else{
            $hayhistorial = false;
        }

        return view('historial.gestion', [
            'historial' => $historial_pedidos,
            'hayhistorial' => $hayhistorial,
        ]);
    }

    public function estado(Request $request){

        $historial_id = $request->input('historial_id');
        $usuario_id = $request->input('usuario_id');
        $estado_pedido = $request->input('estadoPedido');

        $historial_pedido =  HistorialPedidos::where('id', $historial_id)->where('usuario_id', $usuario_id)->first();

        $historial_pedido->estado = $estado_pedido;
        $historial_pedido->update();

        return redirect()->route('historial.gestion')->with(['message' => 'Se ha actualizado el estado del pedido']);
    }
}
