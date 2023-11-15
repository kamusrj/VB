@extends('layouts.master')

@section('title', 'Bienvenido')

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
        <div class="col-sm col-md-6 mb-3">

            <h3> {{ Auth::user()->nombre }} {{ Auth::user()->apellido }} </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm col-md-6 mb-4">
            <div class="card border-0">
                <div class="card-body text-center">
                    <a href="{{ url('libro/') }}" class="btn btn-info w-100" data-toggle="tooltip" data-placement="bottom">
                        <i class="fas fa-book"></i>
                        <span>Libros</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm col-md-6 mb-4">
            <div class="card border-0">
                <div class="card-body text-center">
                    <a href="{{ url('institucion/') }}" class="btn btn-info w-100" data-toggle="tooltip" data-placement="bottom">
                        <i class="fas fa-school"></i>
                        <span>Instituciones</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm col-md-6 mb-4">
            <div class="card border-0">
                <div class="card-body text-center">
                    <a href="{{ url('admin/listar') }}" class="btn btn-info w-100" data-toggle="tooltip" data-placement="bottom">
                        <i class="fas fa-user"></i>
                        <span>Usuarios</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm col-md-6 mb-4">
            <div class="card border-0">
                <div class="card-body text-center">
                    <a href="{{ url('panel/') }}" class="btn btn-info w-100" data-toggle="tooltip" data-placement="bottom">
                        <i class="fas fa-basket-shopping"></i>
                        <span>Ventas directas</span>
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

    </div>
</div>





@endsection