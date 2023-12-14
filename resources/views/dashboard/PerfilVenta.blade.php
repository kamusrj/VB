@extends('layouts.master')

@section('title', 'Perfil de venta')

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
            <div class="col mb-4">
                <h3>Venta directa de {{ $tituloVenta->institucion }} </h3>
                <p class="text-muted">
                    Haz clic en los botones para realizar las acciones correspondientes
                </p>
                <ol class="list-group">
                    <li class="list-group-item border-0 py-0">Detalles: Gestiona la lista de libros para la venta directa
                    </li>
                    <li class="list-group-item border-0 py-0">Facturas: Administra las facturas para la venta</li>
                    <li class="list-group-item border-0 py-0">Cierre de venta: Aadministra el cambio y efectivo inicial de la
                        venta</li>
                </ol>
            </div>
        </div>


        <div class="row">
            @if (in_array(auth()->user()->rol, ['a', 'g', 'c']))
                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="card mb-3 shadow" style="max-width: 540px;cursor: pointer;"
                        onclick="redireccionar('{{ url('panel/controlVenta/' . $tituloVenta->id) }}')">
                        <div class="row g-0">
                            <div class="col-4">
                                <div class="card bg-info d-flex h-100"><i
                                        class="fa-solid fa-list-check m-auto text-light" style="font-size: 3rem;"></i></div>
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h3 class="card-title">Detalles</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card mb-3 shadow" style="max-width: 540px;cursor: pointer;"
                    onclick="redireccionar('{{ url('factura/facturasLista/' . $tituloVenta->id) }}')">
                    <div class="row g-0">
                        <div class="col-4">
                            <div class="card bg-dark d-flex h-100"><i class="fas fa-file-invoice m-auto text-light"
                                    style="font-size: 3rem;"></i></div>
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <h3 class="card-title">Facturas</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card mb-3 shadow" style="max-width: 540px;cursor: pointer;"
                    onclick="redireccionar('{{ url('panel/cierre/' . $tituloVenta->id) }}')">
                    <div class="row g-0">
                        <div class="col-4">
                            <div class="card bg-warning d-flex h-100"><i class="fa-solid fa-school-lock m-auto text-light"
                                    style="font-size: 3rem;"></i></div>
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <h3 class="card-title">Cierre</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function redireccionar(location) {
            document.location.href = location;
        }
    </script>
@endsection
