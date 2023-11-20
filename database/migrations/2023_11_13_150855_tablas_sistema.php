<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('titulo_venta', function (Blueprint $table) {
            $table->id();
            $table->string('institucion');
            $table->string('director', 200);
            $table->string('encargado', 200);
            $table->foreign('encargado')->references('correo')->on('usuario');
            $table->string('telefono', 50);
            $table->string('vendedor');
            $table->foreign('vendedor')->references('correo')->on('usuario');
            $table->string('zona', 200);
            $table->string('direccion', 80);
            $table->string('autor', 200);
            $table->string('fecha_creacion', 200);
            $table->set('estado', ['on', 'off'])->default('on');
        });
        Schema::create('nota_remision', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_venta');
            $table->foreign('id_venta')->references('id')->on('titulo_venta');
            $table->string('fecha', 200);
            $table->string('representante', 200);
            $table->foreign('representante')->references('correo')->on('usuario');
            $table->string('n_remision', 50);
            $table->integer('factura_i');
            $table->integer('factura_f');
            $table->integer('total_f');
            $table->integer('cupon_i')->nullable();
            $table->integer('cupon_f')->nullable();
            $table->integer('total_c')->nullable();
        });
        Schema::create('efectivo_c', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_venta');
            $table->foreign('id_venta')->references('id')->on('titulo_venta');
            $table->string('fecha', 200);
            $table->double('centavo_uno')->notNull();
            $table->double('centavo_cinco')->notNull();
            $table->double('centavo_diez')->notNull();
            $table->double('centavo_veinticinco')->notNull();
            $table->double('dolar_uno')->notNull();
            $table->double('dolar_cinco')->notNull();
            $table->double('dolar_diez')->notNull();
            $table->double('dolar_veinte')->notNull();
            $table->double('total')->notNull();
        });
        Schema::create('inventario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_venta');
            $table->foreign('id_venta')->references('id')->on('titulo_venta');
            $table->string('fecha', 200);
            $table->unsignedBigInteger('id_libro');
            $table->foreign('id_libro')->references('id')->on('libro');
            $table->integer('stock')->default(0);
            $table->double('precio')->default(0);
            $table->integer('descuento')->default(0);
            $table->double('ofrecimiento_a')->default(0);
            $table->string('fecha_inicio', 200)->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('titulo_venta');
        Schema::dropIfExists('nota_remision');
        Schema::dropIfExists('efectivo_c');
        Schema::dropIfExists('inventario');
    }
};
