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

    public function index(){

        $productos = Producto::orderBy('id', 'desc')->limit(9)->get();

        return view('landing', [
            'productos' => $productos
        ]);
    }

    public function mostrarProducto($id){

        // Cargar cuatro productos random
        $productos_destacados = Producto::all()->random(4);
        
        // Obtenemos el producto seleccionado
        $producto_seleccionado = Producto::find($id);

        if(is_null($producto_seleccionado)){
            $message = "El producto no existe o no se encuentra disponible.";
        }else{
            $message = null;
        }

        return view('producto.mostrar', [
           'productos_destacados' => $productos_destacados,
           'producto' => $producto_seleccionado,
           'message' => $message
        ]);

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

    public function gestionProductos(){

        $productos = Producto::orderBy('id', 'desc')->paginate(12);
        
        return view('producto.gestion', [
            'productos' => $productos
        ]);
    }

    public function editar($id){
        $producto = Producto::find($id);
        $categorias = Categoria::all();

        if($producto){
            return view('producto.editar', [
                'producto' => $producto,
                'categorias' => $categorias
            ]);
        }else{
            return redirect()->route('home');
        }
    }

    public function editado(Request $request){

        // Validación
        $validate = $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            'stock' => 'required',
            'image_path' => 'image',
            'selectCategoria' => 'required',
        ]);
        
        // Recoger datos del formulario
        $producto_id = $request->input('producto_id');
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $precio = $request->input('precio');
        $stock = $request->input('stock');
        $categoria = $request->input('selectCategoria');
        $image_path = $request->file('image_path');

        // Buscar el objeto producto en la base de datos
        $producto = Producto::find($producto_id);
        
        $producto->nombre = $nombre;
        $producto->descripcion = $descripcion;
        $producto->precio = $precio;
        $producto->stock = $stock;
        $producto->categoria_id = $categoria;

        if($image_path){ // Si el usuario ha cambiado la foto
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('imagenes_productos')->put($image_path_name, File::get($image_path));
            $producto->imagen = $image_path_name;
        }

        // Actualizamos el producto
        $producto->update();

        return redirect()->route('producto.gestion')->with(['message' => 'Se ha actualizado el producto']);
    }

    public function eliminar($id){
        $producto = Producto::find($id);
        $producto->delete();

        return redirect()->route('producto.gestion')->with(['message' => 'Se ha borrado el producto']);
    }

    public function getImage($filename){
        $file = Storage::disk('imagenes_productos')->get($filename);

        return new Response($file, 200); 
    }
}

