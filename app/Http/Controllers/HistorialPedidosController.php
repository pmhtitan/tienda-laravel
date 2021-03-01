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

    public function editarPedido($id){

        $historial = HistorialPedidos::find($id);
        if($historial){
            $hayhistorial = true;
        }else{
            $hayhistorial = false;
        }
        return view('historial.editar', [
            'historial' => $historial,
            'hayhistorial' => $hayhistorial,
        ]);
    }

    public function editado(Request $request){

        // Validación
        $validate = $this->validate($request, [
            'username' => 'required',
            'email' => 'required',
            'coste' => 'required|numeric',
            'estado' => 'required',
            'telefono' => 'required',
            'provincia' => 'required',
            'localidad' => 'required',
            'direccion' => 'required',
            'codigo_postal' => 'required',            
        ]);

        // Data
        $username = $request->input('username');
        $email = $request->input('email');
        $coste = $request->input('coste');
        $estado = $request->input('estado');
        $telefono = $request->input('telefono');
        $provincia = $request->input('provincia');
        $localidad = $request->input('localidad');
        $direccion = $request->input('direccion');
        $codigo_postal = $request->input('codigo_postal');
        $historial_id = $request->input('historial_id');
        $usuario_id = $request->input('usuario_id');

        // Update
        $historial = HistorialPedidos::find($historial_id);
        $historial->username = $username;
        $historial->email = $email;
        $historial->coste = $coste;
        $historial->estado = $estado;
        $historial->telefono = $telefono;
        $historial->provincia = $provincia;
        $historial->localidad = $localidad;
        $historial->direccion = $direccion;
        $historial->codigo_postal = $codigo_postal;

        $historial->update();

        return redirect()->route('historial.editar', ['id' => $historial_id])->with(['message' => 'Se han actualizado los datos del historial']);
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
