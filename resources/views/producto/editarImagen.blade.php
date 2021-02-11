@extends('layouts.app')

@section('title', 'Editar Imagen')

@section('content')
<div class="container">
    <div class="row justify-content-center min-wh-435px">
        <div class="col-md-8">

            <div class="card">
            <div class="card-header text-center position-relative"><span class="text-uppercase">Editar imagen</span><a href="{{ route('producto.gestionImagenes', ['id' => $producto->id]) }}" class="btn btn-primary float-right back-card-button">&#10094; Volver</a></div>

                <div class="card-body">
                    <form action="{{ route('producto.editadoImg') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                        <div class="form-group row">
                                    
                            <label for="image_before" class="col-md-3 col-form-label text-md-right">Imagen anterior</label>

                            <div class="col-md-7">
                                <div class="container-avatar">
                                <img src="{{ route('image.file', ['filename' => $img->nombre]) }}" width="50" height="50" />
                                </div>
                            </div>                            
                        </div> 

                        <div class="form-group row">
                            
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">Nueva imagen</label>

                            <div class="col-md-7">
                                <input id="image_path" type="file" class="form-control{{ $errors->has('image_path') ? ' is-invalid' : '' }}" name="image_path" required autofocus>

                                @if ($errors->has('image_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image_path') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>
                        
                        <input type="hidden" name="producto_id" value="{{ $producto->id }}"/>
                        <input type="hidden" name="imagen_id" value="{{ $img->id }}"/>

                        <div class="form-group row mb-0">
                            <div class="col-md-3 offset-md-3">
                                <button type="submit" class="btn btn-primary" name="submitCrearImagen">
                                    Actualizar imagen
                                </button>
                            </div>
                        </div>                       
                                            
                    </form>

                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection



