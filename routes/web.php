<?php

use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;

// Rutas públicas
Route::redirect('/', 'ventas/create');
Route::redirect('/home', 'ventas/create');

// Rutas de autenticación
Auth::routes();

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::resource('alamacen/categoria', CategoriaController::class);
    Route::resource('alamacen/producto', ProductoController::class);
    Route::resource('ventas', VentaController::class);

    Route::get('/almacen/categoria', [CategoriaController::class, 'index']);
    Route::get('/almacen/producto', [ProductoController::class, 'index']);
    Route::get('/ventas', [VentaController::class, 'index']);
});
