@extends('layouts.app')

@section('title', 'Crear Producto')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header text-center text-uppercase">  Crear nuevo producto</div>

                <div class="card-body">
                    <form action="{{ route('producto.creado') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                        <div class="form-group row">
                            
                            <label for="nombre" class="col-md-3 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-7">
                                <input type="text" id="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" required autofocus></textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>

                        <div class="form-group row">
                            
                            <label for="descripcion" class="col-md-3 col-form-label text-md-right">Descripción</label>

                            <div class="col-md-7">
                                <textarea id="descripcion" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" required autofocus></textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>

                        <div class="form-group row">
                            
                            <label for="precio" class="col-md-3 col-form-label text-md-right">Precio</label>

                            <div class="col-md-7">
                                <input type="number" id="precio" class="form-control{{ $errors->has('precio') ? ' is-invalid' : '' }}" name="precio" required autofocus></textarea>

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
                                <input type="number" id="stock" class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}" name="stock" required autofocus></textarea>

                                @if ($errors->has('precio'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('precio') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>
                
                        <div class="form-group row">

                            <label for="categoria" class="col-md-3 col-form-label text-md-right">Categoria</label>

                            <div class="col-md-7">
                                <select name="selectCategoria" id="selectCategoria" class="form-control">
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="talla" class="col-md-3 col-form-label text-md-right">Talla</label>

                            <div class="col-md-7 div-checkbox">
                                <div class="row">
                                    @foreach($tallas as $talla)
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-4"><input type="checkbox" class="input-checkbox" name="talla[]" value="{{ $talla->id }}"> {{ $talla->nombre }}</div>
                                    @endforeach    
                                </div> 
                                @if ($errors->has('talla'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('talla') }}</strong>
                                    </span>
                                @endif                          
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">Imagen</label>

                            <div class="col-md-7">
                                <input id="image_path" type="file" class="form-control{{ $errors->has('image_path') ? ' is-invalid' : '' }}" name="image_path" required autofocus>

                                @if ($errors->has('image_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image_path') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-3 offset-md-3">
                                <button type="submit" class="btn btn-info2" name="submitCrearProducto">
                                    Crear producto
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