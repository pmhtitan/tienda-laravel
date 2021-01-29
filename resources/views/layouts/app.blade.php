<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Tienda Laravel - @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    @yield('javascripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/all.css') }}" rel="stylesheet">
    @yield('fonts')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styleapp.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   Tienda Laravel
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest <!-- NO autenticado -->
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else <!-- SI autenticado -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('home') }}">
                                        Dashboard
                                </a>

                                @if(\Auth::user()->roles == 'admin')
                                <a class="dropdown-item" href="{{ route('producto.crear') }}">
                                        Crear producto
                                </a>

                                <a class="dropdown-item" href="{{ route('categoria.crear') }}">
                                        Crear categoria
                                </a>

                                <a class="dropdown-item" href="{{ route('producto.gestion') }}">
                                        Gestion productos
                                </a>

                                <a class="dropdown-item" href="{{ route('categoria.gestion') }}">
                                        Gestion categorias
                                </a>
                                @else

                                <a class="dropdown-item" href="{{ route('facturacion.datos') }}">
                                        Mis datos
                                </a>

                                @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                         
                        @endguest

                        <a href="/carrito" class="pl-2">                                   
                                <div class="texto-cart">Cart</div>     
                            </a>  
                            <a href="/carrito">            
                                <div class="icon-cart">                                    
                                    <div class="cart-line-1" style="background-color: #2f5b7b"></div>
                                    <div class="cart-line-2" style="background-color: #2f5b7b"></div>
                                    <div class="cart-line-3" style="background-color: #2f5b7b"></div>
                                    <div class="cart-wheel" style="background-color: #2f5b7b"></div>
                                </div>
                            </a>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

                <!-- Footer -->
        <footer class="bg-light text-center text-lg-start">
        <!-- Grid container -->
        <div class="container p-4">
            <!--Grid row-->
            <div class="row">
            <!--Grid column-->
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0 text-center">
                <h5 class="text-uppercase">TIENDA LARAVEL</h5>                    
                <p class="col-lg-12 footer-text">
                Tienda especializada en calzado y vestimenta para ambos géneros. Las mejores ofertas del mercado a precio competente.
                </p>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">LO MÁS BUSCADO</h5>

                <ul class="list-unstyled mb-0">
                <li>
                    <a href="{{ URL::to('/categoria/4') }}" class="text-dark">Abrigos</a>
                </li>
                <li>
                    <a href="{{ URL::to('/categoria/2') }}" class="text-dark">Pantalones</a>
                </li>
                <li>
                    <a href="{{ URL::to('/categoria/1') }}" class="text-dark">Sudaderas</a>
                </li>
                <li>
                    <a href="{{ URL::to('/categoria/3') }}" class="text-dark">Zapatillas</a>
                </li>
                </ul>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">CONTACTO</h5>

                <ul class="list-unstyled">
                <li>
                    <a href="#!" class="text-dark">Sobre nosotros</a>
                </li>
                <li>
                    <a href="#!" class="text-dark">Quiénes somos</a>
                </li>
                <li>
                    <a href="#!" class="text-dark">Dónde encontrarnos</a>
                </li>
                <li>
                    <a href="#!" class="text-dark">Atención al cliente</a>
                </li>
                </ul>
            </div>
            <!--Grid column-->
            </div>
            <!--Grid row-->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2021 Tienda Laravel:
            <a class="text-dark" href="https://www.linkedin.com/in/pablo-moras/">Pablo Moras</a>
        </div>
        <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </div>
</body>
</html>
