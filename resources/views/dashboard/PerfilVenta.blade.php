@extends('layouts.master')
@section('title', 'Perfil de venta')
@section('content')
<h1> {{$tituloVenta->institucion}} </h1>
@section('style')
<style>
    a.btn.btn-info.w-100 {
        font-size: 40px;
    }

    @media only screen and (max-width: 620px) {
        a.btn.btn-info.w-100 {
            font-size: 8vw;
        }
    }
</style>
@endsection
@section('content')
<div class="container">

    <div class="row">


        @if (in_array(auth()->user()->rol, ['a', 'g', 'c']))
        <div class="col-sm col-md-6 mb-4">
            <div class="card border-0">
                <div class="card-body text-center">
                    <a href="{{ url('panel/controlVenta/'. $tituloVenta->id) }}" class="btn btn-info w-100" data-toggle="tooltip" data-placement="bottom">
                        <i class="fa-solid fa-list-check"></i>
                        <span>Detalle de Venta</span>
                    </a>
                </div>
            </div>
        </div>
        @endif

        <div class="col-sm col-md-6 mb-4">
            <div class="card border-0">
                <div class="card-body text-center">
                    <a href="{{ url('factura/facturasLista/'. $tituloVenta->id) }}" class="btn btn-info w-100" data-toggle="tooltip" data-placement="bottom">
                        <i class="fas fa-file-invoice"></i>
                        <span>Facturas</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm col-md-6 mb-4">
            <div class="card border-0">
                <div class="card-body text-center">
                    <a href="{{ url('panel/cierre/'. $tituloVenta->id) }}" class="btn btn-info w-100" data-toggle="tooltip" data-placement="bottom">
                        <i class="fa-solid fa-school-lock"></i>
                        <span>Cierre de venta </span>
                    </a>
                </div>
            </div>
        </div>


        <div class="col-sm col-md-6 mb-4">
            <div class="card border-0">
                <div class="card-body text-center">
                    <a href="{{ url('/salir') }}" class="btn btn-info w-100" data-toggle="tooltip" data-placement="bottom">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar Sesi&oacute;n</span>
                    </a>
                </div>
            </div>
        </div>

        @if (in_array(auth()->user()->rol, ['a', 'g', 'c']))
        <div class="col-sm col-md-6 mb-4">
            <div class="card border-0">

                <div class="card-body text-center">
                    <a href="{{ url('/') }}" class="btn btn-info w-100" data-toggle="tooltip" data-placement="bottom">
                        <i class="fa-solid fa-house"></i>
                        <span>Men&uacute; de Administrador</span>
                    </a>
                </div>
            </div>
        </div>
        @endif


    </div>
    @endsection
    @section('script')