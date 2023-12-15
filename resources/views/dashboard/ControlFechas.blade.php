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
                                    <th>numero</th>
                                    <th>Codigo</th>
                                    <th>Instituci&oacute;n</th>
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
                                <tr>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('script')