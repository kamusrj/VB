@extends('layouts.master')
@section('title', 'panel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h2><i class="fa fa-shop"></i> Ventas Directas</h2>
        </div>
    </div>
    <div class="row">
        <div class="col my-3">
            <a class="btn btn-success" href="{{url('venta/nueva')}}">Nueva Venta</a>
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
                                    <th>telefono</th>
                                    <th>vendedor</th>
                                    <th>zona</th>
                                    <th>direccion</th>

                                    <th>Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $numero = 1;
                                @endphp
                                @foreach ($ventas as $item)
                                <tr>
                                    <td>{{ $numero }}</td>
                                    <td>{{ $item->institucion }}</td>
                                    <td>{{ $item->institucion_n }}</td>
                                    <td>{{ $item->director }}</td>

                                    <td>{{ $item->telefono }}</td>
                                    <td>{{ $item->nombre_vendedor }} {{ $item->apellido_vendedor }}</td>
                                    <td>{{ $item->zona }}</td>
                                    <td>{{ $item->direccion }}</td>

                                    <td>
                                        <a href="{{ url('panel/controlFecha/' . $item->id) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Ver venta">
                                            <i class="fa-solid fa-eye"></i>
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
    </div>
    @endsection
    @section('script')