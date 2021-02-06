@extends('layouts.app')

@section('title', 'Quienes somos')

@section('content')


<div class="container-fluid d-flex container-top">

    @include('includes.sidebarCat')

    <div class="div-content">
        <div class="col-md-10 min-wh-435px">
        <h1 class="text-center noto-sans-jp mb-2 mt-2"><span class="underline">Quiénes somos</span></h1>

        <p class="m-4 pt-4 text-center" style="font-size:18px;">Somos una empresa que lleva creciendo desde 2020, desde su primera tienda en Arroyo la Encomienda hasta oficinas en Lebreda. Desde 2020 ofreciendo la mejor industria de calzado y vestimenta al alcance de un clic.</p>

        <p class="m-4 pt-2 text-center" style="font-size:18px;">Nos establecimos con el propósito de crear marca y expandirnos a nuevos horizontes, esperando un 2021 lleno de sorpresas y clientes agradecidos.</p>
    </div>
</div>

@endsection