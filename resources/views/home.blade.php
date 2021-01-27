@extends('layouts.app')

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
