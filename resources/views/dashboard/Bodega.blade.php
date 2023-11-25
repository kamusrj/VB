@extends('layouts.master')
@section('title', 'Inventario Bodega')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <a href="{{ url('/salir') }}" class="btn btn-danger">Salir <i class="fas fa-sign-out-alt"> </i></a>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col mb-3">
            <h2>Ventar </h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table  table-sm  table-bordered table-striped" id="venta">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Institucion</th>
                        <th>Encargado</th>
                        <th>Vendedor</th>
                        <th>Ver venta</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $numero = 1;
                    @endphp
                    @foreach ($ventas as $item)
                    <tr>
                        <td>{{ $numero }}</td>
                        <td>{{ $item->institucion_n}}</td>
                        <td>{{ $item->nombre_encargado }} {{ $item->apellido_encargado }}</td>
                        <td>{{ $item->nombre_vendedor }} {{ $item->apellido_vendedor }}</td>
                        <td>
                            <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Ver venta" data-value-venta="{{ $item->id }}" data-institucion-n="{{ $item->institucion_n }}">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    @php
                    $numero++;
                    @endphp
                    @endforeach
                </tbody>
            </table>

            <!--                    Modal                           -->

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
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    const modal_venta = new bootstrap.Modal("#modalVenta");
    const modal_venta_title = document.getElementById('modalVentaTitle');
    const tableBody = document.querySelector('#modalTableBody');
    const buttons_venta = document.querySelectorAll("[data-value-venta]");

    [].slice.call(buttons_venta).forEach(async function(button) {
        button.addEventListener('click', async () => {
            const institucionNombre = button.getAttribute("data-institucion-n");
            const response = await fetch("{{ url('venta/bodegaBuscar') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    "id": button.getAttribute("data-value-venta")
                }),
            });
            if (!response.ok) {
                throw new Error('Error al obtener datos del servidor');
            }
            const data = await response.json();
            tableBody.innerHTML = '';
            modal_venta_title.innerText = "Venta " + institucionNombre;
            data.forEach(item => {
                const row = tableBody.insertRow();
                row.innerHTML = `<td>${item.nombre_libro}</td><td>${item.stock}</td> <td>${item.stock - item.stock_venta}</td><td  style="font-weight: bold;">${item.stock_venta}</td>`;
            });
            modal_venta.show();
        });
    });
</script>
@endsection