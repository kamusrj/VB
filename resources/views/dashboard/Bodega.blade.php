@extends('layouts.master')

@section('title', 'Inventario Bodega')

@section('content')

<div class="container">

    <div class="row">
        <div class="col">
            <a href="{{ url('/') }}" class="btn btn-dark"> <i class="fas fa-arrow-left"></i></a>
            <a href="{{ url('/salir') }}" class="btn btn-danger"> <i class="fas fa-sign-out-alt"></i></a>

        </div>
    </div>

    <div class="row">
        <div class="col mb-3">
            <h2>Nueva venta directa </h2>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-bordered table-striped" id="venta">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Institucion</th>
                        <th>Encargado</th>
                        <th>Vendedor</th>
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
                        <td>{{ $item->nombre_encargado }} {{ $item->apellido_encargado }}</td>
                        <td>{{ $item->nombre_vendedor }} {{ $item->apellido_vendedor }}</td>
                        <td>
                            <a href="{{ url('panel/perfilVenta/' . $item->id) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Ver venta">
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




@endsection

@section('script')