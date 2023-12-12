@extends('layouts.master')

@section('title', 'Cierre de venta')


<style>
    td {
        white-space: nowrap;
    }
</style>



@section('content')

<div class="containe">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="row">
                <div class="col my-3">
                    <a href="{{ url('panel/perfilVenta/ '.$id) }}" class="btn btn-dark"> <i class="fas fa-arrow-left"></i>
                    </a>

                </div>
                <h2><span style="display: block; text-align: center; margin: auto;"><i class="fa-solid fa-shop-lock"> Cierre de venta</i> </span></h2>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Venta</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Documentos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Cambio</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#return-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Devolución</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0"><br>
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ url('factura/crearEfectivo') }}">
                                @include('errorMj')
                                @csrf
                                <input name="id_venta" hidden value="   {{ $id }}">
                                <input name="tipo" hidden value="v">
                                <div class="row justify-content-center">
                                    <div class="col-md-5">
                                        <table class="table table-bordered caption-top">
                                            <caption>
                                                <h5>Reporte de venta</h5>
                                            </caption>
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="col-4">Denominación</th>
                                                    <th scope="col" class="col-8">Cantidad</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row" class="col-4">$0.01</th>
                                                    <td class="col-8">
                                                        <input type="number" min="0" value="{{ $dato && $dato->centavo_uno !== null ? $dato->centavo_uno : '0' }}" data-denominacion="0.01" step="1" oninput="calcularTotal(this)" name="centavo_uno" class="form-control">
                                                    </td>
                                                    <td id="total_input_centavo_uno">$ 0.00</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$0.05</th>
                                                    <td class="col-8">
                                                        <input type="number" min="0" value="{{ $dato && $dato->centavo_cinco !== null ? $dato->centavo_cinco : '0' }}" data-denominacion="0.05" step="1" oninput="calcularTotal(this)" name="centavo_cinco" class="form-control">
                                                    </td>
                                                    <td id="total_input_centavo_cinco">$ 0.00</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$0.10</th>
                                                    <td class="col-8">
                                                        <input type="number" min="0" value="{{ $dato && $dato->centavo_diez !== null ? $dato->centavo_diez : '0' }}" data-denominacion="0.1" step="1" oninput="calcularTotal(this)" name="centavo_diez" class="form-control">
                                                    </td>
                                                    <td id="total_input_centavo_diez">$ 0.00</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$0.25</th>
                                                    <td class="col-8">
                                                        <input type="number" min="0" value="{{ $dato && $dato->centavo_veinticinco !== null ? $dato->centavo_veinticinco : '0' }}" data-denominacion="0.25" step="1" oninput="calcularTotal(this)" name="centavo_veinticinco" class="form-control">
                                                    </td>
                                                    <td id="total_input_centavo_veinticinco">$ 0.00</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$1.00</th>
                                                    <td class="col-8">
                                                        <input type="number" min="0" value="{{ $dato && $dato->dolar_uno !== null ? $dato->dolar_uno : '0' }}" data-denominacion="1.0" step="1" oninput="calcularTotal(this)" name="dolar_uno" class="form-control">
                                                    </td>
                                                    <td id="total_input_dolar_uno">$ 0.00</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$5.00</th>
                                                    <td class="col-8">
                                                        <input type="number" min="0" value="{{ $dato && $dato->dolar_cinco !== null ? $dato->dolar_cinco : '0' }}" data-denominacion="5.0" step="1" oninput="calcularTotal(this)" name="dolar_cinco" class="form-control">
                                                    </td>
                                                    <td id="total_input_dolar_cinco">$ 0.00</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$10.00</th>
                                                    <td class="col-8">
                                                        <input type="number" min="0" value="{{ $dato && $dato->dolar_diez !== null ? $dato->dolar_diez : '0' }}" data-denominacion="10.0" step="1" oninput="calcularTotal(this)" name="dolar_diez" class="form-control">
                                                    </td>
                                                    <td id="total_input_dolar_diez">$ 0.00</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$20.00</th>
                                                    <td class="col-8">
                                                        <input type="number" min="0" value="{{ $dato && $dato->dolar_veinte !== null ? $dato->dolar_veinte : '0' }}" data-denominacion="20.0" step="1" oninput="calcularTotal(this)" name="dolar_veinte" class="form-control">
                                                    </td>
                                                    <td id="total_input_dolar_veinte">$ 0.00</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$50.00</th>
                                                    <td class="col-8">
                                                        <input type="number" min="0" value="{{ $dato && $dato->dolar_cincuenta !== null ? $dato->dolar_cincuenta : '0' }}" data-denominacion="50.0" step="1" oninput="calcularTotal(this)" name="dolar_cincuenta" class="form-control">
                                                    </td>
                                                    <td id="total_input_dolar_cincuenta">$ 0.00</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$100.00</th>
                                                    <td class="col-8">
                                                        <input type="number" min="0" value="{{ $dato && $dato->dolar_cien !== null ? $dato->dolar_cien : '0' }}" data-denominacion="100.0" step="1" oninput="calcularTotal(this)" name="dolar_cien" class="form-control">
                                                    </td>
                                                    <td id="total_input_dolar_cien">$ 0.00</td>
                                                <tr>
                                                    <th scope="row" class="col-4">Total</th>
                                                    <td>
                                                        @if(!$dato)
                                                        <h3> $<span id="total">0.0</span></h3>
                                                        <input id="totalInput" name="totalFactura" value="0" hidden>
                                                        @else
                                                        <h3><span>${{$dato->total}}</span></h3>
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3">
                                                        @if(!$dato)
                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                        @else
                                                        <span>Venta entregada <h3> {{$dato->fecha}}</h3> </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    @include('dashboard.componentesDetalleVenta.Documentacion')
                </div>
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                    @include('dashboard.componentesDetalleVenta.cambio')
                </div>
                <div class="tab-pane fade" id="return-tab-pane" role="tabpanel" aria-labelledby="return-tab" tabindex="0">
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
@endsection
@section('script')
<script>
    function calcularTotal(input) {
        var denominacion = parseFloat(input.getAttribute("data-denominacion"));
        var inputValue = parseFloat(input.value);
        var total = denominacion * inputValue;
        var totalCellId = "total_input_" + input.name;
        document.getElementById(totalCellId).textContent = "$ " + total.toFixed(2);
        var filasCentavo = document.querySelectorAll('[name^="centavo_"]');
        var filasDolar = document.querySelectorAll('[name^="dolar_"]');
        var filas = Array.from(filasCentavo).concat(Array.from(filasDolar));
        var totalGeneral = 0;
        filas.forEach(function(fila) {
            var filaDenominacion = parseFloat(fila.getAttribute("data-denominacion"));
            var filaValue = parseFloat(fila.value);
            var filaTotal = filaDenominacion * filaValue;
            var filaTotalCellId = "total_input_" + fila.name;
            document.getElementById(filaTotalCellId).textContent = "$ " + filaTotal.toFixed(2);
            totalGeneral += filaTotal;
        });
        document.getElementById("total").textContent = totalGeneral.toFixed(2);
        document.getElementById('totalInput').value = totalGeneral.toFixed(2);
    }



    document.addEventListener("DOMContentLoaded", function() {
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


        calcularTotal();
    });
</script>
@endsection