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
                        <input class="form-check-input" type="hidden" name="libros_seleccionados[]" value="{{ $item->id_libro}}">
                        <td><input type="number" name="stock[]" value="{{$item->stock}}"></td>
                        <td class="precio">$<input type="number" name="precio[]" value="{{$item->precio}}"></td>
                        <td><input type="number" name="descuento[]" min="0" value="{{$item->descuento}}"></td>
                        <td><input type="number" name="ofrecimiento_a[]" min="0" value="{{$item->reintegro}}"></td>
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener el elemento de fecha y hora
        var fechaInput = document.getElementById('fecha');
        var horaInput = document.getElementById('hora');

        // Obtener la fecha y hora actual
        var now = new Date();

        // Formatear la fecha como "YYYY-MM-DD"
        var fechaFormatted = now.toISOString().split('T')[0];

        // Formatear la hora como "HH:mm"
        var horaFormatted = now.toTimeString().split(' ')[0];

        // Establecer los valores predeterminados en los campos de entrada
        fechaInput.value = fechaFormatted;
        horaInput.value = horaFormatted;
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var precios = document.querySelectorAll('td.precio input');
        var totalPrecio = Array.from(precios).reduce(function(sum, precio) {
            return sum + parseFloat(precio.value);
        }, 0);
        document.getElementById('totalPrecio').textContent = totalPrecio.toFixed(2);
        precios.forEach(function(precio) {
            precio.addEventListener('input', function() {
                totalPrecio = Array.from(precios).reduce(function(sum, precio) {
                    return sum + parseFloat(precio.value);
                }, 0);
                document.getElementById('totalPrecio').textContent = totalPrecio.toFixed(2);
            });
        });
    });
</script>
@endsection