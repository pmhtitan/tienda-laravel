<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\LineasCarrito;
use App\Models\Producto;
use App\Models\User;
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
                                                            ->where('producto_id', $id)->get();
                
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

                $actualizar_subtotal = Carrito::where('id', $cart->id)->get();
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
                                            ->where('producto_id', $producto_id);
            $precio_producto = $productoSeleccionado->precio;           
            $quantity = $linea_carrito->unidades;
            $precio_prod_por_unidades = $precio_producto * $quantity;

            $linea_carrito->delete();
            
            $actualizar_subtotal = Carrito::where('id', $cart->id);
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

    public function downItem($index){

        $logeado = $this->getUser();

        if($logeado){

            //  Bajar una unidad en la linea del producto seleccionado
            $entityManager = $this->getDoctrine()->getManager();

            $cart = $entityManager->getRepository(Carrito::class)->findOneBy(
                ['usuario' => $logeado->getId()], null, 1);
            $carrito_id = $cart->getId();

            $productoSeleccionado = $entityManager->getRepository(Producto::class)->find($index);
            $precio_producto = $productoSeleccionado->getPrecio();
            
            //  bajar unidades
            $query = $entityManager->createQuery(
                "UPDATE App\Entity\LineasCarrito a SET a.unidades = a.unidades - 1 WHERE a.producto = '$index' AND a.carrito = '$carrito_id'"
            );
            //  bajar el subtotal del carrito
            $querySubtotal = $entityManager->createQuery(
                "UPDATE App\Entity\Carrito a SET a.subtotal = a.subtotal - $precio_producto WHERE a.id = '$carrito_id'"
               );
            $query->execute();
            $querySubtotal->execute();           

        }else{

            $carrito = $this->session->get('carrito');

                if($carrito[$index]['unidades'] == 1){
                    unset($carrito[$index]);
                }else{
                    $carrito[$index]['unidades']--;
                }
            
            $this->session->set('carrito', $carrito);
        }
       
        return $this->redirectToRoute('carrito_index');
    }


    public function delete_all(){

        $carrito = array();

        $this->session->set('carrito', $carrito);
        
        return $this->redirectToRoute('carrito_index');
    }



}
