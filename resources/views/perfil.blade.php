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

<div class="container mt-5">
    <div class="row">
        <div class="col mb-4">
            <h3><i class="fa fa-home"></i> Men&uacute; Principal</h3>
            <p class="text-muted">
                Haz clic en los botones para realizar las acciones correspondientes
            </p>
            <ol class="list-group">
                <li class="list-group-item border-0 py-0">Libros: Gestiona la lista de libros para la venta directa
                </li>
                <li class="list-group-item border-0 py-0">Intituciones: Administra las intituciones de catalogo de
                    venta</li>
                <li class="list-group-item border-0 py-0">Usuarios: Administra los usuarios y sus roles dentro de la
                    aplicaci&oacute;n</li>
                <li class="list-group-item border-0 py-0">Ventas: Crea y gestiona las ventas que se
                    realizan</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="card mb-3 shadow" style="max-width: 540px;cursor: pointer;" onclick="redireccionar('{{ url('libro/') }}')">
                <div class="row g-0">
                    <div class="col-4">
                        <div class="card bg-secondary d-flex h-100"><i class="fas fa-book m-auto text-light"
                                style="font-size: 3rem;"></i></div>
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <h3 class="card-title">Libros</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="card mb-3 shadow" style="max-width: 540px;cursor: pointer;" onclick="redireccionar('{{ url('institucion/') }}')">
                <div class="row g-0">
                    <div class="col-4">
                        <div class="card bg-primary d-flex h-100"><i class="fas fa-school m-auto text-light"
                                style="font-size: 3rem;"></i></div>
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <h3 class="card-title">Intituciones</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="card mb-3 shadow" style="max-width: 540px;cursor: pointer;" onclick="redireccionar('{{ url('admin/listar/') }}')">
                <div class="row g-0">
                    <div class="col-4">
                        <div class="card bg-warning d-flex h-100"><i class="fas fa-user m-auto text-light"
                                style="font-size: 3rem;"></i></div>
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <h3 class="card-title">Usuarios</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="card mb-3 shadow" style="max-width: 540px;cursor: pointer;" onclick="redireccionar('{{ url('panel/') }}')">
                <div class="row g-0">
                    <div class="col-4">
                        <div class="card bg-info d-flex h-100"><i class="fas fa-basket-shopping m-auto text-light"
                                style="font-size: 3rem;"></i></div>
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <h3 class="card-title">Ventas</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    function redireccionar(location){
        document.location.href = location;
    }
</script>