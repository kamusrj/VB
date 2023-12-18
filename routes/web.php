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
        Route::get('efectivoCambio/{id}/{fecha}', 'EfectivoCambio');
        Route::post('crearEfectivo', 'CrearEfectivo');

        //gestion de facturas 

        Route::get('facturasLista/{id}/{fecha}', 'listarFacturas');
        Route::post('guardarfactura', 'guardarFactura');
        Route::post('facturaBuscar/{id}/{fecha}', 'facturaBuscar');
    });

    Route::controller(VentaController::class)->prefix('venta')->group(function () {
        Route::get("/", "perfil");
        Route::post("crear", "Crear");
        Route::get('nueva', 'NuevaVenta');
        Route::get('editar/{id}', 'EditarVenta');
        Route::get('facturar/{id}', 'CrearFacturas');
        Route::post('libros', 'ListaLibros');
        Route::get('libros/{id}/{fecha}', 'ListaLibros');

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
        Route::get('programacion/{id}', 'programacion');
        Route::get('programacion/estado/{id}', 'CambiarEstado');
        Route::get('controlVenta/{id}/{fecha}', 'controlVenta');

        // reevia a la vista con fecha  
        Route::get('perfilVenta/{id}/{fecha}', 'perfilVenta');
        Route::get('/', 'ListarVentas');
        Route::get('inventario/{id}/{fecha}', 'inventarioVenta');
        Route::post('stockventa', 'stockVenta');


        //Cierre de venta 



        Route::post('buscarInventario', 'buscarInventario');
        Route::post('actualizarIn', 'actualizarInventario');
        Route::post('actualizarCambio', 'actualizarCambio');

        Route::get('cierre/{id}', 'cierreVenta');
    });
});


/*Route::fallback(function () {
    return view("error");
});*/
