@extends('layouts.master')

@section('title', 'Facturas')

@section('content')

<br><br>

<div class="container">

    <div class="row">
        <div class="col my-3">
            <a href="{{ url('panel/perfilVenta/' . $id . '/' . $fecha) }}" class="btn btn-dark"> <i class="fas fa-arrow-left"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="col">

            <h2><i class="fa-solid fa-file-invoice-dollar"> </i> Facturaci&oacute;n</h2><br>


            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#seleccionLibrosModal">
                Nueva Factura
            </button>
            <br><br>
            <!--  tabla  -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>

                            <th>Correlativo</th>
                            <th>Detalle</th>
                            <th>Fecha / Hora</th>
                            <th>Ver Factura</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($detalle as $item)
                        <tr>

                            <td>{{$item->correlativo}}</td>

                            @if($item->anulada=='no')
                            <td>Padre: <h6>{{$item->padre }}</h6>
                            </td>
                            @else
                            <td>Motivo de anulacion: <h6>{{$item->motivo }}</h6>
                            </td>
                            @endif
                            <td>{{ $item->fecha }} / {{$item->hora}}</td>
                            <td>

                                @if($item->anulada=='no')
                                <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Ver venta" data-value-factura="{{ $item->correlativo }}">
                                    <i class=" fa-solid fa-eye"></i>
                                </button>
                                @else
                                <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Factura Anulada">
                                    <i class=" fa-solid fa-ban"></i>
                                </button>
                                @endif
                            </td>
                        </tr>


                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Creacion de Factura  -->
            <div class="modal" id="seleccionLibrosModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Factura</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ url('factura/guardarfactura') }}">

                                <input value="{{$id}}" name="id_venta" hidden>
                                <input value="{{$fecha}}" name="fecha" hidden>
                                @csrf
                                @foreach($facturas as $factura)
                                <div class="col-auto mb-3">
                                    <label for="correlativo" class="form-label">N° Correlativo</label>
                                    <input type="number" min="{{ $factura->factura_i }}" max="{{ $factura->factura_f }}" class="form-control" name="correlativo" placeholder="00000">
                                </div>
                                @endforeach

                                <div class="col-auto mb-3">
                                    <label for="padre" class="form-label">Padre de familia</label>
                                    <input type="text" class="form-control" id="padre" name="padre" require>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Seleccionar</th>
                                                <th>Libro</th>
                                                <th>Precio</th>
                                                <th>cantidad</th>
                                                <th>Inventario</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablaInventario">
                                            @foreach($inventario as $item)
                                            <tr id="fila_{{ $item->id_libro }}">

                                                <td>
                                                    <input class="form-check-input" type="checkbox" name="libros_seleccionados[]" value="{{ $item->id_libro }}" onchange="calcularTotal()">
                                                </td>
                                                <td>{{$item->nombre_libro}}</td>
                                                <td>${{$item->precio}}</td>
                                                <td>
                                                    <input type="number" min="0" max="{{ $item->stock_venta }}" name="cantidad[{{ $item->id_libro }}]" style="width: 60%;" value="1" onchange="calcularTotal()">
                                                </td>
                                                <td>{{$item->stock_venta}}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td id="total" name="totalFactura" colspan=5">Total: $0.00</td>
                                            </tr>
                                            <input id="totalInput" name="totalFactura" value="" hidden>
                                        </tbody>
                                    </table>
                                    <div class="col-auto mb-3">
                                        <label for="padre" class="form-label">Factura anulada</label>
                                        <input name="anulada" id="anulada" type="checkbox" aria-label="Checkbox for following text input">
                                    </div>

                                    <div class="col-auto mb-3">
                                        <label for="padre" class="form-label">Motivo de anulación</label>
                                        <textarea name="motivo" class="form-control" id="exampleTextarea" rows="4"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--       datos de factura modal          -->
            <div class="modal fade" id="modalFactura" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalFacturaTitle">Detalles de la factura</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <table class="table table-bordered  table-sm  table-striped">
                                <thead>
                                    <tr>

                                        <th>Libro</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Total Libro</th>

                                    </tr>
                                </thead>
                                <tbody id="modalTableBody">
                                </tbody>
                            </table>
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
        document.getElementById('totalInput').value = total.toFixed(2);
    }
    window.onload = function() {
        calcularTotal();

    };

    //Modal Detalle de factura 
    const modal_factura = new bootstrap.Modal("#modalFactura");
    const modal_factura_title = document.getElementById('modalFacturaTitle');
    const tableBody = document.querySelector('#modalTableBody');
    const buttons_factura = document.querySelectorAll("[data-value-factura]");

    [].slice.call(buttons_factura).forEach(async function(button) {
        button.addEventListener('click', async () => {
            const response = await fetch("{{ url('factura/facturaBuscar/'.$id. '/' . $fecha) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    "correlativo": button.getAttribute("data-value-factura")
                }),
            });

            if (!response.ok) {
                throw new Error('Error al obtener datos del servidor');
            }

            const data = await response.json();
            tableBody.innerHTML = '';
            let totalPrecio = 0;

            data.forEach(item => {
                const row = tableBody.insertRow();
                const total = parseFloat(item.precio_libro) * parseInt(item.cantidad);
                row.innerHTML = `
        
        <td>${item.nombre_libro}</td>                 
        <td>$${item.precio_libro}</td> 
        <td>${item.cantidad}</td> 
        <td>$${total.toFixed(2)}</td>`;
                if (!isNaN(item.precio_libro)) {
                    totalPrecio += total;
                }
                modal_factura_title.textContent = `Factura ${item.correlativo}`;

            });
            const totalRow = tableBody.insertRow();
            totalRow.innerHTML = `<td colspan="5">Total: $${totalPrecio.toFixed(2)}</td>`;

            modal_factura.show();
        });
    });

    //Padre requerido si factura no es anulada

    function toggleRequired() {
        var padreInput = document.getElementById('padre');
        var anuladaCheckbox = document.getElementsByName('anulada')[0];
        padreInput.required = !anuladaCheckbox.checked;
    }
</script>
@endsection