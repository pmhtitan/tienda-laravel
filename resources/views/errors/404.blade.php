@extends('layouts.app')

@section('title', '¡Ups! Página no encontrada')

@section('content')

    <div class="container" style="min-height:400px;">
        <h1 class="text-center p-4 y-4">¡Ups! Página no encontrada</h1>
        <h3 class="text-center p-2">¿Necesitas ayuda?</h3>
        <h4 class="text-center">Echa un ojo a nuestro catálogo<a href="{{ URL::to('/') }}" class="btn btn-success ml-3">Productos destacados</a></h4>
    </div>
@endsection