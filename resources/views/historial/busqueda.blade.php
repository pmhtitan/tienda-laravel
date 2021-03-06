@extends('layouts.app')

@section('title', 'Busqueda pedidos')

@section('content')
<div class="container">
    <div class="row justify-content-center min-wh-435px">
        <div class="col-md-10">
            <h1><div class="people-search-top p-2 text-center text-uppercase">BUSCADOR</div></h1>
            @if(!empty($search))
                <div class="people-search-container p-3">
                    <div class="text-center search-message">{!! 'Se han encontrado <span style="color:blueviolet">'.$historial->total(). '</span> resultados para <span style="color:cornflowerblue">'. $search .'</span>' !!}</div>
                </div>
            @endif
            <div class="card">           
            <div class="card-header text-center position-relative"><span class="text-uppercase">BÚSQUEDA DE PEDIDOS</span><a href="{{ route('historial.gestion') }}" class="btn btn-primary float-right back-card-button">&#10094; Volver</a></div>       
                <div class="card-body">
                <h3 class="mb-4">Historial de pedidos</h3>
                    @if($hayhistorial)
                        @foreach($historial as $hist)
                            <div class="row">                                
                                <div class="col-md-1">ID: {{ $hist->id }}</div>
                                <div class="col-md-2">Usuario: {{ $hist->username }}</div>
                                <div class="col-md-3">Coste Total:  {{ $hist->coste }} €</div>
                                <div class="col-md-3">Estado:  
                                    @if($hist->estado == "pendiente")
                                    <div class="btn btn-sm btn-warning" style="cursor:default;">{{ $hist->estado }}</div>
                                    @elseif($hist->estado == "confirmado")
                                    <div class="btn btn-sm btn-info2" style="cursor:default;">{{ $hist->estado }}</div>
                                    @elseif($hist->estado == "enviado")
                                    <div class="btn btn-sm btn-success" style="cursor:default;">{{ $hist->estado }}</div>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <form action="{{ route('historial.estado') }}" method="POST">
                                        @csrf
                                        <select name="estadoPedido" class="form-control" style="width:63%; display:inline-block;">
                                            <option value="pendiente" @if($hist->estado == "pendiente") selected @endif >pendiente</option>
                                            <option value="confirmado" @if($hist->estado == "confirmado") selected @endif >confirmado</option>
                                            <option value="enviado" @if($hist->estado == "enviado") selected @endif >enviado</option>
                                        </select>
                                        <input type="hidden" name="historial_id" value="{{$hist->id}}">
                                        <input type="hidden" name="usuario_id" value="{{$hist->usuario_id}}">
                                        <button type="submit" class="btn btn-success" name="submitEstado" title="Guardar cambios"><i class="fas fa-check-circle"></i></button>
                                    </form>                                    
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
                                    <div class="row ml-4">
                                        <a class="btn btn-secondary mb-2" href="{{ route('historial.editar', ['id' => $hist->id]) }}">Editar</a>
                                    </div>                             
                                </div>
                            </details>
                            <hr>
                        @endforeach

                        <div class="gestion-paginacion"> 
                            {{ $historial->links('pagination::bootstrap-4') }}  
                        </div>
                    @else
                        <h5 class="pt-4 pb-2">El buscador filtra por <strong style="color:blueviolet;">nombre de usuario</strong>, <strong style="color:blueviolet;">email</strong>, <strong style="color:blueviolet;">localidad</strong>, <strong style="color:blueviolet;">dirección</strong> o <strong style="color:blueviolet;">código postal</strong>.</h5> 
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
