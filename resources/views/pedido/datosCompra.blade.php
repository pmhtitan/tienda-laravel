@extends('layouts.app')

@section('title', 'Datos de compra')

@section('content')

<div class="container p-3 mt-5">
    <div class="col-md-8">
    
        <h3>Gracias por su compra</h3>

        @isset($carrito)
            @if(count($carrito) >= 1)

            <div class="infoCompra p-3 mt-4 mb-5 col-md-8 col-xl-6">
                <div class="mb-2">
                    <b class="">Producto</b>
                    <b class="float-right">Precio</b>
                </div>
                @foreach($carrito as $indice => $elemento)
                    @php
                        $producto = $elemento['producto'];
                    @endphp
                        
                        <span class="float-left span-infoCompra-box"> {{ $producto->nombre }}</span>
                        <span class="float-right">{{ $producto->precio }} €</span>
                        @if($elemento['unidades'] > 1)
                        <span class="float-left ml-1">( {{ $elemento['unidades'] }} )</span>
                        @endif
                        <br>
                @endforeach
                <div class="clearfix"></div>
                <hr>
                
                <div class="mt-2">
                    <span class="">Subtotal</span>
                    <span class="float-right">{{ $stats['subtotal'] }} €</span>
                </div>
                
                <div class="mt-2">
                    <span class="">Shipping Cost</span>
                    <span class="float-right">{{ $stats['shippingPrice'] }} €</span>
                </div>
            
                <div class="mt-4">
                    <span class="">Total</span>
                    <b class="float-right">{{ $stats['total'] }} €</b>
                </div>
            </div>

            @else
            <h6>Ocurrió un error en la pasarela, ¿tienes productos en tu cesta? Prueba a añadir alguno</h6>

            <a href="{{ route('landing') }}" class="btn btn-info">Volver a productos</a>
            @endif
        @endisset
    </div>    
</div>
@endsection
   
