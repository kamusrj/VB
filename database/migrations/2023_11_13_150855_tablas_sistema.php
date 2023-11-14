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
            $table->string('telefono', 50);
            $table->string('vendedor');
            $table->foreign('vendedor')->references('correo')->on('usuario');
            $table->string('zona', 200);
            $table->string('direccion', 80);
        });
        Schema::create('nota_remision', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_venta');
            $table->foreign('id_venta')->references('id')->on('titulo_venta');
            $table->string('fecha', 200);
            $table->string('representante', 200);
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
            $table->double('c_1')->notNull();
            $table->double('c_5')->notNull();
            $table->double('c_10')->notNull();
            $table->double('c_25')->notNull();
            $table->double('d_1')->notNull();
            $table->double('d_5')->notNull();
            $table->double('d_10')->notNull();
            $table->double('d_25')->notNull();
            $table->double('total')->notNull();
        });
        Schema::create('inventario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_venta');
            $table->foreign('id_venta')->references('id')->on('titulo_venta');
            $table->string('fecha', 200);
            $table->unsignedBigInteger('id_libro');
            $table->foreign('id_libro')->references('id')->on('libro');
            $table->integer('stock');
            $table->double('precio')->notNull();
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
