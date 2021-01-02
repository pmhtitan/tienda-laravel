<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\LineasCarrito;
use App\Models\Producto;
use App\Models\User;
use App\Models\DatosFacturacion;
use App\Models\LineasPedidos;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class CarritoController extends Controller
{
    
    public function index(Request $request){

        $user = new User();

        $logeado = Auth::user();
        if($logeado){
            $findAllLineas = 0;   
            if($logeado->carrito != null){
                $cart = $logeado->carrito->count();         
                if($cart != 0){ // tenemos cart           
                    $findAllLineas = $logeado->carrito->lineascarrito->count();
                }
            } 
           
            if($findAllLineas != 0){
                $findAllLineas = $logeado->carrito->lineascarrito;
                
                foreach($findAllLineas as $productObj){
                    $carritoSesion[] =array(
                        "id_producto" => $productObj->id,
                        "precio" => $productObj->precio,
                        "unidades" => $productObj->unidades,
                        "producto" => $productObj->producto,
                    );
                }
            }else{
                $carritoSesion = array();
            }
           
        }else{
            $carritoSesion = $request->session()->get('carrito');                
        }
        

        $shippingPrice = "6.75";

        $stats = $user->statsCarrito($carritoSesion, $shippingPrice);
        $stats['shippingPrice'] = number_format($shippingPrice, 2, ',', ' ');
        $stats['subtotal'] = number_format($stats['subtotal'], 2, ',', ' ');
        $stats['total'] = number_format($stats['total'], 2, ',', ' ');          

        if($carritoSesion && count($carritoSesion) >= 1){
            $carrito = $carritoSesion;
        }else{
            $carrito = array();
        }

        return view('carrito.mostrar', [
            'carrito' => $carrito,
            'stats' => $stats,
        ]);
    }

     //  AJAX REQUEST que lleva la Quantity del item por POST
   public function guardar_quantity_session(Request $request){

    if (!$request->isXmlHttpRequest()) {
        return new JsonResponse(array(
            'status' => 'Error',
            'message' => 'Ha ocurrido un error al almacenar las unidades del shopping cart'),
        400);
    }
        $quantity = $request->request->get('quantity');
       
        $request->session()->put('quantity',$quantity);
    
    return new JsonResponse( array(
        'status' => 'Fine',
        'message' => 'Todo correcto'),    
    );
   }

   public function addItem(Request $request, $id){

        $logeado = Auth::user();

        (int) $quantity = $request->session()->get('quantity'); // quantity de los items antes de llegar aqui

        if(empty($quantity)){
            $quantity = 1;
        }

        if($logeado){
            $cart = $logeado->carrito;
            if(!empty($cart)){
               // Existe carrito
                // Comprobar si el producto seleccionado, está ya en el carrito. (si hay lineas del producto)
                $carrito_count = LineasCarrito::where('carrito_id', $cart->id)
                                                            ->where('producto_id', $id)->count();

                $linea_carrito_seleccionado = LineasCarrito::where('carrito_id', $cart->id)
                                                            ->where('producto_id', $id)->first();
                
                $banderaQuery_Prod = false;
                if($carrito_count == 0){
                    // No existen lineas -> save

                    $productoSeleccionado = Producto::find($id);
                    $linea_carrito = new LineasCarrito();
                    $linea_carrito->carrito_id = $cart->id;
                    $linea_carrito->producto_id = $productoSeleccionado->id;
                    $linea_carrito->precio = $productoSeleccionado->precio;
                    $linea_carrito->unidades = $quantity;
                    $linea_carrito->save();
                    $banderaQuery_Prod = true;
                    

                }else{ 
                    //   el producto ya estaba en la caja, aumentar unidades
                    $linea_carrito_seleccionado->unidades += $quantity;
                    $linea_carrito_seleccionado->update();                    
                }

                // Aumentar el subtotal
                if(!$banderaQuery_Prod){
                    $productoSeleccionado = Producto::find($id);
                }
            
                $precio_subtotal = $productoSeleccionado->precio * $quantity;

                $actualizar_subtotal = Carrito::where('id', $cart->id)->first();
                $actualizar_subtotal->subtotal += $precio_subtotal;
                $actualizar_subtotal->update();

            }else{
                //  No existe carrito, lo creamos
                $productoSeleccionado = Producto::find($id);
                $subtotal = $productoSeleccionado->precio * $quantity;
                $cart = new Carrito();
                $cart->usuario_id = $logeado->id;
                $cart->subtotal = $subtotal;
                $cart->save();

                // y creamos las lineas del pedido
                $linea_carrito = new LineasCarrito();
                $linea_carrito->carrito_id = $cart->id;
                $linea_carrito->producto_id = $productoSeleccionado->id;
                $linea_carrito->precio = $productoSeleccionado->precio;
                $linea_carrito->unidades = $quantity;
                $linea_carrito->save();

            }
        }else{ // usuario no logeado
            $carrito = $request->session()->get('carrito');

            if($carrito){
                $counter = 0;
                foreach($carrito as $indice => $elemento){
                    if($elemento['id_producto'] == $id){
                        for($i = 1; $i <= $quantity; $i++){
                            $carrito[$indice]['unidades']++;
                        }                    
                        $counter++;
                    }
                }
            }
            if(!isset($counter) || $counter == 0){

                //  Conseguir producto
                $productoSeleccionado = Producto::find($id);

                if(empty($quantity)){
                    $quantity = 1;
                }
                if($productoSeleccionado){
                    $carrito[] =array(
                        "id_producto" => $productoSeleccionado->id,
                        "precio" => $productoSeleccionado->precio,
                        "unidades" => $quantity,
                        "producto" => $productoSeleccionado
                    );
                }
            }
            $request->session()->put('carrito', $carrito);
        }
        return redirect()->route('carrito.index');
   }


   public function removeItem(Request $request,$index){ 
    //  En caso de carrito sesion, index = index,
    //  En caso de carrito cuenta, index = idProductoSeleccionado

    $logeado = Auth::user();

        if($logeado){

            //  Quitar la lineaCarrito del producto seleccionado, cuyo carrito es el del usuario logeado
            $cart = $logeado->carrito;

            $productoSeleccionado = Producto::find($index);
            $producto_id = $productoSeleccionado->id;
            $linea_carrito = LineasCarrito::where('carrito_id', $cart->id)
                                            ->where('producto_id', $producto_id)->first();
            $precio_producto = $productoSeleccionado->precio;           
            $quantity = $linea_carrito->unidades;
            $precio_prod_por_unidades = $precio_producto * $quantity;

            $linea_carrito->delete();
            
            $actualizar_subtotal = Carrito::where('id', $cart->id)->first();
            $actualizar_subtotal->subtotal -= $precio_prod_por_unidades;
            $actualizar_subtotal->update();

        }else{
        
            $carrito = $request->session()->get('carrito');

                //   Remover producto de la sesión carrito
                unset($carrito[$index]);

            $request->session()->put('carrito', $carrito);

        }

        return redirect()->route('carrito.index');

        // me queda upitem, downitem, etc
    }

    public function upItem(Request $request, $index){

        $logeado = Auth::user();

        if($logeado){

            //  Subir una unidad en la linea del producto seleccionado
            $cart = $logeado->carrito;
            
            $productoSeleccionado = Producto::find($index);
            $producto_id = $productoSeleccionado->id;
            $precio_producto = $productoSeleccionado->precio;

            //  aumentar unidades
            $lineas_carrito = LineasCarrito::where('producto_id', $producto_id)
                                            ->where('carrito_id', $cart->id)->first(); // he usado first porque al ser una relación uno a muchos lo trata como una colección y entonces no deja acceder a primer nivel.
                                            
            $lineas_carrito->unidades += 1;            
            $lineas_carrito->update();
            
            //  aumentar el subtotal del carrito
            $cart->subtotal += $precio_producto;
            $cart->update();       

        }else{

            $carrito = $request->session()->get('carrito');

                $carrito[$index]['unidades']++;

            $request->session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.index');
        
    }

    public function downItem(Request $request, $index){

        $logeado = Auth::user();

        if($logeado){

            //  Bajar una unidad en la linea del producto seleccionado
            $cart = $logeado->carrito;

            $productoSeleccionado = Producto::find($index);
            $producto_id = $productoSeleccionado->id;
            $precio_producto = $productoSeleccionado->precio;
            
            //  bajar unidades
            $lineas_carrito = LineasCarrito::where('producto_id', $producto_id)
                                            ->where('carrito_id', $cart->id)->first(); // he usado first porque al ser una relación uno a muchos lo trata como una colección y entonces no deja acceder a primer nivel.

            if($lineas_carrito->unidades == 1){
                $lineas_carrito->delete();
            }else{            
                $lineas_carrito->unidades -= 1;            
                $lineas_carrito->update();
            }
                //  bajar el subtotal del carrito
                $cart->subtotal -= $precio_producto;
                $cart->update();         
            
        }else{

            $carrito = $request->session()->get('carrito');

                if($carrito[$index]['unidades'] == 1){
                    unset($carrito[$index]);
                }else{
                    $carrito[$index]['unidades']--;
                }
            
            $request->session()->put('carrito', $carrito);
        }
       
        return redirect()->route('carrito.index');
    }


    public function delete_all(Request $request){

        $carrito = array();

        $request->session()->put('carrito', $carrito);
        
        return redirect()->route('carrito.index');
    }

    public function checkout(Request $request){

        $logeado = Auth::user();
        
        if($logeado){
            $findAllLineas = 0;   
            if($logeado->carrito != null){
                $cart = $logeado->carrito->count();         
                if($cart != 0){ // tenemos cart           
                    $findAllLineas = $logeado->carrito->lineascarrito->count();
                }
            } 
           
            if($findAllLineas != 0){
                $findAllLineas = $logeado->carrito->lineascarrito;
                
                foreach($findAllLineas as $productObj){
                    $carrito[] =array(
                        "id_producto" => $productObj->producto_id,
                        "precio" => $productObj->precio,
                        "unidades" => $productObj->unidades,
                        "producto" => $productObj->producto,
                    );
                }
            }else{
                return redirect()->route('carrito.index');
            }
           
        }else{
            $carrito = $request->session()->get('carrito');                
        }

        $user = new User();
        $shippingPrice = "6.75";
        $stats = $user->statsCarrito($carrito, $shippingPrice);

        $request->session()->put('stats', $stats); // guardamos los stats para manejarlos en checkout_start
        $request->session()->put('carrito_ready', $carrito);

        if($logeado){
            $existeFacturacion = $logeado->datosFacturacion->count();
            $datosFacturacion_logeado = $logeado->datosFacturacion->first();

            //  1, significa que hay datos de facturación existentes
            if($existeFacturacion != 0){
                //  Le llevamos a la view de checkout, con los datos de facturación
                return view('carrito.checkout', [
                    'datosfacturacion' => $datosFacturacion_logeado,
                    'datosexisten' => true,
                    'carrito' => $carrito,
                    'stats' => $stats
                ]);
            }else{
                return view('carrito.checkout', [
                    'datosexisten' => false,
                    'carrito' => $carrito,
                    'stats' => $stats
                ]);
                
            }
        }else{
            return view('carrito.checkout', [
                'datosexisten' => false,
                'carrito' => $carrito,
                'stats' => $stats
            ]);
        }
    }
    
    public function checkout_start(Request $request){        

        $logeado = Auth::user();

            // Validación
            $validate = $this->validate($request, [
                'nombre' => 'required|string',
                'email' => 'required|string|email',
                'telefono' => 'required|integer', /* size:9 */
                'provincia' => 'required|string',
                'localidad' => 'required|string',
                'direccion' => 'required|string',
                'codigo_postal' => 'required|integer' 
            ]);

            // Recoger datos del formulario 
            $nombre = $request->input('nombre');
            $email = $request->input('email');
            $telefono = $request->input('telefono');
            $provincia = $request->input('provincia');
            $localidad = $request->input('localidad');
            $direccion = $request->input('direccion');
            $codigo_postal = $request->input('codigo_postal');

            // Recuperamos stats y carrito de la función anterior
            $stats = $request->session()->get('stats');
            $carrito = $request->session()->get('carrito_ready');

            if($logeado){

                $existefacturacion = $logeado->datosFacturacion->count();

                if($existefacturacion == 0){ // No existen datos de facturacion >> save

                    $datosfacturacion = new DatosFacturacion();

                    $datosfacturacion->usuario_id = Auth::user()->id;
                    $datosfacturacion->nombre = $nombre;
                    $datosfacturacion->email = $email;
                    $datosfacturacion->telefono = $telefono;
                    $datosfacturacion->provincia = $provincia;
                    $datosfacturacion->localidad = $localidad;
                    $datosfacturacion->direccion = $direccion;
                    $datosfacturacion->codigo_postal = $codigo_postal;

                    $datosfacturacion->save();

                }else{  //  Existen datos >> update

                    $datosfacturacion = $logeado->datosFacturacion->first();

                    $datosfacturacion->nombre = $nombre;
                    $datosfacturacion->email = $email;
                    $datosfacturacion->telefono = $telefono;
                    $datosfacturacion->provincia = $provincia;
                    $datosfacturacion->localidad = $localidad;
                    $datosfacturacion->direccion = $direccion;
                    $datosfacturacion->codigo_postal = $codigo_postal;

                    $datosfacturacion->update();
                }
                
                 //  Pedido
                 $pedido = new Pedido();
                 $date = new \DateTime('now');
                 $coste = $stats['total'];
                 $pedido->usuario_id = $logeado->id;
                 $pedido->coste = $coste;
                 $pedido->estado = "pendiente";                
                
                 $pedido->save();

                 $idPedido = $pedido->id;
                
                 $objetoPedido = Pedido::find($idPedido)->first();
 
                 //  Lineas Pedidos
                 foreach($carrito as $producto){
                     $objetoProducto = Producto::where('id', $producto['id_producto'])->first();
                     $lineaPedido = new LineasPedidos();
                     $lineaPedido->pedido_id = $objetoPedido->id;
                     $lineaPedido->producto_id = $objetoProducto->id;
                     $lineaPedido->unidades = $producto['unidades'];                
                     
                     $lineaPedido->save();
                 }

                 // Borrar carrito (borrar productos asociados al carrito y dejarlo vacío)

                 $cartID = $logeado->carrito->id;

                    $lineasCarrito_repo = LineasCarrito::where('carrito_id', $cartID)->get();   

                    foreach($lineasCarrito_repo as $linea){
                        $linea->delete();                          
                    }               

                    //  Update - Subtotal del carrito a 0
                    $carrito = $logeado->carrito;
                    $carrito->subtotal = 0;
                    $carrito->update();

                    $carrito_ready = $request->session()->get('carrito_ready');

                 return view('pedido.datosCompra', [
                    'carrito' => $carrito_ready,
                    'stats' => $stats
                 ]);

            }else{
            
            $date = new \DateTime('now');
            $user = new User();

            $user->name = $nombre;
            $user->session_user = TRUE;
            $user->save();
            
            // add database DatosFacturacion
            $datosfacturacion = new DatosFacturacion();

            $datosfacturacion->usuario_id = $user->id;
            $datosfacturacion->nombre = $nombre;
            $datosfacturacion->email = $email;
            $datosfacturacion->telefono = $telefono;
            $datosfacturacion->provincia = $provincia;
            $datosfacturacion->localidad = $localidad;
            $datosfacturacion->direccion = $direccion;
            $datosfacturacion->codigo_postal = $codigo_postal;

            $datosfacturacion->save();

            //  Seteamos el email en sesion para asi poder mostrar los datos de facturacion en otras pestañas,
            //      buscando por email en DatosFacturacion.
            $request->session()->put('email', $email);

            // -> Aquí le llevariamos a la plataforma de pago (payment gateway), y tras confirmar pago y/o tarjeta, redirigimos a mostrar la compra efectuada.

            //  Guardamos el pedido completo, y las lineas de pedido correspondientes a los productos asociados a la compra

                //  Pedido
                $pedido = new Pedido();
                $coste = $stats['total'];
                $pedido->usuario_id = $user->id;
                $pedido->coste = $coste;
                $pedido->estado = "pendiente";                
               
                $pedido->save();

                //  necesito recoger el id del ultimo pedido efectuado (este), para las lineas de pedido.
                //  +Problema => si queremos realmente que cuando un usuario se cree una cuenta nueva, y se le asignen pedidos pasados, tendríamos que rediseñar la tabla de pedidos, y en vez de apuntar a usuario_id, que apunte a datosFacturacion, y separar la logica de por cuenta y sesion?
                
                $idPedido = $pedido->id;

                //  Lineas Pedidos
                foreach($carrito as $producto){
                    $objetoProducto = Producto::where('id', $producto['id_producto'])->first();
                    $lineaPedido = new LineasPedidos();
                    $lineaPedido->pedido_id = $idPedido;
                    $lineaPedido->producto_id = $objetoProducto->id;
                    $lineaPedido->unidades = $producto['unidades'];                
                    
                    $lineaPedido->save();
                }


                $carritoVacio = array();

                $request->session()->put('carrito', $carritoVacio);
                $carrito_ready = $request->session()->get('carrito_ready');
                
                return view('pedido.datosCompra', [
                    'carrito' => $carrito_ready,
                    'stats' => $stats
                 ]);
            }           
    }



}
