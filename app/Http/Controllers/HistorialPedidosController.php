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

    public function buscador(Request $request){

        $search = $request->input('search');
        if(!empty($search)){
            $search_pedidos = HistorialPedidos::where('username', 'LIKE', '%'.$search.'%')
                                ->orWhere('email', 'LIKE', '%'.$search.'%')
                                ->orWhere('provincia', 'LIKE', '%'.$search.'%')
                                ->orWhere('localidad', 'LIKE', '%'.$search.'%')
                                ->orWhere('direccion', 'LIKE', '%'.$search.'%')
                                ->orWhere('codigo_postal', 'LIKE', '%'.$search.'%')
                                ->orderBy('id', 'desc')
                                ->paginate(8);

                
            if(count($search_pedidos) != 0){
                $hayhistorial = true;
            }else{
                $hayhistorial = false;
            }
            

            return view('historial.busqueda', [
                'historial' => $search_pedidos,
                'search' => $search,
                'hayhistorial' => $hayhistorial,
            ]);
                                
       }else{
            return redirect()->route('historial.gestion');
       }        
    }
}
