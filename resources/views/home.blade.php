@extends('layouts.app')

@section('title', 'Dashboard')

@section('javascripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center min-wh-435px">
        <div class="col-md-10 mb-4">
            <div class="card">
            @include('includes.message')
                @if(\Auth::user()->roles == 'admin')
                <div class="card-header">Dashboard admin</div>
                @else
                <div class="card-header">Dashboard de cliente</div>
                @endif

                <div class="card-body">
                    @if(\Auth::user()->roles == 'admin')
                        <h4>Bienvenido a tu Dashboard de admin, ¿qué deseas?</h4>
                        <div class="col-md-12 pt-4 pb-3">
                            <div class="row mb-3 text-center-movile">
                                <div class="col-md-2">Crear</div>
                                <div class="col-md-4 col-6">
                                    <a href="{{ route('producto.crear') }}"><button class="btn btn-info2">Crear producto</button></a>    
                                </div>
                                <div class="col-md-1 d-none"></div>
                                <div class="col-md-4 col-6">
                                    <a href="{{ route('categoria.crear') }}"><button class="btn btn-info2">Crear categoria</button></a>
                                </div>
                                <div class="col-md-1 d-none"></div>                               
                            </div>
                            <div class="row text-center-movile pb-3">
                                <div class="col-md-2">Gestionar</div>
                                <div class="col-md-4 col-6">
                                    <a href="{{ route('producto.gestion') }}"><button class="btn btn-primary">Gestionar productos</button></a>    
                                </div>
                                <div class="col-md-1 d-none"></div>
                                <div class="col-md-4 col-6">
                                    <a href="{{ route('categoria.gestion') }}"><button class="btn btn-primary">Gestionar categorias</button></a>
                                </div>
                                <div class="col-md-1 d-none"></div>                               
                            </div>  
                            <div class="row text-center-movile">
                                <div class="col-md-2">Tallas</div>
                                <div class="col-md-4 col-6">
                                    <a href="{{ route('talla.crear') }}"><button class="btn btn-light">Crear tallas</button></a>    
                                </div>
                                <div class="col-md-1 d-none"></div>
                                <div class="col-md-4 col-6">
                                    <a href="{{ route('talla.gestion') }}"><button class="btn btn-light">Gestionar tallas</button></a>
                                </div>
                                <div class="col-md-1 d-none"></div>                               
                            </div>                           
                            <div class="row text-center-movile mt-4">
                                <div class="col-2"></div>
                                <div class="col-8 col-md-7 text-center mb-2">Historial de pedidos</div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row text-center-movile">
                                <div class="col-2"></div>
                                <div class="col-8 col-md-7 text-center">
                                    <a href="{{ route('historial.gestion') }}"><button class="btn btn-dark">Gestionar pedidos</button></a>
                                </div>
                                <div class="col-2"></div>                               
                            </div>
                        </div>

                        <!-- CHARTS -->
                        <div class="col-md-12">
                            <div class="row">  
                                                         
                                <div class="col-md-5">
                                    <canvas id="MonthlyChart" class="mt-2 mb-2" width="400" height="400"></canvas>
                                </div>
                               
                             
                                <div class="col-md-1"></div>                     
                                <div class="col-md-5">
                                    <canvas id="StatusChart"  class="mt-2 mb-2" width="400" height="400"></canvas>
                                </div>
                                
                            </div>
                        </div>  
                                <script>

                                    var month = <?php echo $month ?>;
                                    var monthlyOrders = <?php echo $monthlyOrders ?>;
                                    var statuss = <?php echo $status ?>;
                                    var statusOrders = <?php echo $statusOrders ?>;

                                    var ctx = document.getElementById('MonthlyChart').getContext('2d');
                                    var ctx2 = document.getElementById('StatusChart').getContext('2d');

                                    // Monthly Orders Chart
                                    var monthlyChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: month,
                                            datasets: [{
                                                label: 'Nº de pedidos',
                                                data: monthlyOrders,
                                                backgroundColor: [
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)',
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)',
                                                ],
                                                borderColor: [
                                                    'rgba(255,99,132,1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)',
                                                    'rgba(255,99,132,1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)',
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            title: {
                                                display: true,
                                                text: 'Pedidos por mes',
                                                position: 'top',
                                            },
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                    }
                                                }]
                                            }
                                        }
                                    });

                                    // Status Orders Chart                                    
                                    var statusChart = new Chart(ctx2, {
                                        type: 'doughnut',
                                        data: {
                                            labels: statuss,
                                            datasets: [{
                                                label: 'Estado de pedidos',
                                                data: statusOrders,
                                                backgroundColor: [                                                                                                   
                                                    'rgba(255, 159, 64, 0.6)',
                                                    'rgba(153, 102, 255, 0.6)',
                                                    'rgba(75, 192, 192, 0.6)',
                                                ],
                                                borderColor: [                                                                                                 
                                                    'rgba(255, 159, 64, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                ],
                                                borderWidth: 2
                                            }]
                                        },
                                        options: {
                                            title: {
                                                display: true,
                                                text: 'Estado de pedidos',
                                                position: 'top',
                                            },
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                    }
                                                }]
                                            }
                                        }
                                    });
                                </script>
                    @else
                        <h4>Bienvenido a tu Dashboard de cliente, ¿qué deseas?</h4>
                        <div class="col-md-12 pt-3 pb-3">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <a href="{{ route('historial.mostrar') }}"><button class="btn btn-info2">Historial de pedidos</button></a>    
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <a href="{{ route('facturacion.datos') }}"><button class="btn btn-primary">Mis datos de facturación</button></a>
                                </div>
                                <div class="col-md-1"></div>                               
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
