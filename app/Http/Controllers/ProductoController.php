<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\LineasCarrito;
use App\Models\LineasPedidos;
use App\Models\Producto;
use App\Models\Talla;
use App\Models\TallasProducto;
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
        $categorias = Categoria::orderBy('nombre', 'asc')->get();
       // $categorias_populares = Categoria::inRandomOrder()->limit(4)->get();

        return view('landing', [
            'productos' => $productos,
            'categorias' => $categorias,
        ]);
    }

    public function mostrarProducto($id){

        // Cargar cuatro productos random
        $productos_destacados = Producto::all()->random(4);
        
        // Obtenemos el producto seleccionado
        $producto_seleccionado = Producto::find($id);

        // Obtenemos las tallas del producto seleccionado
        $tallas_producto = TallasProducto::where('producto_id', $id)->get();

        if(is_null($producto_seleccionado)){
            $message = "El producto no existe o no se encuentra disponible.";
        }else{
            $message = null;
        }

        return view('producto.mostrar', [
           'productos_destacados' => $productos_destacados,
           'producto' => $producto_seleccionado,
           'tallas' => $tallas_producto,
           'message' => $message
        ]);

    }

    public function mostrarProdByCat(Request $request, $id){
        
        // Obtener la categoria buscada
        $categoria = Categoria::find($id);

        //  Sidebar categorias
        $categorias = Categoria::orderBy('nombre', 'asc')->get();

        if(empty($categoria)){
            return view('categoria.mostrarByCat', [
                'message' => "La categoría buscada no existe",
                'categorias' => $categorias
            ]);
        }else{
            $productos_cat = Producto::where('categoria_id', $categoria->id)->paginate(9);
            $nombre_categoria = $categoria->nombre;

            return view('categoria.mostrarByCat', [
                'message' => null,
                'nombre_categoria' => $nombre_categoria,
                'productos' => $productos_cat,
                'categorias' => $categorias
            ]);
        }
        
    }

    public function viewCrearProducto(){      
        $categorias = Categoria::all();
        $tallas = Talla::all();

        return view('producto.crear', [
            'categorias' => $categorias,
            'tallas' => $tallas
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
            'talla' => 'required',
        ]);

        // Recoger datos del formulario
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $precio = $request->input('precio');
        $stock = $request->input('stock');
        $categoria = $request->input('selectCategoria');
        $image_path = $request->file('image_path');
        $tallas = $request->input('talla');
        

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

        // Asignar tallas al producto
        foreach($tallas as $talla){

            $talla_producto = new TallasProducto();

            $talla_producto->producto_id = $producto->id;
            $talla_producto->talla_id = $talla;

            $talla_producto->save();
        }
        

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
        $tallas = Talla::all();
        $tallas_producto = TallasProducto::where('producto_id', $id)->get()->toArray();
        $tallas_prod = array();
            
            foreach($tallas_producto as $t_prod){
               array_push($tallas_prod, $t_prod['talla_id']);
            }

        if($producto){
            return view('producto.editar', [
                'producto' => $producto,
                'categorias' => $categorias,
                'tallas' => $tallas,
                'tallas_producto' => $tallas_prod,
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
            'talla' => 'required',
        ]);
        
        // Recoger datos del formulario
        $producto_id = $request->input('producto_id');
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $precio = $request->input('precio');
        $stock = $request->input('stock');
        $categoria = $request->input('selectCategoria');
        $image_path = $request->file('image_path');
        $tallas = $request->input('talla');

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

        // Reasignar tallas al producto (eliminar existentes, poner nuevas)

            // > Eliminar existentes
        $tallas_producto_old = TallasProducto::where('producto_id', $producto_id)->get();

        foreach($tallas_producto_old as $talla_prod_old){
            $talla_prod_old->delete();
        }

            // > Poner nuevas
        foreach($tallas as $talla){

            $talla_producto = new TallasProducto();

            $talla_producto->producto_id = $producto->id;
            $talla_producto->talla_id = $talla;

            $talla_producto->save();
    }

        return redirect()->route('producto.gestion')->with(['message' => 'Se ha actualizado el producto']);
    }

    public function eliminar($id){
        $producto = Producto::find($id);
        $existen_lineas_pedidos = LineasPedidos::where('producto_id', $id)->count();
        $existen_lineas_carrito = LineasCarrito::where('producto_id', $id)->get();
        if($existen_lineas_pedidos != 0){           
            // Hay lineas_pedidos, no se puede borrar ese producto (disable? / hacer historial de pedidos y separarlo de existencias?)
            return redirect()->route('producto.gestion')->with(['message-error' => 'El producto está asociado a historial de pedidos']);
        }elseif(count($existen_lineas_carrito) != 0){
            // No hay lineas_pedidos, se puede borrar el producto sin romper lineas existentes
            foreach($existen_lineas_carrito as $linea_carrito){
                $linea_carrito->delete();
            }
            //  Borrar lineas_tallas_producto asociadas al producto antes de su eliminación
            $lineas_talla_producto = TallasProducto::where('producto_id', $id)->get();
                foreach($lineas_talla_producto as $linea_talla_prod){
                    $linea_talla_prod->delete();
                }
            $producto->delete();
        }else{
            $producto->delete();
        }
       

        return redirect()->route('producto.gestion')->with(['message' => 'Se ha borrado el producto']);
    }

    public function getImage($filename){
        $file = Storage::disk('imagenes_productos')->get($filename);

        return new Response($file, 200); 
    }
}

