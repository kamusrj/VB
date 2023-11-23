@extends('layouts.master')

@section('title', 'Facturas')

@section('content')
<br><br>

<div class="container">
    <div class="row">
        <div class="col">
            @include('errorMj')
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#seleccionLibrosModal">
                Nueva Factura
            </button>
















            
            <!-- Modal Creacion de Factura  -->
            <div class="modal" id="seleccionLibrosModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Factura</h5>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ url('factura/guardarfactura') }}">
                                @csrf

                                @foreach($facturas as $factura)
                                <div class="col-auto mb-3">
                                    <label for="correlativo" class="form-label">N° Correlativo</label>
                                    <input type="number" min="{{ $factura->factura_i }}" max="{{ $factura->factura_f }}" class="form-control" id="correlativo" name="correlativo">
                                </div>
                                @endforeach
                                <div class="col-auto mb-3">
                                    <label for="padre" class="form-label">Padre de familia</label>
                                    <input type="text" class="form-control" id="padre" name="padre">
                                </div>


                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Seleccionar</th>
                                                <th>Nombre del Libro</th>
                                                <th>Precio</th>
                                                <th>cantidad</th>
                                                <th>existencias</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablaInventario">
                                            @foreach($inventario as $item)
                                            <tr id="fila_{{ $item->id_libro }}">
                                                <input type="text" value="{{$item->id_venta}}" name="id_venta" hidden>

                                                <td>
                                                    <input class="form-check-input" type="checkbox" name="libros_seleccionados[]" value="{{ $item->id_libro }}" onchange="calcularTotal()">
                                                </td>
                                                <td>{{ $item->nombre_libro }}</td>
                                                <td>${{ $item->precio }}</td>
                                                <td>
                                                    <input type="number" min="0" max="{{ $item->stock_venta }}" name="cantidad[]" style="width: 60%;" value="0" onchange="calcularTotal()">
                                                </td>
                                                <td>{{ $item->stock_venta }}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td id="total" colspan="4">Total: $0.00</td>
                                            </tr>

                                        </tbody>

                                    </table>
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    function calcularTotal() {
        var filas = document.getElementById('tablaInventario').getElementsByTagName('tr');
        var total = 0;
        for (var i = 0; i < filas.length - 1; i++) {
            var checkbox = filas[i].getElementsByTagName('input')[0];
            var cantidadInput = filas[i].getElementsByTagName('input')[1];
            var precio = parseFloat(filas[i].getElementsByTagName('td')[2].innerText.slice(1));

            if (checkbox.checked) {
                var cantidad = parseFloat(cantidadInput.value);
                total += cantidad * precio;
            }
        }

        document.getElementById('total').innerText = 'Total: $' + total.toFixed(2);
    }
    window.onload = function() {
        calcularTotal();
    };
</script>


@endsection