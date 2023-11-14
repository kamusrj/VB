<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->string('correo', 100)->primary();
            $table->string('clave', 255);
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->set('rol', ['a', 'v', 'e', 'c', 'b', 'g'])->nullable();
        });
        Schema::create('libro', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->set('editorial', ['ed', 'mdf', 'eng', 'info']);
            $table->text('descripcion')->nullable();
        });
        Schema::create('institucion', function (Blueprint $table) {
            $table->string('codigo', 10)->primary();
            $table->string('nombre', 255);
            $table->set('estado', ['on', 'off'])->default('off');
        });
        Artisan::call('db:seed', ['--class' => 'InicioSeeder']);
    }
    public function down(): void
    {
        Schema::dropIfExists('usuario');
        Schema::dropIfExists('libro');
        Schema::dropIfExists('institucion');
    }
};
