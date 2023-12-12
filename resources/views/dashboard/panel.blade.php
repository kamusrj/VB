@extends('layouts.master')

@section('title', 'panel')


@section('content')
<div class="container">

    <div class="row">
        <div class="col my-3">
            <a href="{{ url('/') }}" class="btn btn-dark"> <i class="fas fa-arrow-left"></i></a>

        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <h3>Listado de ventas </h3>
            <div class="table table-striped">
                <table class="table table-bordered table-striped" id="venta">
                    <thead>
                        <tr>
                            <th>numero</th>
                            <th>institucion</th>
                            <th>director</th>
                            <th>encargado</th>
                            <th>telefono</th>
                            <th>vendedor</th>
                            <th>zona</th>
                            <th>direccion</th>
                            <th>Ver / Estado</th>

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
                            <td>{{ $item->director }}</td>
                            <td>{{ $item->nombre_encargado }} {{ $item->apellido_encargado }}</td>
                            <td>{{ $item->telefono }}</td>
                            <td>{{ $item->nombre_vendedor }} {{ $item->apellido_vendedor }}</td>
                            <td>{{ $item->zona}}</td>
                            <td>{{ $item->direccion}}</td>

                            <td>
                                <a href="{{ url('panel/perfilVenta/' . $item->id) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Ver venta">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                @if ($item->estado === 'on')
                                <i class="fa-solid fa-toggle-on fa-2xl" style="color: #029d96;"></i>
                                @endif
                                @if ($item->estado === 'off')
                                <i class="fa-solid fa-toggle-off fa-2xl" style="color: #eb0d68;"></i>
                                @endif
                                <a href="{{ url('panel/finalizarVenta/' . $item->id) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Finalizar Venta" onclick="return confirm('¿Estás seguro de que quieres finalizar la venta?');">
                                    <i class="fa-solid fa-hourglass-end"></i>
                                </a>
                            </td>

                        </tr>
                        @php
                        $numero++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')