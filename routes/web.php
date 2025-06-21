<?php

use App\Http\Controllers\ComprasController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\ProduccionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\VentaproductoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Types\Relations\Role;

//Rutas del login
Route::get('/', [LoginController::class,'index'])->name('login');

//Ruta del Inicio
Route::post('/inicio', [InicioController::class, 'index'])->name('inicio');


//Ruta de Usuarios
Route::get('/usuario', [UsuarioController::class,'index'])->name('usuarios.index');

//Ruta de Permisos
Route::get('/permisos', [PermisosController::class,'index'])->name('permisos.index');

//Ruta de Compras
Route::get('/compras', [ComprasController::class,'index'])->name('compras.index');

//Ruta de Produccion
Route::get('/produccion', [ProduccionController::class,'index'])->name('produccion.index');

//Ruta de Productos
Route::get('/productos', [ProductoController::class,'index'])->name('producto.index');

//Ruta de Venta
Route::get('/venta', [VentaController::class,'index'])->name('venta.index');

//Ruta de Ventas-Productos
Route::get('/ventaproducto', [VentaproductoController::class,'index'])->name('ventaproducto.index');