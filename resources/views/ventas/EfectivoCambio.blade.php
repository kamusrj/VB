@extends('layouts.master')

@section('title', 'Efectivo para cambio')


@section('content')

<div class="container">

    <div class="row">
        <div class="col">
            <a href="{{ url('/') }}" class="btn btn-dark"> <i class="fas fa-arrow-left"></i></a>
            <a href="{{ url('/salir') }}" class="btn btn-danger"> <i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h2>Efectivo para Cambio de la instituci&oacute; {{ $tituloVenta->institucion }}</h2>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <form method="post" action="{{ url('factura/crearEfectivo') }}">
                @include('errorMj')
                @csrf
                <input type="number" name="id_venta" hidden value="{{ $tituloVenta->id }}">

                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-bordered caption-top">
                            <caption>
                                <h5>Denominacion</h5>
                            </caption>
                            <tbody>
                                <tr>
                                    <th scope="row" class="col-4">$0.01</th>
                                    <td class="col-8">
                                        <input type="number" value="0" data-denominacion="0.01" step="1" oninput="calcularTotal()" name="centavo_uno" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-4">$0.05</th>
                                    <td class="col-8">
                                        <input type="number" value="0" data-denominacion="0.05" step="1" oninput="calcularTotal()" name="centavo_cinco" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-4">$0.10</th>
                                    <td class="col-8">
                                        <input type="number" value="0" data-denominacion="0.1" step="1" oninput="calcularTotal()" name="centavo_diez" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-4">$0.25</th>
                                    <td class="col-8">
                                        <input type="number" value="0" data-denominacion="0.25" step="1" oninput="calcularTotal()" name="centavo_veinticinco" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-4">$1.00</th>
                                    <td class="col-8">
                                        <input type="number" value="0" data-denominacion="1.0" step="1" oninput="calcularTotal()" name="dolar_uno" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-4">$5.00</th>
                                    <td class="col-8">
                                        <input type="number" value="0" data-denominacion="5.0" step="1" oninput="calcularTotal()" name="dolar_cinco" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-4">$10.00</th>
                                    <td class="col-8">
                                        <input type="number" value="0" data-denominacion="10.0" step="1" oninput="calcularTotal()" name="dolar_diez" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-4">$20.00</th>
                                    <td class="col-8">
                                        <input type="number" value="0" data-denominacion="20.0" step="1" oninput="calcularTotal()" name="dolar_veinte" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-4">Total</th>
                                    <td class="col-8">
                                        $<span id="total">0.0</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
    const total = document.getElementById('total');
    const campos = document.querySelectorAll("[data-denominacion]");

    function calcularTotal() {
        let total_actual = 0;
        [].slice.call(campos).forEach(function(campo) {
            let denominacion = campo.getAttribute("data-denominacion");
            total_actual += campo.value * denominacion;
        });
        total.innerText = parseFloat(total_actual).toFixed(2);
    }
</script>
@endsection