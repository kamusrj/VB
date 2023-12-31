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
            $table->String('fecha_programada');
            $table->string('fecha', 10);
            $table->string('representante', 200);
            $table->foreign('representante')->references('correo')->on('usuario');
            $table->string('n_remision', 50);
            $table->string('factura_i');
            $table->string('factura_f');
            $table->string('cupon_i')->nullable();
            $table->string('cupon_f')->nullable();
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
            $table->double('total')->default(0);
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
           
        });


        Schema::create('detalleFactura', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_venta');
            $table->foreign('id_venta')->references('id')->on('titulo_venta');
            $table->integer('correlativo');
            $table->unsignedBigInteger('id_libro')->nullable();
            $table->foreign('id_libro')->references('id')->on('libro');
            $table->integer('cantidad')->default(0);
            $table->string('padre', 200)->default('---');
            $table->String('fecha_programada');
            $table->string('fecha', 10);
            $table->string('hora');
            $table->set('anulada', ['si', 'no'])->default('no');
            $table->string('motivo', 200)->default('---');
            $table->double('total')->default(0);
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

        DB::statement(" CREATE OR REPLACE VIEW FacturasControl AS
        SELECT
            nota_remision.id_venta,
            nota_remision.fecha_programada,
            (nota_remision.factura_f - nota_remision.factura_i) AS total_facturas,
            COUNT(DISTINCT CASE WHEN detallefactura.anulada = 'si' THEN detallefactura.correlativo END) AS total_anuladas,
            COUNT(DISTINCT CASE WHEN detallefactura.anulada = 'no' THEN detallefactura.correlativo END) AS total_no_anuladas,
            ((nota_remision.factura_f - nota_remision.factura_i) - COUNT(DISTINCT CASE WHEN detallefactura.anulada = 'si' THEN detallefactura.correlativo END)
             - COUNT(DISTINCT CASE WHEN detallefactura.anulada = 'no' THEN detallefactura.correlativo END)) AS total_sin_utilizar,
            COUNT(DISTINCT detallefactura.correlativo) AS total_utilizadas
        FROM
            nota_remision
        LEFT JOIN
            detallefactura ON detallefactura.fecha_programada = nota_remision.fecha_programada
        GROUP BY
            nota_remision.id_venta, nota_remision.fecha_programada, nota_remision.factura_f, nota_remision.factura_i;
         ");


        DB::statement(" CREATE OR REPLACE VIEW Cambio AS
      
        SELECT
        c.id_venta,
        c.tipo,
        c.fecha,
        c.centavo_uno,
        c.centavo_cinco,
        c.centavo_diez,
        c.centavo_veinticinco,
        c.dolar_uno,
        c.dolar_cinco,
        c.dolar_diez,
        c.dolar_veinte,
        ROUND(COALESCE(c.centavo_uno * 0.01, 0), 2) AS c1Total,
        ROUND(COALESCE(c.centavo_cinco * 0.05, 0), 2) AS c5Total,
        ROUND(COALESCE(c.centavo_diez * 0.10, 0), 2) AS c10Total,
        ROUND(COALESCE(c.centavo_veinticinco * 0.25, 0), 2) AS c25Total,
        ROUND(COALESCE(c.dolar_uno * 1.00, 0), 2) AS d1Total,
        ROUND(COALESCE(c.dolar_cinco * 5.00, 0), 2) AS d5Total,
        ROUND(COALESCE(c.dolar_diez * 10.00, 0), 2) AS d10Total,
        ROUND(COALESCE(c.dolar_veinte * 20.00, 0), 2) AS d20Total,
        ROUND(COALESCE(c.dolar_cincuenta * 50.00, 0), 2) AS d50Total,
        ROUND(COALESCE(c.dolar_cien * 100.00, 0), 2) AS d100Total,
        ROUND(
        COALESCE(c.centavo_uno * 0.01, 0) +
        COALESCE(c.centavo_cinco * 0.05, 0) +
        COALESCE(c.centavo_diez * 0.10, 0) +
        COALESCE(c.centavo_veinticinco * 0.25, 0) +
        COALESCE(c.dolar_uno * 1.00, 0) +
        COALESCE(c.dolar_cinco * 5.00, 0) +
        COALESCE(c.dolar_diez * 10.00, 0) +
        COALESCE(c.dolar_veinte * 20.00, 0)+
        COALESCE(c.dolar_cincuenta * 50.00, 0) +
        COALESCE(c.dolar_cien * 100.00, 0) ,
        2
    ) AS totalGeneral
FROM
    efectivo_c c;
          
           ");
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
