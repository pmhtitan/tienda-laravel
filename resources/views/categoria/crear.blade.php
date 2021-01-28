@extends('layouts.app')

@section('title', 'Crear Categoria')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header text-center text-uppercase">  Crear nueva categoria</div>

                <div class="card-body">
                    <form action="{{ route('categoria.creado') }}" method="POST">
                    @csrf

                        <div class="form-group row">
                            
                            <label for="nombre" class="col-md-3 col-form-label text-md-right">Nombre de la categoria</label>

                            <div class="col-md-7">
                                <input type="text" id="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" required autofocus/>

                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-3 offset-md-3">
                                <button type="submit" class="btn btn-info2" name="submitCrearProducto">
                                    Crear categoria
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