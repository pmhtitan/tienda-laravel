<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;


class ProductoController extends Controller
{
    //
    public function __construct()
    {
       
    }

    public function viewCrearProducto(){      
        $categorias = Categoria::all();

        return view('producto.crear', [
            'categorias' => $categorias,
        ]);
    }

    public function crearProducto(Request $request){

        // Validación
        $validate = $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            'stock' => 'required',
            'image_path' => 'required|image',
            'selectCategoria' => 'required',
        ]);

        // Recoger datos del formulario
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $precio = $request->input('precio');
        $stock = $request->input('stock');
        $categoria = $request->input('selectCategoria');
        $image_path = $request->file('image_path');

        // Asignar valores al objeto
        $producto = new Producto();
        
        $producto->nombre = $nombre;
        $producto->descripcion = $descripcion;
        $producto->precio = $precio;
        $producto->stock = $stock;
        $producto->categoria_id = $categoria;
        $producto->imagen = null;

        // no hace nada, vuelve a la pantalla de creacion de producto sin errores

        // Subir imagen
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('imagenes_productos')->put($image_path_name, File::get($image_path));
            $producto->imagen = $image_path_name;
        }

        $producto->save();

        return redirect()->route('home')->with([
            'message' => 'El producto ha sido creado correctamente!!'
        ]);
        
    }
}
