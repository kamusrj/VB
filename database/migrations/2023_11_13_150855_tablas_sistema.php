<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('titulo_venta', function (Blueprint $table) {
            $table->id();
            $table->string('institucion', 6);
            $table->string('director', 200);
            $table->string('encargado', 200);
            $table->string('telefono', 50);
            $table->string('vendedor');
            $table->string('zona', 200);
            $table->string('direccion', 80);
            $table->string('autor', 200);
            $table->string('fecha_creacion', 10);
            $table->set('estado', ['on', 'off'])->default('on');
            $table->foreign('encargado')->references('correo')->on('usuario');
            $table->foreign('vendedor')->references('correo')->on('usuario');
            $table->foreign('institucion')->references('codigo')->on('institucion');
        });
        Schema::create('nota_remision', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_venta');
            $table->foreign('id_venta')->references('id')->on('titulo_venta');
            $table->string('fecha', 10);
            $table->string('representante', 200);
            $table->foreign('representante')->references('correo')->on('usuario');
            $table->string('n_remision', 50);
            $table->integer('factura_i');
            $table->integer('factura_f');
            $table->integer('cupon_i')->nullable();
            $table->integer('cupon_f')->nullable();
        });
        Schema::create('efectivo_c', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_venta');
            $table->foreign('id_venta')->references('id')->on('titulo_venta');
            $table->set('tipo', ['v', 'c', 'r']);
            $table->string('fecha', 10);
            $table->double('centavo_uno')->notNull();
            $table->double('centavo_cinco')->notNull();
            $table->double('centavo_diez')->notNull();
            $table->double('centavo_veinticinco')->notNull();
            $table->double('dolar_uno')->notNull();
            $table->double('dolar_cinco')->notNull();
            $table->double('dolar_diez')->notNull();
            $table->double('dolar_veinte')->notNull();
            $table->double('dolar_cincuenta')->default(0);
            $table->double('dolar_cien')->default(0);
        });
        Schema::create('inventario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_venta');
            $table->foreign('id_venta')->references('id')->on('titulo_venta');
            $table->string('fecha', 10);
            $table->unsignedBigInteger('id_libro');
            $table->foreign('id_libro')->references('id')->on('libro');
            $table->integer('stock')->default(0);
            $table->integer('stock_venta')->default(0);
            $table->double('precio')->default(0);
            $table->integer('descuento')->default(0);
            $table->double('ofrecimiento_a')->default(0);
            $table->string('fecha_inicio', 200)->nullable();
        });


        Schema::create('detalleFactura', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_venta');
            $table->foreign('id_venta')->references('id')->on('titulo_venta');
            $table->integer('correlativo');
            $table->unsignedBigInteger('id_libro');
            $table->foreign('id_libro')->references('id')->on('libro');
            $table->integer('cantidad');
            $table->string('padre', 200);
            $table->string('fecha', 10);
            $table->string('hora');
        });

        DB::statement(' CREATE OR REPLACE VIEW DatoVenta AS
        SELECT
            dv.id_venta,
            dv.fecha,
            dv.id_libro,
            dv.stock,
            dv.stock_venta,
            dv.precio,
            dv.descuento,
            dv.ofrecimiento_a,
            dv.fecha_inicio,
            dv.stock - dv.stock_venta AS vendido,
            CAST((dv.stock - dv.stock_venta) * dv.precio AS DECIMAL(10, 2)) AS totalventa,
            CAST((dv.precio * dv.descuento / 100) AS DECIMAL(10, 2)) AS reintegro,
            CAST((dv.stock - dv.stock_venta) * (dv.precio * dv.descuento / 100) AS DECIMAL(10, 2)) AS totalReintegro,
            CAST((dv.stock - dv.stock_venta) * ofrecimiento_a AS DECIMAL(10, 2)) AS totaloa,
            lb.nombre AS nombre_libro
        FROM
            inventario dv
        JOIN
            libro lb ON dv.id_libro = lb.id;
            
            
    ');
    }

    public function down(): void
    {
        Schema::dropIfExists('titulo_venta');
        Schema::dropIfExists('nota_remision');
        Schema::dropIfExists('efectivo_c');
        Schema::dropIfExists('inventario');
        Schema::dropIfExists('detalleFactura');
    }
};
