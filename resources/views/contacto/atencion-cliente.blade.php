@extends('layouts.app')

@section('title', 'Atención al cliente')

@section('content')


<div class="container-fluid d-flex container-top">

    @include('includes.sidebarCat')

    <div class="div-content">
        <div class="col-md-10 min-wh-435px">
        <h1 class="text-center noto-sans-jp mb-2 mt-2"><span class="underline">Atención al cliente</span></h1>

        <h3 class="m-4 pt-4 text-center">Bienvenido al apartado de <strong>Atención al cliente</strong>, <br class="mobile-break"> ¿qué desea?</h3>
    </div>
</div>

@endsection