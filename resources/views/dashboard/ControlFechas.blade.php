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
                                    <th>estado</th>
                                    <th>Encargado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            @foreach($dato as $item)
                            <tbody>
                                <tr>

                                    <td>{{$item->fecha_programada}}</td>
                                    <td>{{$item->estado}}</td>
                                    <td>{{$item->nombre_encargado}} {{$item->apellido_encargado}}</td>
                                    <td>
                                        <a href="{{ url('panel/perfilVenta/' . $item->id_venta . '/' . $item->fecha_programada) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Ver Datos de la venta">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

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