@extends('layouts.app')

@section('title', 'Carrito')

@section('content')

<section class="jumbotron text-center shopping-cart-text">
    <div class="container">
        <h1 class="jumbotron-heading">SHOPPING CART</h1>
    </div>
</section>

<div class="container mb-4">
    <div class="row">

    @isset($carrito)
        @if(count($carrito) >= 1)

        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Product</th>
                            <th scope="col">Available</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" class="text-right">Price</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                       
                     @foreach($carrito as $indice => $elemento)
                        @php
                            $producto = $elemento['producto'];
                        @endphp
                        <tr>
                            @if($producto->imagen == null)
                            <td><img src="{{ asset('img/not-found.png') }}" height='50' width='50' /> </td>
                            @else
                            <td><img src="{{ route('image.file', ['filename' => $producto->imagen]) }}" height='50' width='50' /> </td>
                            @endif
                            <td>{{ $producto->nombre }}</td>
                            <td>In stock</td>
                            <td class="text-center td-a-up-down">

                                @if(Auth::check())
                                    <a href="{{ route('carrito.down', ['index' => $producto->id] ) }}">    
                                @else
                                    <a href="{{ route('carrito.down', ['index' => $indice] ) }}">                                
                                @endif
                                        <i class="fa fa-minus btn btn-danger cantidad-icono icono-menos" aria-hidden="true"></i>
                                    </a>

                                {{ $elemento['unidades'] }}

                                @if(Auth::check())
                                    <a href="{{ route('carrito.up', ['index' => $producto->id] ) }}">    
                                @else
                                    <a href="{{ route('carrito.up', ['index' => $indice] ) }}">                                
                                @endif
                                        <i class="fa fa-plus btn btn-success cantidad-icono icono-mas" aria-hidden="true"></i>
                                    </a>

                            </td>
                            <td class="text-right">{{ $producto->precio }} €</td>
                            <td class="text-right">
                                @if(Auth::check())
                                     <a href="{{ route('carrito.remove', ['index' => $producto->id]) }}">
                                @else
                                    <a href="{{ route('carrito.remove', ['index' => $indice]) }}">
                                @endif
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </a>
                            </td>
                        </tr>
                     @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Sub-Total</td>
                            <td class="text-right">{{ $stats['subtotal'] }} €</td>
                        </tr>
                        <tr>
                            <td>Total de productos: {{ $stats['items'] }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Shipping</td>
                            <td class="text-right">{{ $stats['shippingPrice'] }} €</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td class="text-right"><strong>{{ $stats['total'] }} €</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <button class="btn btn-block btn-light">Continue Shopping</button>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <a href="{{ route('carrito.checkout') }}" class="btn btn-lg btn-block btn-success text-uppercase">Checkout</a>
                </div>
            </div>
        </div>
    @else
        <p>Tu carrito está vacío</p>
    @endif
       
    @endisset
    </div>
</div>

@endsection