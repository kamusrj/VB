@extends('layouts.master')

@section('title', 'Instituciones')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col mb-3">
                <h2>Nueva venta directa </h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form method="POST" action="{{ url('venta/crear') }}">
                    @csrf
                    @include('errorMj')
                    <div class="form-group">
                        <input type="hidden" name="codigo" id="codigo" value="{{ $school->codigo }}">
                    </div>
                    <div class="form-group mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">{{ $school->nombre }}</h3>
                                <p class="text-muted">Informaci&oacute;n de cabecera de la venta directa.</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="director">Director</label>
                        <input type="text" name="director" class="form-control" id="director">
                    </div>
                    <div class="form-group mb-3">
                        <label for="encargado">Encargado</label>
                        <select name="encargado" class="form-control" id="encargado">
                            <option value="">Selecciona un Encargado</option>
                            @foreach ($encargado as $e)
                                <option value="{{ $e->correo }}">{{ $e->nombre }} {{ $e->apellido }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" name="telefono" class="form-control" id="telefono">
                    </div>
                    <div class="form-group mb-3">
                        <label for="vendedor">Vendedor</label>
                        <select name="vendedor" class="form-control" id="vendedor">
                            <option value="">Selecciona un vendedor</option>
                            @foreach ($vendedores as $vendedor)
                                <option value="{{ $vendedor->correo }}">{{ $vendedor->nombre }} {{ $vendedor->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="zona">Zona</label>
                        <input type="text" name="zona" class="form-control" id="zona">
                    </div>

                    <div class="form-group mb-3">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" class="form-control" id="direccion">
                    </div><br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>

@endsection
