@extends('layouts.master')

@section('title', 'inventario')
@section('style')
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: px solid #ddd;
        padding: 5px;
        /* Ajusta el padding según sea necesario */
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    td.editing {
        background-color: #ffffcc;
    }

    .table-responsive {
        overflow-x: auto;
    }

    table td input[type="number"] {
        max-width: 80px;
    }
</style>
@endsection
@section('content')
<div class="container">
    <form action="{{ url('venta/inventarioVenta') }}" method="post"><br><br><br><br>
        @csrf

        <input name="fecha" value="{{$fecha}}" hidden id="fecha">
        <div class="table-responsive">

            <table class="table table-striped">
                <caption class="">Resumen de tablas</caption>
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Libro</th>
                        <th scope="col">cantidad</th>
                        <th scope="col">precio</th>
                        <th scope="col">Descuento %</th>
                        <th scope="col">Ofrecimientos <BR> adicionales</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventario as $item)
                    <tr>
                        <th scope="row">{{$item->nombre_libro}}</th>
                        <input class="form-check-input" type="hidden" name="id" value="{{ $item->id_venta}}" required>
                        <input class="form-check-input" type="hidden" name="libros_seleccionados[]" value="{{ $item->id_libro}}" required>
                        <td><input type="number" name="stock[]" min="0" value="" required></td>
                        <td class="precio">$<input type="number" min="0" value="" name="precio[]" step="any" required></td>
                        <td><input type="number" name="descuento[]" min="0" value="0"></td>
                        <td><input type="number" name="ofrecimiento_a[]" min="0" step="any" value="0" required></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div><br>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
@section('script')