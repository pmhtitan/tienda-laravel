@extends('layouts.app')

@if(is_null($message))
    @section('title', '{{ $producto->nombre }}')
@else
    @section('title', 'Producto no encontrado')    
@endif

@section('content')

   <div class="super_container">    
    <div class="single_product">
        <div class="container-fluid" style=" background-color: #fff; padding: 11px;">
            <div class="row">
             @if(is_null($message))
                <div class="col-lg-2 order-lg-1 order-2">
                    <ul class="image_list">
                        <li data-image="https://res.cloudinary.com/dxfq3iotg/image/upload/v1565713229/single_4.jpg"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1565713229/single_4.jpg" alt=""></li>
                        <li data-image="https://res.cloudinary.com/dxfq3iotg/image/upload/v1565713228/single_2.jpg"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1565713228/single_2.jpg" alt=""></li>
                        <li data-image="https://res.cloudinary.com/dxfq3iotg/image/upload/v1565713228/single_3.jpg"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1565713228/single_3.jpg" alt=""></li>
                    </ul>
                </div>
                <div class="col-lg-4 order-lg-2 order-1">
                    <div class="image_selected"><img src="{{ route('image.file', ['filename' => $producto->imagen]) }}" alt="{{ $producto->nombre }}" title="{{ $producto->nombre }}"></div>
                </div>
                <div class="col-lg-6 order-3">
                    <div class="product_description">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('landing') }}">Productos</a></li>
                                <li class="breadcrumb-item active">{{ $producto->categoria->nombre }}</li>
                            </ol>
                        </nav>
                        <div class="product_name"> {{ $producto->nombre }}</div>                                               
                        <div>
                            <span class="product_price">{{ $producto->precio }} €</span>
                        </div>                       
                      
                        <div class="mt-3"> <span class="product_info">{{ $producto->descripcion }}</span></div>                       
                        <hr class="singleline">
                        <div class="order_info d-flex flex-row">
                            <form action="#">
                        </div>
                        <div class="row">
                            <div class="col-xs-6" style="margin-left: 13px;">
                                <div class="product_quantity"> <span>Cantidad: </span> <input type="number" id="quantity_input" pattern="[0-9]*" value="1">                                    
                                </div>
                            </div>
                            <div class="col-xs-6"> <a href="{{ route('carrito.add', ['id' => $producto->id]) }}" class="add-to-cart"><button type="button" class="btn btn-success shop-button btnAjax">Add to Cart</button></a> 
                            <div id="path-ajax" data-path="{{ route('carrito.ajax') }}"></div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
                <div class="container m-4 p-4">
                    <h1 class="mb-4">Producto no encontrado</h1>
                    <h6 class="ml-5"> {{ $message }}</h6><br>
                    <div class="col-sm" style="margin-bottom: 15%;"></div>
        @endif
             <div class="row row-underline">
                <div class="col-md-6"> <span class=" deal-text">Productos relacionados</span></div>
                <div class="col-md-6"> <a href="#" data-abc="true"> <span class="ml-auto view-all"></span> </a> </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="row padding-2">                    
                        <div class="col-md-5 padding-0">
                            <div class="bbb_combo">
                                <div class="bbb_combo_image"><img class="bbb_combo_image" src="{{ route('image.file', ['filename' => $productos_destacados[0]->imagen]) }}" alt="{{$productos_destacados[0]->nombre}}" title="{{$productos_destacados[0]->nombre}}"></div>
                                <div class="d-flex flex-row justify-content-start"> <strike style="color:red;"> <span class="fs-10" style="color:black;">{{ $productos_destacados[0]->precio + rand(1,20) }} €<span> </span></span></strike> <span class="ml-auto"><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i></span> </div>
                                <div class="d-flex flex-row justify-content-start" style=" margin-bottom: 13px; "> <span style="margin-top: -4px;">{{ $productos_destacados[0]->precio }} €</span> <span class="ml-auto fs-10">0 Reviews</span> </div> <div class="descrip-prod">{{ $productos_destacados[0]->descripcion }}</div>
                                <div class="add-both-cart-button mt-4 mb-4"><a href="{{ route('carrito.add', ['id' => $productos_destacados[0]->id]) }}"><button type="button" class="btn btn-primary shop-button">Add to Cart</button></a></div>
                            </div>
                        </div>
                        <div class="col-md-5 padding-0">
                            <div class="bbb_combo">
                                <div class="bbb_combo_image"><img class="bbb_combo_image" src="{{ route('image.file', ['filename' => $productos_destacados[1]->imagen]) }}" alt="{{$productos_destacados[1]->nombre}}" title="{{$productos_destacados[1]->nombre}}"></div>
                                <div class="d-flex flex-row justify-content-start"> <strike style="color:red;"> <span class="fs-10" style="color:black;">{{ $productos_destacados[1]->precio + rand(1,20) }} €<span> </span></span></strike> <span class="ml-auto"><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i></span> </div>
                                <div class="d-flex flex-row justify-content-start" style=" margin-bottom: 13px; "> <span style="margin-top: -4px;">{{ $productos_destacados[1]->precio }} €</span> <span class="ml-auto fs-10">0 Reviews</span> </div> <div class="descrip-prod">{{ $productos_destacados[1]->descripcion }}</div>
                                <div class="add-both-cart-button mt-4 mb-4"><a href="{{ route('carrito.add', ['id' => $productos_destacados[1]->id]) }}"><button type="button" class="btn btn-primary shop-button">Add to Cart</button></a></div>
                            </div>
                        </div>
                    
                    </div>
                   
                </div>
                <div class="col-md-2 text-center"> <span class="vertical-line"></span> </div>
                <div class="col-md-5" style=" margin-left: -27px;">
                    <div class="row padding-2">
                        <div class="col-md-5 padding-0">
                            <div class="bbb_combo">
                                <div class="bbb_combo_image"><img class="bbb_combo_image" src="{{ route('image.file', ['filename' => $productos_destacados[2]->imagen]) }}" alt="{{$productos_destacados[2]->nombre}}" title="{{$productos_destacados[2]->nombre}}"></div>
                                <div class="d-flex flex-row justify-content-start"> <strike style="color:red;"> <span class="fs-10" style="color:black;">{{ $productos_destacados[2]->precio + rand(1,20) }} €<span> </span></span></strike> <span class="ml-auto"><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i></span> </div>
                                <div class="d-flex flex-row justify-content-start" style=" margin-bottom: 13px; "> <span style="margin-top: -4px;">{{ $productos_destacados[2]->precio }} €</span> <span class="ml-auto fs-10">0 Reviews</span> </div> <div class="descrip-prod">{{ $productos_destacados[2]->descripcion }}</div>
                                <div class="add-both-cart-button mt-4 mb-4"><a href="{{ route('carrito.add', ['id' => $productos_destacados[2]->id]) }}"><button type="button" class="btn btn-primary shop-button">Add to Cart</button></a></div>
                            </div>
                        </div>
                        <div class="col-md-5 padding-0">
                            <div class="bbb_combo">
                                <div class="bbb_combo_image"><img class="bbb_combo_image" src="{{ route('image.file', ['filename' => $productos_destacados[3]->imagen]) }}" alt="{{$productos_destacados[3]->nombre}}" title="{{$productos_destacados[3]->nombre}}"></div>
                                <div class="d-flex flex-row justify-content-start"> <strike style="color:red;"> <span class="fs-10" style="color:black;">{{ $productos_destacados[3]->precio + rand(1,20) }} €<span> </span></span></strike> <span class="ml-auto"><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i></span> </div>
                                <div class="d-flex flex-row justify-content-start" style=" margin-bottom: 13px; "> <span style="margin-top: -4px;">{{ $productos_destacados[3]->precio }} €</span> <span class="ml-auto fs-10">0 Reviews</span> </div> <div class="descrip-prod">{{ $productos_destacados[3]->descripcion }}</div>
                                <div class="add-both-cart-button mt-4 mb-4"><a href="{{ route('carrito.add', ['id' => $productos_destacados[3]->id]) }}"><button type="button" class="btn btn-primary shop-button">Add to Cart</button></a></div>
                            </div>
                        </div>
                    </div>                  
                </div>
            </div>
            @if(is_null($message))
            <div class="row row-underline">
                <div class="col-md-6"> <span class=" deal-text">Specifications</span> </div>
                <div class="col-md-6"> <a href="#" data-abc="true"> <span class="ml-auto view-all"></span> </a> </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="col-md-12">
                        <tbody>
                            <tr class="row mt-10">
                                <td class="col-md-4"><span class="p_specification">Categoria :</span> </td>
                                <td class="col-md-8">
                                    <ul>
                                        <li>{{ $producto->categoria->nombre }}</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="row mt-10">
                                <td class="col-md-4"><span class="p_specification"> Nombre:</span> </td>
                                <td class="col-md-8">
                                    <ul>
                                        <li> {{ $producto->nombre }} </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="row mt-10">
                                <td class="col-md-4"><span class="p_specification"> Descripcion :</span> </td>
                                <td class="col-md-8">
                                    <ul>
                                        <li>{{ $producto->descripcion }}</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="row mt-10">
                                <td class="col-md-4"><span class="p_specification">Precio :</span> </td>
                                <td class="col-md-8">
                                    <ul>
                                        <li>{{ $producto->precio }} €</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr class="row mt-10">
                                <td class="col-md-4"><span class="p_specification">Stock :</span> </td>
                                <td class="col-md-8">
                                    <ul>
                                        <li>{{ $producto->stock }}</li>
                                    </ul>
                                </td>
                            </tr>                            
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>     


@endsection 
