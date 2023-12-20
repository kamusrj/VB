@extends('layouts.master')

@section('title', 'Fondos para Cambio')

@section('content')
<div class="container">
    <div class="row">
        <div class="row">
            <div class="col my-3">
                <a href="{{ url('panel/perfilVenta/' . $id . '/' . $fecha) }}" class="btn btn-dark"> <i class="fas fa-arrow-left"></i></a>
            </div>


            <h2><span style="display: block; text-align: center; margin: auto;"> <i class="fa-solid fa-coins"> Efectivo para Operaciones </i> </span></h2><br><br>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <br>
            <table class="table table-bordered caption-top ">
                <h3>Cambio recibido</h3>
                <caption>
                    <h5>Denominaci&oacute;n</h5>
                </caption>
                <tbody>
                    <tr>
                        <th scope="row" class="col-4">$0.01</th>
                        <td class="col-8">
                            <span>{{$cambio->centavo_uno}} </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$0.05</th>
                        <td class="col-8">
                            <span>{{$cambio->centavo_cinco}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$0.10</th>
                        <td class="col-8">
                            <span> {{$cambio->centavo_diez}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$0.25</th>
                        <td class="col-8">
                            <span> {{$cambio->centavo_veinticinco}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$1.00</th>
                        <td class="col-8">
                            <span>{{$cambio->dolar_uno}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$5.00</th>
                        <td class="col-8">
                            <span>{{$cambio->dolar_cinco}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$10.00</th>
                        <td class="col-8">
                            <span>{{$cambio->dolar_diez}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$20.00</th>
                        <td class="col-2">
                            <span>{{$cambio->dolar_veinte}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">Total</th>
                        <td class="col-2">
                            $<span>{{$cambio->total}}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4">
            <br>
            <form id="form2" action="{{ url('factura/crearEfectivo') }}" method="post">
                @csrf
                <input name="id_venta" hidden value="{{ $id }}">
                <input name="fecha" hidden value="{{ $fecha }}">
                <input name="tipo" hidden value="r">

                <table class="table table-bordered caption-top ">
                    <h3>Cambio Entregado</h3>
                    <caption>
                        <h5>Denominaci&oacute;n</h5>
                    </caption>
                    <tbody>
                        <tr>
                            <th scope="row" class="col-4">$0.01</th>
                            <td class="col-8">
                                <input type="number" min="0" value="{{ $retorno && $retorno->centavo_uno !== null ? $retorno->centavo_uno : '0' }}" data-denominacion="0.01" step="1" oninput="calcularTotal()" name="centavo_uno" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-4">$0.05</th>
                            <td class="col-8">
                                <input type="number" min="0" value="{{ $retorno && $retorno->centavo_uno !== null ? $retorno->centavo_uno : '0' }}" data-denominacion="0.05" step="1" oninput="calcularTotal()" name="centavo_cinco" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-4">$0.10</th>
                            <td class="col-8">
                                <input type="number" min="0" value="{{ $retorno && $retorno->centavo_uno !== null ? $retorno->centavo_uno : '0' }}" data-denominacion="0.1" step="1" oninput="calcularTotal()" name="centavo_diez" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-4">$0.25</th>
                            <td class="col-8">
                                <input type="number" min="0" value="{{ $retorno && $retorno->centavo_uno !== null ? $retorno->centavo_uno : '0' }}" data-denominacion="0.25" step="1" oninput="calcularTotal()" name="centavo_veinticinco" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-4">$1.00</th>
                            <td class="col-8">
                                <input type="number" min="0" value="{{ $retorno && $retorno->centavo_uno !== null ? $retorno->centavo_uno : '0' }}" data-denominacion="1.0" step="1" oninput="calcularTotal()" name="dolar_uno" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-4">$5.00</th>
                            <td class="col-8">
                                <input type="number" vmin="0" value="{{ $retorno && $retorno->centavo_uno !== null ? $retorno->centavo_uno : '0' }}" data-denominacion="5.0" step="1" oninput="calcularTotal()" name="dolar_cinco" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-4">$10.00</th>
                            <td class="col-8">
                                <input type="number" min="0" value="{{ $retorno && $retorno->centavo_uno !== null ? $retorno->centavo_uno : '0' }}" data-denominacion="10.0" step="1" oninput="calcularTotal()" name="dolar_diez" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-4">$20.00</th>
                            <td class="col-8">
                                <input type="number" min="0" value="{{ $retorno && $retorno->dolar_veinte !== null ? $retorno->dolar_veinte : '0' }}" data-denominacion="20.0" step="1" oninput="calcularTotal()" name="dolar_veinte" class="form-control">
                            </td>
                        </tr>
                        <tr>

                            <th scope="row" class="col-4">Total</th>
                            <td class="col-8">
                                @if(!$retorno)
                                $<span id="total">0.0</span>
                                <input id="totalInput" name="totalFactura" value="0" hidden>
                                @else
                                <h3><span>${{$retorno->total}}</span></h3>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                @if(!$retorno)
                                <button type="submit" class="btn btn-primary">Enviar</button>
                                @else
                                <span>Venta Finalizada <h3> {{$retorno->fecha}}</h3> </span>
                                @endif
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
</div>

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
        document.getElementById('totalInput').value = parseFloat(total_actual).toFixed(2);
    }
</script>
@endsection












</div>
</div>

@endsection