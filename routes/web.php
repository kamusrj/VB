<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\Institucioncontroller;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\VentaController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UsuarioMiddleware;
use App\Models\Institucion;
use Illuminate\Support\Facades\Route;




Route::controller(PrincipalController::class)->group(function () {
    Route::get('/', 'home');
    Route::post('iniciar', 'iniciar');
    Route::get('salir', 'logout');
});

Route::middleware(UsuarioMiddleware::class)->group(function () {
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::controller(AdminController::class)->prefix('admin')->group(function () {
            Route::get('log', 'verLogs');
            Route::get('listar', 'listar');
            Route::post("up", "Obtener");
            Route::post('crear', 'CrearUsuario');
            Route::post('actualizar', 'actualizarUsuario');
            Route::post('delete', 'EliminarUsuario');
        });
    });



    Route::controller(PedidosController::class)->prefix('venta')->group(function () {
        Route::get("/", "listar");
    });
    Route::controller(FacturaController::class)->prefix('factura')->group(function () {
        Route::post("create", "CrearFactura");
        Route::get('efectivoCambio/{id}','efectuviCambio');
        Route::get('/libro/{id}', 'obtenerDatosDelLibro');
        Route::post("update", "actualizarFactura");
        Route::post('delete', 'EliminarFactura ');
    });
    Route::controller(VentaController::class)->prefix('venta')->group(function () {
        Route::get("/", "perfil");
        Route::post("crear", "Crear");
        Route::get('ventac/{id}', 'CrearVenta');
        Route::get('ventaf/{id}', 'CrearFacturas');
    });
    Route::controller(LibrosController::class)->prefix('libro')->group(function () {
        Route::get("/", "listar");
        Route::post("up", "Obtener");
        Route::post("buscar", "Buscar");
        Route::post("crear", "CrearLibro");
        Route::post("update", "actualizarLibro");
        Route::post('delete', 'EliminarLibro');
    });
    Route::controller(Institucioncontroller::class)->prefix('institucion')->group(function () {
        Route::get("/", "listarInstitucion");
        Route::post("up", "Obtener");
        Route::post("crear", "CrearInstitucion");
        Route::post("update", "actualizarInstitucion");
        Route::post('delete', 'EliminarInstitucion');
        Route::get('venta/{id}', 'venta');
    });
    // prueba 4 partes


});

/*Route::fallback(function () {
    return view("error");
});*/
