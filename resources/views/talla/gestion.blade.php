@extends('layouts.app')

@section('title', 'Gestion Tallas')

@section('content')

    <div class="container">
        
        <div class="row justify-content-center min-wh-435px">
            <div class="col-md-10">
            @include('includes.message')

                <h1>Bienvenido a la landing Page de Gestion tallas</h1>

                <p>Si estás viendo esto, es que funciona.</p>

                <div class="container">
                        <h2>GESTIÓN TALLAS</h2>
                        <p>Aquí puedes ver, editar y  eliminar las tallas existentes</p> 
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
                             @foreach($tallas as $talla)
                            <tr>
                                <td>{{ $talla->id }}</td>
                                <td>{{ $talla->nombre }}</td>
                                <td class="td-caja-gestionProd">    
                                    <a href="{{ route('talla.editar', ['id' => $talla->id]) }}" class="btn btn-success fa fa-edit boton-gestionProd button-trash fw600" title="Editar" alt="Editar"></a>
                                    <a href="{{ route('talla.eliminar', ['id' => $talla->id]) }}"  onclick="return confirm('¿Estás seguro? Vas a borrar una talla')" class="btn btn-danger boton-gestionProd button-nospacing-mobileProd button-trash fa fa-trash ml-1 fw600" title="Borrar" alt="Borrar"></a>
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
