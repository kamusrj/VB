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
        <label for="fecha">Fecha de inicio de la venta:</label>
        <input type="date" name="fecha" require>
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
                        <input class="form-check-input" type="text" name="libros_seleccionados[]" value="{{ $item->id_libro}}" require>
                        <td><input type="number" name="stock[]" require></td>
                        <td class="precio">$<input type="number" name="precio[]" step="any" require></td>
                        <td><input type="number" name="descuento[]" min="0"></td>
                        <td><input type="number" name="ofrecimiento_a[]" min="0" step="any" value="0" require></td>
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