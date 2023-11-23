@extends('layouts.master')

@section('title', 'Facturas')

@section('content')
<br><br>

<div class="container">
    <div class="row">
        <div class="col">

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#seleccionLibrosModal">
                Nueva Factura
            </button>


            <div class="modal" id="seleccionLibrosModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Factura </h5>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                @csrf
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Seleccionar</th>
                                            <th>Nombre del Libro</th>
                                            <th>Precio</th>
                                            <th>Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($inventario as $item)
                                        <tr>
                                            <td>
                                                <input class="form-check-input" type="checkbox" name="libros_seleccionados[]" value="{{ $item->id_libro }}">
                                            </td>
                                            <td>{{ $item->nombre_libro }}</td>
                                            <td>${{ $item->precio }}</td>
                                            <td>{{ $item->stock_venta }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <button type="submit" class="btn btn-primary">Enviar</button>
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