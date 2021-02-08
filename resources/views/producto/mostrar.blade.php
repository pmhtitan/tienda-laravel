@extends('layouts.app')

@section('title')
    @if(is_null($message))
        {{ $producto->nombre }}
    @else
        Producto no encontrado
    @endif
@endsection

@section('content')

   <div class="super_container">    
    <div class="single_product">
        <div class="container-fluid" style=" background-color: #fff; padding: 11px;">
            <div class="row xzoom-container">
             @if(is_null($message))
                <div class="col-lg-4 order-lg-2 order-1">
                    <div class="image_selected"><img src="{{ route('image.file', ['filename' => $producto->imagen]) }}" class="xzoom" xoriginal="{{ route('image.file', ['filename' => $producto->imagen]) }}" alt="{{ $producto->nombre }}" title="{{ $producto->nombre }}"></div>
                </div>
                <div class="col-lg-2 order-lg-1 order-2 xzoom-thumbs">
                    <ul class="image_list">
                        <li><a href="{{ route('image.file', ['filename' => $producto->imagen]) }}"><img src="{{ route('image.file', ['filename' => $producto->imagen]) }}" class="xzoom-gallery" ></a></li>
                        @if(count($imagenes_prod) != 0)
                            @for($i = 0; $i < 2; $i++)
                                @if($imagenes_prod[$i])
                                <li><a href="{{ route('image.file', ['filename' => $imagenes_prod[$i]->nombre ]) }}"><img src="{{ route('image.file', ['filename' => $imagenes_prod[$i]->nombre ]) }}" class="xzoom-gallery"></a></li>
                                @else
                                <li><img src="{{ asset('img/no-image.png') }}"></li>
                                @endif
                            @endfor
                        @else
                        <li><img src="{{ asset('img/no-image.png') }}"></li>
                        <li><img src="{{ asset('img/no-image.png') }}"></li>
                        @endif
                    </ul>
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
                        <div class="row">
                            <form method="GET" action="{{ route('carrito.add', ['id' => $producto->id]) }}">
                                @csrf
                                <div class="div-talla">
                                    <div class="col-xs-6 inblock text-talla">Talla</div>
                                    <div class="col-xs-6 inblock">
                                        @for($i = 0; $i < count($tallas); $i++)
                                            <label class="container-checkbox-talla">{{ $tallas[$i]->talla->nombre }}
                                                @if($i == 0)
                                                <input type="radio" name="radio" checked="checked">
                                                @else
                                                <input type="radio" name="radio">
                                                @endif
                                                <span class="checkmark"></span>
                                            </label>
                                        @endfor
                                    </div>
                                </div>
                                <div class="col-xs-6" style="margin-left: 13px; display:inline;">
                                    <div class="product_quantity">
                                        <span>Cantidad: </span> <input type="number" name="quantity_input" pattern="[0-9]*" value="1">                                    
                                    </div>
                                </div>
                                <div class="col-xs-6" style="display:inline-block;">
                                    <button type="submit" class="btn btn-success shop-button btnAjax" name="submitAddtoCart">Add to cart</button>                            
                                </div>
                            </form>
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
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <div class="row padding-2">                    
                        <div class="col-md-5 padding-0">
                            <div class="bbb_combo">
                                <div class="bbb_combo_image"><a href="{{ route('producto.mostrar', ['id' => $productos_destacados[0]->id]) }}"><img class="bbb_combo_image" src="{{ route('image.file', ['filename' => $productos_destacados[0]->imagen]) }}" alt="{{$productos_destacados[0]->nombre}}" title="{{$productos_destacados[0]->nombre}}"></a></div>
                                <div class="d-flex flex-row justify-content-start"> <strike style="color:red;"> <span class="fs-10" style="color:black;">{{ $productos_destacados[0]->precio + rand(1,20) }} €<span> </span></span></strike> <span class="ml-auto"><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i></span> </div>
                                <div class="d-flex flex-row justify-content-start" style=" margin-bottom: 13px; "> <span style="margin-top: -4px;">{{ $productos_destacados[0]->precio }} €</span> <span class="ml-auto fs-10">0 Reviews</span> </div> <div class="descrip-prod">{{ $productos_destacados[0]->descripcion }}</div>
                                <div class="add-both-cart-button mt-4 mb-4"><a href="{{ route('carrito.add', ['id' => $productos_destacados[0]->id]) }}"><button type="button" class="btn btn-primary shop-button">Add to Cart</button></a></div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-5 padding-0">
                            <div class="bbb_combo">
                                <div class="bbb_combo_image"><a href="{{ route('producto.mostrar', ['id' => $productos_destacados[1]->id]) }}"><img class="bbb_combo_image" src="{{ route('image.file', ['filename' => $productos_destacados[1]->imagen]) }}" alt="{{$productos_destacados[1]->nombre}}" title="{{$productos_destacados[1]->nombre}}"></a></div>
                                <div class="d-flex flex-row justify-content-start"> <strike style="color:red;"> <span class="fs-10" style="color:black;">{{ $productos_destacados[1]->precio + rand(1,20) }} €<span> </span></span></strike> <span class="ml-auto"><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i></span> </div>
                                <div class="d-flex flex-row justify-content-start" style=" margin-bottom: 13px; "> <span style="margin-top: -4px;">{{ $productos_destacados[1]->precio }} €</span> <span class="ml-auto fs-10">0 Reviews</span> </div> <div class="descrip-prod">{{ $productos_destacados[1]->descripcion }}</div>
                                <div class="add-both-cart-button mt-4 mb-4"><a href="{{ route('carrito.add', ['id' => $productos_destacados[1]->id]) }}"><button type="button" class="btn btn-primary shop-button">Add to Cart</button></a></div>
                            </div>
                        </div>
                    
                    </div>
                   
                </div>
                <div class="col-md-1 text-center"> <span class="vertical-line"></span> </div>
                <div class="col-md-4">
                    <div class="row padding-2">
                        <div class="col-md-5 padding-0">
                            <div class="bbb_combo">
                                <div class="bbb_combo_image"><a href="{{ route('producto.mostrar', ['id' => $productos_destacados[2]->id]) }}"><img class="bbb_combo_image" src="{{ route('image.file', ['filename' => $productos_destacados[2]->imagen]) }}" alt="{{$productos_destacados[2]->nombre}}" title="{{$productos_destacados[2]->nombre}}"></a></div>
                                <div class="d-flex flex-row justify-content-start"> <strike style="color:red;"> <span class="fs-10" style="color:black;">{{ $productos_destacados[2]->precio + rand(1,20) }} €<span> </span></span></strike> <span class="ml-auto"><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i></span> </div>
                                <div class="d-flex flex-row justify-content-start" style=" margin-bottom: 13px; "> <span style="margin-top: -4px;">{{ $productos_destacados[2]->precio }} €</span> <span class="ml-auto fs-10">0 Reviews</span> </div> <div class="descrip-prod">{{ $productos_destacados[2]->descripcion }}</div>
                                <div class="add-both-cart-button mt-4 mb-4"><a href="{{ route('carrito.add', ['id' => $productos_destacados[2]->id]) }}"><button type="button" class="btn btn-primary shop-button">Add to Cart</button></a></div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-5 padding-0">
                            <div class="bbb_combo">
                                <div class="bbb_combo_image"><a href="{{ route('producto.mostrar', ['id' => $productos_destacados[3]->id]) }}"><img class="bbb_combo_image" src="{{ route('image.file', ['filename' => $productos_destacados[3]->imagen]) }}" alt="{{$productos_destacados[3]->nombre}}" title="{{$productos_destacados[3]->nombre}}"></a></div>
                                <div class="d-flex flex-row justify-content-start"> <strike style="color:red;"> <span class="fs-10" style="color:black;">{{ $productos_destacados[3]->precio + rand(1,20) }} €<span> </span></span></strike> <span class="ml-auto"><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i><i class="fa fa-star p-rating"></i></span> </div>
                                <div class="d-flex flex-row justify-content-start" style=" margin-bottom: 13px; "> <span style="margin-top: -4px;">{{ $productos_destacados[3]->precio }} €</span> <span class="ml-auto fs-10">0 Reviews</span> </div> <div class="descrip-prod">{{ $productos_destacados[3]->descripcion }}</div>
                                <div class="add-both-cart-button mt-4 mb-4"><a href="{{ route('carrito.add', ['id' => $productos_destacados[3]->id]) }}"><button type="button" class="btn btn-primary shop-button">Add to Cart</button></a></div>
                            </div>
                        </div>
                    </div>                  
                </div>
                <div class="col-md-1"></div>
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
