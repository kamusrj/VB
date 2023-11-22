<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\Institucioncontroller;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\PanelControl;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\VentaController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UsuarioMiddleware;
use Illuminate\Support\Facades\Route;


//Inicio 
Route::controller(PrincipalController::class)->group(function () {
    Route::get('/', 'Home');
    Route::post('iniciar', 'Iniciar');
    Route::get('salir', 'Salir');
});


Route::middleware(UsuarioMiddleware::class)->group(function () {

    Route::middleware(AdminMiddleware::class)->group(function () {
        //crud Usuario
        Route::controller(AdminController::class)->prefix('admin')->group(function () {
            Route::get('log', 'verLogs');
            Route::get('listar', 'Listar');
            Route::post("obtener", "Obtener");
            Route::post('crear', 'CrearUsuario');
            Route::post('actualizar', 'actualizarUsuario');
            Route::post('eliminar', 'EliminarUsuario');
        });
    });

    
    Route::controller(FacturaController::class)->prefix('factura')->group(function () {
        Route::post("crear", "CrearFactura");
        Route::get('efectivoCambio/{id}', 'EfectivoCambio');
        Route::post('crearEfectivo', 'CrearEfectivo');
    });

    Route::controller(VentaController::class)->prefix('venta')->group(function () {
        Route::get("/", "perfil");
        Route::post("crear", "Crear");
        Route::get('nueva/{id}', 'NuevaVenta');
        Route::get('facturar/{id}', 'CrearFacturas');
        Route::post('libros', 'ListaLibros');
        Route::get('libros/{id}', 'ListaLibros');
        Route::post('inventarioVenta', 'ventaInventario');
        Route::post('inventario', 'inventario');

        Route::get('bodega', 'perfilBodega');
        Route::post('bodegaBuscar', 'bodegaBuscar');
    });

    Route::controller(LibrosController::class)->prefix('libro')->group(function () {
        Route::get("/", "Listar");
        Route::post("obtener", "Obtener");
        Route::post("buscar", "Buscar");
        Route::post("crear", "CrearLibro");
        Route::post("actualizar", "actualizarLibro");
        Route::post('eliminar', 'EliminarLibro');
    });

    Route::controller(Institucioncontroller::class)->prefix('institucion')->group(function () {
        Route::get("/", "ListarInstitucion");
        Route::post("obtener", "Obtener");
        Route::post("crear", "CrearInstitucion");
        Route::post("actualizar", "ActualizarInstitucion");
        Route::post('eliminar', 'EliminarInstitucion');
        Route::get('venta/{id}', 'Venta');
    });

    //  Panel de control ventas
    Route::controller(PanelControl::class)->prefix('panel')->group(function () {

        //dashboard
        Route::get('controlVenta/{id}', 'controlVenta');
        Route::get('perfilVenta/{id}', 'perfilVenta');
        Route::get('/', 'ListarVentas');
        Route::get('inventario/{id}', 'inventarioVenta');
        Route::post('stockventa', 'stockVenta');

        //Cierre de venta 


    });
});


/*Route::fallback(function () {
    return view("error");
});*/
