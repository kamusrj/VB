@extends('layouts.master')
@section('title', 'Inventario Bodega')
@section('content')
<div class="container">
    <div class="row">
    </div>
    <br><br>
    <div class="row">
        <div class="col mb-3">
            <h2><span style="display: block; text-align: center; margin: auto;"><i class="fa-solid fa-school"> Instituciones </i></span></h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table  table-sm  table-bordered table-striped" id="venta">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Institucion</th>
                        <th>Direcci&oacute;n</th>
                        <th>Vendedor</th>
                        <th>Ver venta</th>
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
                        <td style="width: 25%;">{{$item->direccion}}</td>
                        <td>{{ $item->nombre_vendedor }} {{ $item->apellido_vendedor }}</td>
                        <td>
                            <a href="{{ url('venta/listadoFechaBodega/' . $item->id) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Ver venta">
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



@endsection