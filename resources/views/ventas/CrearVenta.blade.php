@extends('layouts.master')

@section('title', 'Gestión de venta directa')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col mb-3">
                @if ($escuela)
                    <h2>{{ $escuela->nombre }}</h2>
                @else
                    <h2>Nueva venta directa </h2>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form method="POST" action="{{ url('venta/crear') }}">
                    @csrf
                    

                    @if ($escuela)
                        <div class="form-group mb-3">
                            <input type="hidden" name="codigo" id="codigo" value="{{ $escuela->codigo }}">
                        </div>
                        <div class="form-group mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">{{ $escuela->nombre }}</h3>
                                    <p class="text-muted">Informaci&oacute;n de cabecera de la venta directa.</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="codigo">C&oacute;digo de la instituci&oacute;n</label>
                                <input class="form-control" type="number" min="1" max="99999" step="1"
                                    maxlength="5" name="codigo" id="codigo" onblur="obtener()">
                                <div class="form-text">Escribe el c&oacute;digo, si existe una instituci&oacute;n en el
                                    registro se cargaran sus datos</div>
                            </div>
                            <div class="col-md-8">
                                <label for="nombre">Nombre de la instituci&oacute;n</label>
                                <input class="form-control" type="text" name="nombre" id="nombre">
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="director">Director</label>
                                <input type="text" name="director" class="form-control" id="director">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">

                            <label for="encargado">Encargado</label>
                            <select name="encargado" class="form-select" id="encargado">
                                <option selected disabled>Selecciona un Encargado</option>
                                @foreach ($encargado as $e)
                                    <option value="{{ $e->correo }}">{{ $e->nombre }} {{ $e->apellido }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="telefono">Teléfono</label>
                            <input type="tel" name="telefono" class="form-control" id="telefono">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="vendedor">Vendedor</label>
                        <select name="vendedor" class="form-select" id="vendedor">
                            <option selected disabled>Selecciona un vendedor</option>
                            @foreach ($vendedores as $vendedor)
                                <option value="{{ $vendedor->correo }}">{{ $vendedor->nombre }} {{ $vendedor->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="direccion">Dirección</label>
                            <input type="text" name="direccion" class="form-control" id="direccion">

                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="zona">Zona</label>
                            <input type="text" name="zona" class="form-control" id="zona">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        const codigo = document.getElementById('codigo');
        const nombre = document.getElementById('nombre');
        async function obtener() {
            if (codigo.value)
                await fetch("{{ url('institucion/obtener') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        "codigo": codigo.value
                    }),
                }).then((response) => response.json())
                .then((data) => {
                    if (data)
                        nombre.value = data.nombre;
                });
        }
    </script>
@endsection
