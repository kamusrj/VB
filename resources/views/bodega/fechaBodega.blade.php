@extends('layouts.master')
@section('title', 'Control de Fechas')
@section('content')
<div class="container">
    <div class="row">

        <div class="col mb-3">
            <h2><span style="display: block; text-align: center; margin: auto;"><i class="fa-solid fa-school"> Invetario por fecha </i></span></h2>
        </div>

    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <h3>Listado de ventas </h3>
                    <div class="table table-striped">
                        <table class="table table-bordered table-striped" id="venta">
                            <thead>
                                <tr>
                                    <th>Fecha </th>
                                    <th>Encargado</th>
                                    <th>Recibida</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            @foreach($dato as $item)
                            <tbody>
                                <tr>
                                    <td>{{$item->fecha_programada}}</td>
                                    <td>{{$item->nombre_encargado}} {{$item->apellido_encargado}}</td>
                                    <td>
                                        @if ($item->recibida === 'on')
                                        <i class="fa-solid fa-toggle-on fa-2xl" style="color: #029d96;"></i>
                                        @endif
                                        @if ($item->recibida === 'off')
                                        <i class="fa-solid fa-toggle-off fa-2xl" style="color: #eb0d68;"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Ver venta" data-venta="{{ $item->id }}" data-fecha="{{ $item->fecha_programada }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>

                                    </td>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalVenta" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalVentaTitle">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <table class="table table-bordered  table-sm  table-striped">
                        <thead>
                            <tr>
                                <th>Libro</th>
                                <th>Inventario Inicial</th>
                                <th>vendido</th>
                                <th>Retorno</th>
                            </tr>
                        </thead>

                        <tbody id="modalTableBody">
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('script')


    <script>
        const modal_venta = new bootstrap.Modal("#modalVenta");
        const modal_venta_title = document.getElementById('modalVentaTitle');
        const tableBody = document.querySelector('#modalTableBody');
        const buttons_venta = document.querySelectorAll("[data-venta]");

        [].slice.call(buttons_venta).forEach(async function(button) {
            button.addEventListener('click', async () => {

                const response = await fetch("{{ url('venta/bodegaBuscar') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        "id": button.getAttribute("data-venta"),
                        "fecha": button.getAttribute("data-fecha")
                    }),
                });
                if (!response.ok) {
                    throw new Error('Error al obtener datos del servidor');
                }

                const data = await response.json();

                console.log(data);

                tableBody.innerHTML = '';
                modal_venta_title.innerText = "Venta Directa "
                data.forEach(item => {
                    const row = tableBody.insertRow();
                    row.innerHTML = `<td>${item.nombre_libro}</td><td>${item.stock}</td> <td>${item.stock - item.stock_venta}</td><td  style="font-weight: bold;">${item.stock_venta}</td>`;
                });
                modal_venta.show();
            });
        });
    </script>
    @endsection