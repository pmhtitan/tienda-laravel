<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DatosFacturacionController;
use App\Http\Controllers\HistorialPedidosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TallaController;
use App\Models\HistorialPedidos;
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

/* Route::get('/', function () {
    return view('landing');
}); */

Auth::routes();

Route::get('/', [App\Http\Controllers\ProductoController::class, 'index'])->name('landing');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Crear Producto */ 
Route::get('/producto/crear', [ProductoController::class, 'viewCrearProducto'])->name('producto.crear')->middleware('admin'); //funciona
Route::post('/producto/creado', [ProductoController::class, 'crearProducto'])->name('producto.creado')->middleware('admin');

/* Crear Categoria */
Route::get('/categoria/crear', [CategoriaController::class, 'viewCrearCategoria'])->name('categoria.crear')->middleware('admin');
Route::post('/categoria/creado', [CategoriaController::class, 'crearCategoria'])->name('categoria.creado')->middleware('admin');

/* Gestion Productos */
Route::get('/producto/gestion', [ProductoController::class, 'gestionProductos'])->name('producto.gestion')->middleware('admin');
Route::get('/image/file/{filename}', [ProductoController::class, 'getImage'])->name('image.file');
Route::get('/producto/{id}', [ProductoController::class, 'mostrarProducto'])->name('producto.mostrar');
Route::get('/producto/editar/{id}', [ProductoController::class, 'editar'])->name('producto.editar')->middleware('admin');
Route::get('/producto/eliminar/{id}', [ProductoController::class, 'eliminar'])->name('producto.eliminar')->middleware('admin');
Route::post('/producto/editado', [ProductoController::class, 'editado'])->name('producto.editado')->middleware('admin');

/* Gestion Categorias */
Route::get('/categoria/gestion', [CategoriaController::class, 'gestionCategorias'])->name('categoria.gestion')->middleware('admin');
Route::get('/categoria/{id}', [ProductoController::class, 'mostrarProdByCat'])->name('producto.byCat');
Route::get('/categoria/editar/{id}', [CategoriaController::class, 'editar'])->name('categoria.editar')->middleware('admin');
Route::get('/categoria/eliminar/{id}', [CategoriaController::class, 'eliminar'])->name('categoria.eliminar')->middleware('admin');
Route::post('/categoria/editado', [CategoriaController::class, 'editado'])->name('categoria.editado')->middleware('admin');

/* Datos Facturacion */
Route::get('/cuenta/mis-datos', [DatosFacturacionController::class, 'gestionDatos'])->name('facturacion.datos')->middleware('auth');
Route::post('/cuenta/guardar-facturacion', [DatosFacturacionController::class, 'guardarFacturacion'])->name('facturacion.guardar')->middleware('auth');

/* Carrito */
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::get('/carrito-add/{id}', [CarritoController::class, 'addItem'])->name('carrito.add');
Route::get('/carrito-remove/{index}', [CarritoController::class, 'removeItem'])->name('carrito.remove');
Route::get('/carrito-up/{index}', [CarritoController::class, 'upItem'])->name('carrito.up');
Route::get('/carrito-down/{index}', [CarritoController::class, 'downItem'])->name('carrito.down');
Route::get('/carrito-delete', [CarritoController::class, 'delete_all'])->name('carrito.delete');
Route::get('/checkout', [CarritoController::class, 'checkout'])->name('carrito.checkout');
Route::post('/checkout-start', [CarritoController::class, 'checkout_start'])->name('carrito.checkout_start');

/* Historial pedidos cliente */
Route::get('/cuenta/mis-pedidos', [HistorialPedidosController::class, 'mostrar'])->name('historial.mostrar')->middleware('auth');

/* Gestion Historial */
Route::get('/historial/gestion', [HistorialPedidosController::class, 'gestion'])->name('historial.gestion')->middleware('admin');
Route::post('/historial/estado-pedido', [HistorialPedidosController::class, 'estado'])->name('historial.estado')->middleware('admin');

/* Gestion Tallas */
Route::get('/talla/crear', [TallaController::class, 'viewCrearTalla'])->name('talla.crear')->middleware('admin');
Route::post('/talla/creado', [TallaController::class, 'crearTalla'])->name('talla.creado')->middleware('admin');
Route::get('/talla/gestion', [TallaController::class, 'gestionTallas'])->name('talla.gestion')->middleware('admin');
Route::get('/talla/editar/{id}', [TallaController::class, 'editar'])->name('talla.editar')->middleware('admin');
Route::get('/talla/eliminar/{id}', [TallaController::class, 'eliminar'])->name('talla.eliminar')->middleware('admin');
Route::post('/talla/editado', [TallaController::class, 'editado'])->name('talla.editado')->middleware('admin');

/* Footer */
Route::get('/sobre-nosotros', function () { return view('contacto.sobre-nosotros'); });
Route::get('/quienes-somos', function () { return view('contacto.quienes-somos'); });
Route::get('/donde-encontrarnos', function () { return view('contacto.donde-encontrarnos'); });
Route::get('/atencion-cliente', function () { return view('contacto.atencion-cliente'); });

Route::get('/sobre-nosotros', [HomeController::class, 'sobreNosotros'])->name('contacto.sobre-nosotros');
Route::get('/quienes-somos', [HomeController::class, 'quienesSomos'])->name('contacto.quienes-somos');
Route::get('/donde-encontrarnos', [HomeController::class, 'dondeEncontrarnos'])->name('contacto.donde-encontrarnos');
Route::get('/atencion-cliente', [HomeController::class, 'atencionCliente'])->name('contacto.atencion-cliente');


