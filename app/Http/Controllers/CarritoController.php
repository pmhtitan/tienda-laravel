<?php

namespace App\Http\Controllers;

use App\Models\LineasCarrito;
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
            $cart = $logeado->carrito->count();
            $findAllLineas = 0;
            if($cart != 0){ // tenemos cart
               /* $cart = $logeado->carrito; */ // sobra             
                $findAllLineas = $logeado->carrito->lineascarrito->count();
            } /*else{
                $findAllLineas = 0;
            } */ // sobra
           
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

   
}
