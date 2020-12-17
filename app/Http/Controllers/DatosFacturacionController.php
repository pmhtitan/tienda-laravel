<?php

namespace App\Http\Controllers;

use App\Models\DatosFacturacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatosFacturacionController extends Controller
{
    //

    public function gestionDatos(){

        $usuario_id = Auth::user()->id;
        $existefacturacion = DatosFacturacion::where('usuario_id', $usuario_id)->count(); // lo hacemos con Count porque ->get() me devuelve siempre true si no hay.
        $datosexisten = false;
        $datos = null;
       if($existefacturacion != 0){ // hay datos
        $datosexisten = true;
        $datosfactu = DatosFacturacion::where('usuario_id', $usuario_id)->get(); // aquí he hecho mucha movida rara, por no recorrer con foreach en la vista.
        foreach($datosfactu as $datosfacturacion){
            $datos = $datosfacturacion;
        }
       }
       
        return view('datosfacturacion.datos', [
            'datosfacturacion' => $datos,
            'datosexisten' => $datosexisten
        ]);
    }

    public function guardarFacturacion(Request $request){
        $usuario_id = Auth::user()->id;
        $existefacturacion = DatosFacturacion::where('usuario_id', $usuario_id)->count();

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
        $facturacion_id= $request->input('facturacion_id');
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $telefono = $request->input('telefono');
        $provincia = $request->input('provincia');
        $localidad = $request->input('localidad');
        $direccion = $request->input('direccion');
        $codigo_postal = $request->input('codigo_postal');

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
            $datosexisten = true;

            return redirect()->route('facturacion.datos')->with(['message' => 'Se han actualizado los datos de facturación', 'datosfacturacion' => $datosfacturacion, 'datosexisten' => $datosexisten]);


        }else{  //  Existen datos >> update

            $datosfacturacion = DatosFacturacion::find($facturacion_id);

            $datosfacturacion->nombre = $nombre;
            $datosfacturacion->email = $email;
            $datosfacturacion->telefono = $telefono;
            $datosfacturacion->provincia = $provincia;
            $datosfacturacion->localidad = $localidad;
            $datosfacturacion->direccion = $direccion;
            $datosfacturacion->codigo_postal = $codigo_postal;

            $datosfacturacion->update();
            $datosexisten = true;

            return redirect()->route('facturacion.datos')->with(['message' => 'Se han actualizado los datos de facturación', 'datosfacturacion' => $datosfacturacion, 'datosexisten' => $datosexisten]);
        }
    }
}
