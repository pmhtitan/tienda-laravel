<?php

namespace App\Http\Controllers;

use App\Models\Talla;
use App\Models\TallasProducto;
use Illuminate\Http\Request;

class TallaController extends Controller
{
    //

    public function viewCrearTalla(){
        return view('talla.crear');
    }

    public function crearTalla(Request $request){

        // Validación 
        $validate = $this->validate($request, [
            'nombre' => 'required'
        ]);

        // Recogemos datos del formulario
        $nombre = $request->input('nombre');

        // Asignamos al objeto los valores
        $talla = new Talla();

        $talla->nombre = $nombre;

        $talla->save();

        return redirect()->route('talla.gestion')->with([
            'message' => 'La talla ha sido creada correctamente!!'
        ]);
    }

    public function gestionTallas(){

        $tallas = Talla::paginate(12);

        return view('talla.gestion', [
            'tallas' =>$tallas
        ]);
    }

    public function editar($id){
        $talla = Talla::find($id);

        if($talla){
            return view('talla.editar', [
                'talla' => $talla
            ]);
        }else{
            return redirect()->route('home');
        }     
       
    }

    public function editado(Request $request){

         // Validación 
         $validate = $this->validate($request, [
            'nombre' => 'required'
        ]);

        // Recogemos datos del formulario
        $talla_id = $request->input('talla_id');
        $nombre = $request->input('nombre');

        $talla = Talla::find($talla_id);
        $talla->nombre = $nombre;

        $talla->update();

        return redirect()->route('talla.gestion')->with([
            'message' => 'La talla ha sido actualizada'
        ]);        
    }

    public function eliminar($id){
        $talla = Talla::find($id);
        // Para borrar una Talla con productos asociados, hay que borrar los productos asociados, y previamente las líneas de pedidos asociadas.
        // Luego no vamos a borrar una Talla mientras tenga productos asociados.

        $productos_asociados = TallasProducto::where('talla_id', $id)->get();
        if(count($productos_asociados) != 0){
            return redirect()->route('talla.gestion')->with(['message-error' => 'La talla tiene productos asociados']);
        }else{
            $talla->delete();

            return redirect()->route('talla.gestion')->with(['message' => 'Se ha borrado la talla']);
        }

        
    }
}
