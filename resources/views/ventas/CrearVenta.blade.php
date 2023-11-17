@extends('layouts.master')

@section('title', 'Instituciones')

@section('content')
<div class="container">
    <h2>Nueva venta directa </h2>
    <form method="POST" action="{{ url('venta/crear') }}">
        @csrf
        @include('errorMj')
        <div class="form-group">
            <label for="Primaria"></label>
            <input type="hidden" name="codigo" style="background-color: #f6f6f6;" class="form-control" id="codigo" value="{{$school->codigo}}" readonly>
            @if (Auth::check())
            <input type="hidden" name="autor" style="background-color: #f6f6f6;" class="form-control" id="autor" value="{{ Auth::user()->nombre }} {{ Auth::user()->apellido}}" readonly>
            @endif
        </div>
        <div class="form-group">
            <label for="Director">Fecha de inicio</label>
            <input type="date" name="fecha_creacion" class="form-control" id="fecha_creacion" style="width: 45%;">
        </div>
        <div class="form-group">
            <label for="Primaria">Institución</label>
            <input type="text" name="institucion" style="background-color: #f6f6f6;" class="form-control" id="institucion" value="{{ $school->nombre }}" readonly>
        </div>

        <div class="form-group">
            <label for="Director">Director</label>
            <input type="text" name="director" class="form-control" id="director">
        </div>
        <label for="Vendedor">Encargado</label>
        <select name="encargado" class="form-control" id="Vendedor">
            <option value="">Selecciona un Encargado</option>
            @foreach($encargado as $e)
            <option value="{{ $e->correo }}">{{ $e->nombre }} {{ $e->apellido }}</option>
            @endforeach
        </select>

        <div class="form-group">
            <label for="Vendedor">Teléfono</label>

            <input type="text" name="telefono" class="form-control" id="telefono">
        </div>
        <label for="Vendedor">Vendedor</label>
        <select name="vendedor" class="form-control" id="Vendedor">
            <option value="">Selecciona un vendedor</option>
            @foreach($vendedores as $vendedor)
            <option value="{{ $vendedor->correo }}">{{ $vendedor->nombre }} {{ $vendedor->apellido }}</option>
            @endforeach
        </select>

        <div class="form-group">
            <label for="Zona">Zona</label>
            <input type="text" name="zona" class="form-control" id="Zona">
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" class="form-control" id="direccion">
        </div><br>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

@endsection

@section('script')