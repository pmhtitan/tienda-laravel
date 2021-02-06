@extends('layouts.app')

@section('title', 'Donde encontrarnos')

@section('content')


<div class="container-fluid d-flex container-top">

    @include('includes.sidebarCat')

    <div class="div-content">
        <div class="col-md-10 min-wh-435px">
        <h1 class="text-center noto-sans-jp mb-2 mt-2"><span class="underline">Donde encontrarnos</span></h1>
            
        <p class="m-4 pt-4 text-center noto-sans-jp" style="font-size:18px;">Estamos en <strong>Calle de la Cigueña, nº 23, zona noreste urbana. 47654 Valladolid, España.</strong></p>

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2981.403271663988!2d-4.712011384605543!3d41.64702817924118!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4712bee62e1a35%3A0xbffc96b05ce3d79e!2sCalle%20de%20la%20Cig%C3%BCe%C3%B1a%2C%20Valladolid!5e0!3m2!1ses!2ses!4v1612627414600!5m2!1ses!2ses" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>
</div>

@endsection