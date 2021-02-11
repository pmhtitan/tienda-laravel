<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\HistorialPedidos;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth'); 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $this->middleware('auth');

        $logeado = Auth::user();

        if($logeado->roles == 'admin'){
            

            // Monthly Orders Chart
            $month = ['January','February','March','April','May','June', 'July','August','September','October','November','December'];

            $monthlyOrders = [];
            foreach ($month as $key => $value) {
                $monthlyOrders[] = HistorialPedidos::where(\DB::raw("DATE_FORMAT(created_at, '%M')"),$value)->where(\DB::raw("YEAR(created_at)"),\DB::raw("YEAR(CURDATE())"))->count();
               
            }
          
            // Order Status Chart
            $status = ['Pendiente', 'Confirmado', 'Enviado'];

            $statusOrders = [];
            foreach ($status as $key => $value) {
                $statusOrders[] = HistorialPedidos::where('estado', $value)->count();
            }
            
            return view('home')->with('month', json_encode($month))->with('monthlyOrders', json_encode($monthlyOrders, JSON_NUMERIC_CHECK))->with('status', json_encode($status))->with('statusOrders', json_encode($statusOrders, JSON_NUMERIC_CHECK));
                                

       }else{
            return view('home');
       }
    }
}
