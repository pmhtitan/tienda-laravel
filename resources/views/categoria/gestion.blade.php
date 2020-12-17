@extends('layouts.app')

@section('title', 'Gestion Categorias')

@section('content')

    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-10">
            @include('includes.message')

                <h1>Bienvenido a la landing Page de Gestion Categorias</h1>

                <p>Si estás viendo esto, es que funciona.</p>

                <div class="container">
                        <h2>GESTIÓN CATEGORIAS</h2>
                        <p>Aquí puedes ver, editar y  eliminar las categorias existentes</p> 
                        <div class="table-responsive">            
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                             @foreach($categorias as $cat)
                            <tr>
                                <td>{{ $cat->id }}</td>
                                <td>{{ $cat->nombre }}</td>
                                <td class="td-caja-gestionProd">    
                                    <a href="{{ route('categoria.editar', ['id' => $cat->id]) }}" class="btn btn-success fa fa-edit boton-gestionProd button-trash fw600" title="Editar" alt="Editar"></a>
                                    <a href="{{ route('categoria.eliminar', ['id' => $cat->id]) }}"  onclick="return confirm('¿Estás seguro? Vas a borrar una categoria')" class="btn btn-danger boton-gestionProd button-nospacing-mobileProd button-trash fa fa-trash ml-1 fw600" title="Borrar" alt="Borrar"></a>
                                </td>
                            </tr>                      
                             @endforeach                     

                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
        
    </div>

@endsection
