@extends('layouts.master')

@section('title', 'panel')

@section('content')
<div class="container">

    <div class="row">
        <div class="col my-3">
            <a href="{{ url('/') }}" class="btn btn-dark"> <i class="fas fa-arrow-left"></i></a>
            <a href="{{ url('/salir') }}" class="btn btn-danger"> <i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">


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
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                @php
                $numero = 1;
                @endphp
                @foreach ($ventas as $item)
                <tr>
                    <td>{{ $numero }}</td>
                    <td>{{ $item->institucion}}</td>
                    <td>{{ $item->director }}</td>
                    <td>{{ $item->nombre_encargado }} {{ $item->apellido_encargado }}</td>
                    <td>{{ $item->telefono }}</td>
                    <td>{{ $item->nombre_vendedor }} {{ $item->apellido_vendedor }}</td>
                    <td>{{ $item->zona}}</td>
                    <td>{{ $item->direccion}}</td>
                    <td></td>
                </tr>
                @php
                $numero++;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>

</div>




@endsection

@section('script')