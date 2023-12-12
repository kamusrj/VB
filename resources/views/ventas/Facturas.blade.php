@extends('layouts.master')

@section('title', 'Documentos Contables')

@section('content')

<div class="container">


    <div class="row">
        <div class="col mb-3">
            <h2> Entrega de documentos </h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form method="post" action="{{ url('factura/crear') }}">
                @include('errorMj')
                @csrf
                <input type="number" name="id_venta" value="{{ $tituloVenta->id }}" hidden>
                <div class="form-group mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">
                                {{ $institucion->nombre }}
                            </h3>
                            <p class="text-muted">
                                Datos de cambio de efectivo
                            </p>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="representante">Departamento de cr&eacute;dito venta asignada a: </label>
                    <select name="representante" class="form-control" id="representante">
                        <option value="">Selecciona un Encargado</option>
                        @foreach ($conta as $c)
                        <option value="{{ $c->correo }}">{{ $c->nombre }} {{ $c->apellido }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="n_remision">Nota / Notas de remisi&oacute;n</label>
                    <input type="text" name="n_remision" class="form-control" id="n_remision">
                </div>
                <div class="form-group">
                    <label for="factura_i">Factura inicial</label>
                    <input type="number" value="0" min="0" step="1" name="factura_i" class="form-control" id="factura_i" oninput="actualizarTotalFacturas()">
                </div>
                <div class="form-group">
                    <label for="factura_f">Factura final</label>
                    <input type="number" value="0" min="0" step="1" name="factura_f" class="form-control" id="factura_f" oninput="actualizarTotalFacturas()">
                </div>
                <div class="mb-3">
                    <p>Total de facturas: <span id="total_f"></span></p>
                </div>
                <div class="form-group">
                    <label for="cupon_i">Cup&oacute;n inicial</label>
                    <input type="number" value="0" min="0" step="1" name="cupon_i" class="form-control" id="cupon_i" oninput="calcularTotalCupones()">
                </div>
                <div class="form-group">
                    <label for="cupon_f">Cup&oacute;n final</label>
                    <input type="number" value="0" min="0" step="1" name="cupon_f" class="form-control" id="cupon_f" oninput="calcularTotalCupones()">
                </div>
                <div class="mb-3">
                    <p>Total de cupones: <span id="cupon_t"></span></p>
                </div><br>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    const facturaInicialInput = document.getElementById("factura_i");
    const facturaFinalInput = document.getElementById("factura_f");
    const totalFacturasInput = document.getElementById("total_f");

    function actualizarTotalFacturas() {

        let facturaInicial = facturaInicialInput.value || 0;
        let facturaFinal = facturaFinalInput.value || 0;
        let totalFacturas = facturaFinal - facturaInicial;
        totalFacturasInput.innerText = totalFacturas;
    }

    const cuponInicialInput = document.getElementById("cupon_i");
    const cuponFinalInput = document.getElementById("cupon_f");
    const totalCuponesInput = document.getElementById("cupon_t");

    function calcularTotalCupones() {
        var cuponInicial = cuponInicialInput.value || 0;
        var cuponFinal = cuponFinalInput.value || 0;
        var totalCupones = cuponFinal - cuponInicial;
        totalCuponesInput.innerText = totalCupones + 1;
    }
</script>
@endsection