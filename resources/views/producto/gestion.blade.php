@extends('layouts.app')

@section('title', 'Gestion Productos')

@section('content')

    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-10">
            @include('includes.message')

                <h1>Bienvenido a la landing Page de Gestion Productos</h1>

                <p>Si estás viendo esto, es que funciona.</p>

                <div class="container">
                        <h2>GESTIÓN PRODUCTOS</h2>
                        <p>Aquí puedes ver, editar y  eliminar los productos existentes</p> 
                        <div class="table-responsive">            
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Categoria</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                             @foreach($productos as $prod)
                            <tr>
                                <td>{{ $prod->id }}</td>
                                <td>{{ $prod->nombre }}</td>
                                <td>{{ $prod->descripcion }}</td>
                                <td>{{ $prod->precio }} €</td>
                                <td>{{ $prod->stock }}</td>
                                <td>{{ $prod->categoria->nombre }}</td>
                                <td><img src="{{ route('image.file', ['filename' => $prod->imagen]) }}" width='50' height='50'/></td>
                                <td class="td-caja-gestionProd">    
                                    <a href="{{ route('producto.editar', ['id' => $prod->id]) }}" class="btn btn-success fa fa-edit boton-gestionProd button-trash" title="Editar" alt="Editar"></a>
                                    <a href="{{ route('producto.eliminar', ['id' => $prod->id]) }}"  onclick="return confirm('¿Estás seguro? Vas a borrar un producto')" class="btn btn-danger boton-gestionProd button-nospacing-mobileProd button-trash fa fa-trash ml-1" title="Borrar" alt="Borrar"></a>
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
