@extends('layouts.app')

@section('title', 'Editar pedido')

@section('content')
<div class="container">
    <div class="row justify-content-center min-wh-435px">
        <div class="col-md-10">
        @include('includes.message')
           
            <div class="card">                      
            <div class="card-header text-center position-relative"><span class="text-uppercase">EDITAR PEDIDO</span><a href="{{ route('historial.gestion') }}" class="btn btn-primary float-right back-card-button">&#10094; Volver</a></div>        
                <div class="card-body">
                <h3 class="mb-4">Datos del pedido</h3>
                    @if($hayhistorial)

                        <form action="{{ route('historial.editado') }}" method="POST">
                        @csrf

                            <div class="form-group row">
                                    
                                <label for="email" class="col-md-10 col-form-label text-md-right">ID {{$historial->id}}</label>                              
                            </div> 

                            <div class="form-group row">
                                    
                                <label for="username" class="col-md-3 col-form-label text-md-right">Username</label>

                                <div class="col-md-7">
                                    <input type="text" id="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" required autofocus value="{{ $historial->username }}"/>

                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>                            
                            </div>   

                            <div class="form-group row">
                                    
                                    <label for="email" class="col-md-3 col-form-label text-md-right">Email</label>
        
                                    <div class="col-md-7">
                                        <input type="text" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required autofocus value="{{ $historial->email }}"/>
        
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>                            
                                </div>   

                            <div class="form-group row">
                                    
                                <label for="coste" class="col-md-3 col-form-label text-md-right">Coste</label>

                                <div class="col-md-2 col-4">
                                    <input type="text" id="coste" class="form-control{{ $errors->has('coste') ? ' is-invalid' : '' }}"  name="coste" required autofocus value="{{ $historial->coste }}"/>
                                    @if ($errors->has('coste'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('coste') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-5 col-6" style="line-height:38px;">€</div>                            
                            </div>

                            <div class="form-group row">
                                    
                                <label for="estado" class="col-md-3 col-form-label text-md-right">Estado</label>

                                <div class="col-md-7">
                                    <select name="estado" class="form-control" style="width:40%;">
                                        <option value="pendiente" @if($historial->estado == "pendiente") selected @endif >pendiente</option>
                                        <option value="confirmado" @if($historial->estado == "confirmado") selected @endif >confirmado</option>
                                        <option value="enviado" @if($historial->estado == "enviado") selected @endif >enviado</option>
                                    </select>
                                    @if ($errors->has('estado'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('estado') }}</strong>
                                        </span>
                                    @endif
                                </div>                            
                            </div>
                            
                            <div class="form-group row">
                                    
                                <label for="telefono" class="col-md-3 col-form-label text-md-right">Telefono</label>

                                <div class="col-md-7">
                                    <input type="number" id="telefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" required autofocus value="{{ $historial->telefono }}"/>
                                    @if ($errors->has('telefono'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('telefono') }}</strong>
                                        </span>
                                    @endif
                                </div>                            
                            </div>   

                            <div class="form-group row">
                                    
                                    <label for="provincia" class="col-md-3 col-form-label text-md-right">Provincia</label>
        
                                    <div class="col-md-7">
                                        <input type="text" id="provincia" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="provincia" required autofocus value="{{ $historial->provincia }}"/>
        
                                        @if ($errors->has('provincia'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('provincia') }}</strong>
                                            </span>
                                        @endif
                                    </div>                            
                                </div>   

                                <div class="form-group row">
                                    
                                    <label for="localidad" class="col-md-3 col-form-label text-md-right">Localidad</label>
        
                                    <div class="col-md-7">
                                        <input type="text" id="localidad" class="form-control{{ $errors->has('localidad') ? ' is-invalid' : '' }}" name="localidad" required autofocus value="{{ $historial->localidad }}"/>
        
                                        @if ($errors->has('localidad'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('localidad') }}</strong>
                                            </span>
                                        @endif
                                    </div>                            
                                </div>   

                                <div class="form-group row">
                                    
                                    <label for="direccion" class="col-md-3 col-form-label text-md-right">Dirección</label>
        
                                    <div class="col-md-7">
                                        <input type="text" id="direccion" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" required autofocus value="{{ $historial->direccion }}"/>
        
                                        @if ($errors->has('direccion'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('direccion') }}</strong>
                                            </span>
                                        @endif
                                    </div>                            
                                </div>   

                                <div class="form-group row">
                                    
                                    <label for="codigo_postal" class="col-md-3 col-form-label text-md-right">Código postal</label>
        
                                    <div class="col-md-7">
                                        <input type="text" id="codigo_postal" class="form-control{{ $errors->has('codigo_postal') ? ' is-invalid' : '' }}" name="codigo_postal" required autofocus value="{{ $historial->codigo_postal }}"/>
        
                                        @if ($errors->has('codigo_postal'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('codigo_postal') }}</strong>
                                            </span>
                                        @endif
                                    </div>                            
                                </div>   
                            
                                <input type="hidden" name="historial_id" value="{{$historial->id}}">
                                <input type="hidden" name="usuario_id" value="{{$historial->usuario_id}}">

                            <div class="form-group row mb-0">
                                <div class="col-md-3 offset-md-3 order-lg-1 order-2 mt-3 mt-md-0 text-center text-md-left">
                                    <button type="submit" class="btn btn-primary" name="submitCrearImagen">
                                        Actualizar pedido
                                    </button>
                                </div>
                            </div> 

                        </form>   

                    @else
                        <h5 class="pt-4 pb-2">El pedido buscado no existe o no está disponible.</h5> 
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
