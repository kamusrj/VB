@extends('layouts.master')
@section('title', 'Programación')
@section('content')




    <div class="container">
        <div class="row">
            <div class="col">
                <h2><i class="fa fa-calendar-days"></i> Programa de ventas</h2>
            </div>
        </div>
        <div class="row">
            <div class="col my-3">
                <a class="btn btn-info" href="{{ url('venta/facturar/' . $id) }}"><i class="fa-regular fa-calendar-plus"></i>
                    Agregar</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        @include('errorMj')
                        <div class="table table-striped">
                            <table class="table table-bordered table-striped" id="venta">
                                <thead>
                                    <tr>
                                        <th>Fecha </th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                @foreach ($dato as $item)
                                    <tbody>
                                        <tr>
                                            <td>{{ $item->fecha }}</td>
                                            <td>{{ $item->estado }}</td>
                                            <td>
                                                <a href="{{ url('panel/perfilVenta/' . $item->venta . '/' . $item->fecha) }}"
                                                    class="btn btn-warning" data-toggle="tooltip" data-placement="top"
                                                    title="Ver Datos de la venta">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a href="{{ url("panel/programacion/estado/$item->venta") }}"
                                                    class="btn btn-{{$item->estado == 'Activo' ? 'success' : 'secondary'}}" data-toggle="tooltip" data-placement="top"
                                                    title="Cambiar estado de la venta">
                                                    @if ($item->estado == 'Activo')
                                                        <i class="fa-solid fa-toggle-on"></i>
                                                    @else
                                                        <i class="fa-solid fa-toggle-off"></i>
                                                    @endif
                                                </a>
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
