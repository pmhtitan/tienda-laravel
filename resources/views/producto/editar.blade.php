@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header text-center text-uppercase">Editar producto</div>

                <div class="card-body">
                    <form action="{{ route('producto.editado') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                        <div class="form-group row">
                                
                            <label for="nombre" class="col-md-3 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-7">
                                <input type="text" id="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" required autofocus value="{{ $producto->nombre }}"/>

                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>   

                        <div class="form-group row">
                                
                            <label for="descripcion" class="col-md-3 col-form-label text-md-right">Descripción</label>

                            <div class="col-md-7">
                                <textarea id="descripcion" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" required autofocus>{{ $producto->descripcion }}</textarea>

                                @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>

                        <div class="form-group row">
                                
                            <label for="precio" class="col-md-3 col-form-label text-md-right">Precio</label>

                            <div class="col-md-7">
                                <input type="number" id="precio" class="form-control{{ $errors->has('precio') ? ' is-invalid' : '' }}" name="precio" required autofocus value="{{ $producto->precio }}"/>
                                @if ($errors->has('precio'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('precio') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>
                        
                        <div class="form-group row">
                                
                            <label for="stock" class="col-md-3 col-form-label text-md-right">Stock</label>

                            <div class="col-md-7">
                                <input type="number" id="stock" class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}" name="stock" required autofocus value="{{ $producto->stock }}"/>
                                @if ($errors->has('stock'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('stock') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>   

                        <div class="form-group row">

                            <label for="categoria" class="col-md-3 col-form-label text-md-right">Categoria</label>

                            <div class="col-md-7">
                                <select name="selectCategoria" id="selectCategoria" class="form-control">
                                @foreach($categorias as $categoria)
                                    @if($categoria->id == $producto->categoria->id )
                                    <option value="{{$categoria->id}}" selected>{{$categoria->nombre}}</option>
                                    @else
                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                                
                                <label for="image_before" class="col-md-3 col-form-label text-md-right">Imagen anterior</label>

                                <div class="col-md-7">
                                    <div class="container-avatar">
                                    <img src="{{ route('image.file', ['filename' => $producto->imagen]) }}" width="50" height="50" />
                                    </div>
                                </div>                            
                        </div>
                        <div class="form-group row">
                            
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">Nueva imagen</label>

                            <div class="col-md-7">
                                <input id="image_path" type="file" class="form-control{{ $errors->has('image_path') ? ' is-invalid' : '' }}" name="image_path" autofocus>

                                @if ($errors->has('image_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image_path') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>
                        
                        <input type="hidden" name="producto_id" value="{{ $producto->id }}"/>

                        <div class="form-group row mb-0">
                            <div class="col-md-3 offset-md-3">
                                <button type="submit" class="btn btn-primary" name="submitCrearImagen">
                                    Actualizar producto
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



