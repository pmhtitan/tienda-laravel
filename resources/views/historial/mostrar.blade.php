@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center min-wh-435px">
        <div class="col-md-10">
            <div class="card">
            @include('includes.message')
               
               <div class="card-header">Dashboard ~ Mis pedidos</div>           
                <div class="card-body">
                <h3 class="mb-4">Historial de pedidos</h3>
                    @if($hayhistorial)
                        @foreach($historial as $hist)
                            <div class="row">                                
                                <div class="col-md-4">ID: {{ $hist->id }}</div>
                                <div class="col-md-4">Coste Total:  {{ $hist->coste }} €</div>
                                <div class="col-md-4">Estado:  
                                    @if($hist->estado == "pendiente")
                                    <div class="btn btn-sm btn-warning" style="cursor:default;">{{ $hist->estado }}</div>
                                    @elseif($hist->estado == "confirmado")
                                    <div class="btn btn-sm btn-info2" style="cursor:default;">{{ $hist->estado }}</div>
                                    @elseif($hist->estado == "enviado")
                                    <div class="btn btn-sm btn-success" style="cursor:default;">{{ $hist->estado }}</div>
                                    @endif
                                </div>
                            </div>
                            <details>
                                <Summary>Desglosar</Summary>
                                <div class="details-content border-desglosado mt-3">
                                    <div class="mt-3">
                                    @foreach($hist->lineashistorial as $linea)
                                        <div  class="row pl-4">
                                            <div class="col-md-4"> <u>Producto</u>:  {{ $linea->nombre }} </div>
                                            <div class="col-md-4"> <u>Precio</u>:  {{ $linea->precio }} € </div>
                                            <div class="col-md-4"> <u>Unidades</u>:  {{ $linea->unidades }} </div>                                            
                                        </div>
                                        <hr>
                                    @endforeach 
                                    </div>
                                    <div class="row pl-4">     
                                        <p class="col-md-8"><strong>Facturación</strong>: {{$hist->localidad}}, {{$hist->provincia}}&nbsp; {{$hist->direccion}}&nbsp; {{$hist->codigo_postal}}&nbsp; tlf: {{$hist->telefono}}</p>  
                                        <div class="col-md-4"> {{ $hist->created_at }}</div>
                                    </div>                           
                                </div>
                            </details>
                            <hr>
                        @endforeach
                    @else
                        <h5 class="pt-4 pb-2">Aquí se muestra el historial de tus compras. Parece que aún no has comprado nada.</h5> 
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
