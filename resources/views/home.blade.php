@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center min-wh-435px">
        <div class="col-md-8">
            <div class="card">
            @include('includes.message')
                @if(\Auth::user()->roles == 'admin')
                <div class="card-header">Dashboard admin</div>
                @else
                <div class="card-header">Dashboard de cliente</div>
                @endif

                <div class="card-body">
                    @if(\Auth::user()->roles == 'admin')
                        <h4>Bienvenido a tu Dashboard de admin, ¿qué deseas?</h4>
                        <div class="col-md-12 pt-4 pb-3">
                            <div class="row mb-3 text-center-movile">
                                <div class="col-md-2">Crear</div>
                                <div class="col-md-4 col-6">
                                    <a href="{{ route('producto.crear') }}"><button class="btn btn-info2">Crear producto</button></a>    
                                </div>
                                <div class="col-md-1 d-none"></div>
                                <div class="col-md-4 col-6">
                                    <a href="{{ route('categoria.crear') }}"><button class="btn btn-info2">Crear categoria</button></a>
                                </div>
                                <div class="col-md-1 d-none"></div>                               
                            </div>
                            <div class="row text-center-movile pb-3">
                                <div class="col-md-2">Gestionar</div>
                                <div class="col-md-4 col-6">
                                    <a href="{{ route('producto.gestion') }}"><button class="btn btn-primary">Gestionar productos</button></a>    
                                </div>
                                <div class="col-md-1 d-none"></div>
                                <div class="col-md-4 col-6">
                                    <a href="{{ route('categoria.gestion') }}"><button class="btn btn-primary">Gestionar categorias</button></a>
                                </div>
                                <div class="col-md-1 d-none"></div>                               
                            </div>  
                            <div class="row text-center-movile">
                                <div class="col-md-2">Tallas</div>
                                <div class="col-md-4 col-6">
                                    <a href="{{ route('talla.crear') }}"><button class="btn btn-light">Crear tallas</button></a>    
                                </div>
                                <div class="col-md-1 d-none"></div>
                                <div class="col-md-4 col-6">
                                    <a href="{{ route('talla.gestion') }}"><button class="btn btn-light">Gestionar tallas</button></a>
                                </div>
                                <div class="col-md-1 d-none"></div>                               
                            </div>                           
                            <div class="row text-center-movile mt-4">
                                <div class="col-2"></div>
                                <div class="col-8 col-md-7 text-center mb-2">Historial de pedidos</div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row text-center-movile">
                                <div class="col-2"></div>
                                <div class="col-8 col-md-7 text-center">
                                    <a href="{{ route('historial.gestion') }}"><button class="btn btn-dark">Gestionar pedidos</button></a>
                                </div>
                                <div class="col-2"></div>                               
                            </div>
                        </div>
                    @else
                        <h4>Bienvenido a tu Dashboard de cliente, ¿qué deseas?</h4>
                        <div class="col-md-12 pt-3 pb-3">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <a href="{{ route('historial.mostrar') }}"><button class="btn btn-info2">Historial de pedidos</button></a>    
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <a href="{{ route('facturacion.datos') }}"><button class="btn btn-primary">Mis datos de facturación</button></a>
                                </div>
                                <div class="col-md-1"></div>                               
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
