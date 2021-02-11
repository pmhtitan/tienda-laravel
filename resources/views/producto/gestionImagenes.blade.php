@extends('layouts.app')

@section('title', 'Gestion imágenes adicionales de producto')

@section('content')

    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-10">
            @include('includes.message')

                <h1>Bienvenido a la landing Page de Gestion Imagenes</h1>

                <p>Si estás viendo esto, es que funciona.</p>

                <div class="container">
                    <h2>GESTIÓN IMÁGENES</h2>
                    <p>Aquí puedes ver, editar y  eliminar las imágenes adicionales del producto. Se pueden añadir hasta 2 imágenes adicionales.</p>
                    <p class="mt-2" style="font-size:15px;">Producto: <strong class="productNameColor">{{ $producto->nombre }}</strong></p>
                    <a href="{{ route('producto.editar', ['id' => $producto->id]) }}" class="btn btn-primary float-right" style="font-size:16px;">&#10094; Volver</a>
                    <p style="font-size:15px;">Imagen principal: <img src="{{ route('image.file', ['filename' => $producto->imagen]) }}" width='100' height='100'/></p>
                    @if($hayimagenes) 
                        <div class="table-responsive">            
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Imagen adicional</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>                                
                                    @foreach($imagenes as $img)
                                    <tr>
                                        <td>{{ $img->id }}</td>
                                        <td><img src="{{ route('image.file', ['filename' => $img->nombre]) }}" width='150' height='150'/></td>
                                        <td class="td-caja-gestionProd">    
                                            <a href="{{ route('producto.editarImg', ['id' => $img->id]) }}" class="btn btn-success fa fa-edit boton-gestionProd button-trash fw600" title="Editar" alt="Editar"></a>
                                            <a href="{{ route('producto.eliminarImg', ['id' => $img->id]) }}"  onclick="return confirm('¿Estás seguro? Vas a borrar una imagen')" class="btn btn-danger boton-gestionProd button-nospacing-mobileProd button-trash fa fa-trash ml-1 fw600" title="Borrar" alt="Borrar"></a>
                                        </td>
                                    </tr>                      
                                    @endforeach                                                                                                
                                </tbody>
                            </table>
                        </div>
                        @if(count($imagenes) == 1)
                            <div class="row justify-content-center">
                                <div class="col-md-8 mt-3 mb-2">
                                    <div class="card">
                                        <div class="card-header text-center text-uppercase">Subir imágenes de <strong class="productNameColor">{{ $producto->nombre }}</strong></div>

                                        <div class="card-body">
                                            <form action="{{ route('producto.nuevasImg') }}" method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group row">
                                                    
                                                <label for="imagen1" class="col-md-3 col-form-label text-md-right">Imagen 2</label>

                                                <div class="col-md-7">
                                                    <input id="imagen1" type="file" class="form-control{{ $errors->has('imagen1') ? ' is-invalid' : '' }}" name="imagen1" required autofocus>

                                                    @if ($errors->has('imagen1'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('imagen1') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>                            
                                            </div>

                                                <input type="hidden" name="producto_id" value="{{ $producto->id }}"/>

                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-3 text-center text-md-left">
                                                        <button type="submit" class="btn btn-primary" name="submitCrearImagen">
                                                            Subir imagen
                                                        </button>
                                                    </div>
                                                </div>                                                                                
                                            </form>
                                        </div>                                    
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else 
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                            <h3 class="text-center">Este producto no tiene imágenes adicionales, puedes añadir hasta 2 imágenes adicionales.</h3>
                                <div class="card">
                                    <div class="card-header text-center text-uppercase">Subir imágenes de <strong class="productNameColor">{{ $producto->nombre }}</strong></div>

                                    <div class="card-body">
                                        <form action="{{ route('producto.nuevasImg') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group row">
                                                
                                            <label for="imagen1" class="col-md-3 col-form-label text-md-right">Imagen 1</label>

                                            <div class="col-md-7">
                                                <input id="imagen1" type="file" class="form-control{{ $errors->has('imagen1') ? ' is-invalid' : '' }}" name="imagen1" required autofocus>

                                                @if ($errors->has('imagen1'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('imagen1') }}</strong>
                                                    </span>
                                                @endif
                                            </div>                            
                                        </div>

                                        <div class="form-group row">
                                                
                                            <label for="imagen2" class="col-md-3 col-form-label text-md-right">Imagen 2</label>

                                            <div class="col-md-7">
                                                <input id="imagen2" type="file" class="form-control{{ $errors->has('imagen2') ? ' is-invalid' : '' }}" name="imagen2" autofocus>

                                                @if ($errors->has('imagen2'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('imagen2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>                            
                                        </div>

                                            <input type="hidden" name="producto_id" value="{{ $producto->id }}"/>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-3 text-center text-md-left">
                                                    <button type="submit" class="btn btn-primary" name="submitCrearImagen">
                                                        Subir imagenes
                                                    </button>
                                                </div>
                                            </div>                                                                                
                                        </form>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>      
    </div>

@endsection
