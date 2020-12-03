<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Crear Producto */ 
Route::get('/producto/crear', [ProductoController::class, 'viewCrearProducto'])->name('producto.crear')->middleware('admin'); //funciona
Route::post('/producto/creado', [ProductoController::class, 'crearProducto'])->name('producto.creado')->middleware('admin');


