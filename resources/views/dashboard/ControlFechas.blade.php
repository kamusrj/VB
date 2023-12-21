@extends('layouts.master')
@section('title', 'Control de Fechas')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h2><i class="fa fa-calendar-days"></i> Control de Fechas</h2>
        </div>
    </div>
    <div class="row">
        <div class="col my-3">
            <a class="btn btn-info" href="{{ url('venta/facturar/' . $id) }}"><i class="fa-regular fa-calendar-plus"></i> Nueva Fecha</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @include('errorMj')
                    <h3>Listado de ventas </h3>
                    <div class="table table-striped">
                        <table class="table table-bordered table-striped" id="venta">
                            <thead>
                                <tr>
                                    <th>Fecha </th>
                                    <th>Encargado</th>
                                    <th>estado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            @foreach($dato as $item)
                            <tbody>
                                <tr>
                                    <td>{{$item->fecha_programada}}</td>
                                    <td>{{$item->nombre_encargado}} {{$item->apellido_encargado}}</td>
                                    <td>
                                        @if ($item->estado === 'on')
                                        <i class="fa-solid fa-toggle-on fa-2xl" style="color: #029d96;"></i>
                                        @endif
                                        @if ($item->estado === 'off')
                                        <i class="fa-solid fa-toggle-off fa-2xl" style="color: #eb0d68;"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('panel/perfilVenta/' . $item->id_venta . '/' . $item->fecha_programada) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Ver Datos de la venta">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        @if ($item->estado === 'on')
                                        <a href="{{ url('panel/finalizarVenta/'. $item->id_venta . '/' . $item->fecha_programada) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Finalizar Venta"  onclick="return confirm('¿Estás seguro de que quieres finalizar la venta?');">
                                            <i class="fa-solid fa-hourglass-end"></i>
                                        </a>
                                        @endif
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
    @endsection
    @section('script')
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    @endsection