@extends('layouts.app')

@section('title')
    @if(is_null($message))
        {{ $nombre_categoria }}
    @else
        Categoria no encontrada
    @endif
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">            
            @if(!is_null($message))
            <h1 class="text-center mt-4"> Categoría no encontrada</h1>
            <h3 class="text-center pt-3"> {{ $message }}</h3>
            @else   
            <div class="card">         
                <div class="card-header text-center"><h1><strong style="text-transform:uppercase"> {{ $nombre_categoria }} </strong></h1></div>
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
                                
                                <a href="{{ route('producto.mostrar', ['id' => $producto->id]) }}">
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
                </div>              
            </div>
            @endif
        </div>
    </div>
</div>
@endsection