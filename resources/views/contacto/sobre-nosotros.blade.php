@extends('layouts.app')

@section('title', 'Sobre nosotros')

@section('content')


<div class="container-fluid d-flex container-top">

    @include('includes.sidebarCat')

    <div class="div-content">
        <div class="col-md-10 min-wh-435px">
            <h1 class="text-center noto-sans-jp mb-2 mt-2"><span class="underline">Sobre nosotros</span></h1>
            
            <div class="m-4">
                <blockquote class="blockquote text-center pt-4">
                    <p><span class="quotemark">“</span>Happiness is not in money, but in shopping.<span class="quotemark">”</span> </p>
                    <footer class="blockquote-footer">Marilyn Monroe</footer>
                </blockquote>   
            </div>
            <p class="m-4 pt-2 text-center" style="font-size:18px;">Tienda Laravel busca los productos más asequibles en el mercado de vestimenta y calzado, para llegar a nuestros usuarios la máxima conformidad a un precio competente.</p>
        </div>
    </div>
</div>

@endsection