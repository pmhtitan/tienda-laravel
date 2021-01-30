<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    //

    public function viewCrearCategoria(){
        return view('categoria.crear');
    }

    public function crearCategoria(Request $request){

        // Validación 
        $validate = $this->validate($request, [
            'nombre' => 'required'
        ]);

        // Recogemos datos del formulario
        $nombre = $request->input('nombre');

        // Asignamos al objeto los valores
        $categoria = new Categoria();

        $categoria->nombre = $nombre;

        $categoria->save();

        return redirect()->route('home')->with([
            'message' => 'La categoria ha sido creada correctamente!!'
        ]);
    }

    public function gestionCategorias(){

        $categorias = Categoria::orderBy('id', 'desc')->paginate(12);

        return view('categoria.gestion', [
            'categorias' => $categorias
        ]);
    }

    public function editar($id){
        $categoria = Categoria::find($id);

        if($categoria){
            return view('categoria.editar', [
                'categoria' => $categoria
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
        $categoria_id = $request->input('categoria_id');
        $nombre = $request->input('nombre');

        $categoria = Categoria::find($categoria_id);
        $categoria->nombre = $nombre;

        $categoria->update();

        return redirect()->route('categoria.gestion')->with([
            'message' => 'La categoria ha sido actualizada'
        ]);        
    }

    public function eliminar($id){
        $categoria = Categoria::find($id);
        // Para borrar una categoria con productos asociados, hay que borrar los productos asociados, y previamente las líneas de pedidos asociadas.
        // Luego no vamos a borrar una categoria mientras tenga productos asociados.

        $productos_asociados = Producto::where('categoria_id', $id)->get();
        if(count($productos_asociados) != 0){
            return redirect()->route('categoria.gestion')->with(['message-error' => 'La categoria tiene asociados productos']);
        }else{
            $categoria->delete();

            return redirect()->route('categoria.gestion')->with(['message' => 'Se ha borrado la categoria']);
        }

        
    }
}
