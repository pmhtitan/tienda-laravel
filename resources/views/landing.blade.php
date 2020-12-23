@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center"><strong>PRODUCTOS DESTACADOS</strong></div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                        @foreach($productos as $producto)
                        <div class="col-12 col-sm-8 col-md-6 col-lg-4 mb-4">
                            <div class="card">
                                <a href="#">
                                    <div class="parent">
                                    <img class="card-img-top child" src="{{ route('image.file', ['filename' => $producto->imagen]) }}" alt="{{ $producto->nombre }}"/>
                                    </div>
                                </a>
                                <div class="card-body">
                                    <h4 class="card-title producto-descripcion-destacados">{{ $producto->nombre }}</h4>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $producto->categoria->nombre }}</h6>
                                    <p class="card-text producto-descripcion-destacados">
                                        {{ $producto->descripcion }}
                                    </p>                                   
                                    <div class="buy d-flex justify-content-between align-items-center">
                                        <div class="price text-success"><h5 class="mt-4">{{ $producto->precio }} €</h5></div>
                                        <a href="{{ route('carrito.add', ['id' => $producto->id]) }}" class="btn btn-danger mt-3 btnAjax"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        @endforeach
                    </div>

                    <div id="path-ajax" data-path="{{route('carrito.ajax')}}"></div>
                    <input type="number" value="1" id="quantity_input" style="display:none;"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection