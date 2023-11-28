@extends('layouts.master')
@section('title', 'Datos de venta')
@section('content')
<div class="container">

    <div class="row">
        <div class="col my-3">
            <a href="{{ url('/') }}" class="btn btn-dark"> <i class="fas fa-arrow-left"></i></a>
            <a href="{{ url('/salir') }}" class="btn btn-danger"> <i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Venta</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Inventario</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Cambio</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Cambio</button>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <br>
            <h3><i class="fas fa-basket-shopping">Datos de venta </i> </h3>
            <div class="table table-striped">
                <table class="table  table-sm table-bordered table-striped">
                    <thead>

                        <tr>

                            <th scope="col">Libro</th>
                            <th scope="col">precio</th>
                            <th scope="col">unidades vendidas</th>
                            <th scope="col">total vendido</th>
                            <th scope="col">Descuento %</th>
                            <th scope="col">Reintegro <br>por libro</th>
                            <th scope="col">Total Reintegro</th>
                            <th scope="col">O/A</th>
                            <th scope="col">Total O/A</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($inventario as $item)
                        <tr>

                            <td>{{ $item->nombre_libro }}</td>
                            <td>
                                $<span>{{ $item->precio }}</span>
                            </td>
                            <td>
                                <span>{{$item->vendido}}</span>
                            </td>
                            <td>
                                $ <span>{{$item->totalventa }}</span>

                            </td>
                            <td>
                                <span>{{ $item->descuento }}</span>
                            </td>
                            <td>
                                <span>{{$item->reintegro}}</span>
                            </td>
                            <td>
                                <span>{{$item->totalReintegro}}</span>
                            </td>

                            <td>
                                <span>{{ $item->ofrecimiento_a }}</span>
                            </td>
                            <td>
                                <span>{{ $item->totaloa }}</span>
                            </td>
                        </tr>


                        @endforeach
                    </tbody>

                </table>
                <div>
                    <strong> Venta: $<span id="totalVenta"></span> </strong><br>
                    <strong> Reintegro: $<span id="totalReintegro"></span> </strong><br>
                    <strong> Total O/A: $<span id="totalOA"></span> </strong>
                    <hr>
                    <strong>Total: $<span id="totalFinal"></span> </strong>
                </div>


            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
            <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var totalVenta = 0;
        var totalReintegro = 0;
        var totalOA = 0;

        var totalVentaElements = document.querySelectorAll('tbody td:nth-child(4) span');
        var totalReintegroElements = document.querySelectorAll('tbody td:nth-child(7) span');
        var totalOAElements = document.querySelectorAll('tbody td:nth-child(9) span');

        totalVentaElements.forEach(function(element) {
            totalVenta += parseFloat(element.innerText.replace('$', ''));
        });

        totalReintegroElements.forEach(function(element) {
            totalReintegro += parseFloat(element.innerText.replace('$', ''));
        });

        totalOAElements.forEach(function(element) {
            totalOA += parseFloat(element.innerText.replace('$', ''));
        });

        var totalFinal = totalVenta - (totalReintegro + totalOA);

        document.getElementById('totalVenta').innerText = totalVenta.toFixed(2);
        document.getElementById('totalReintegro').innerText = totalReintegro.toFixed(2);
        document.getElementById('totalOA').innerText = totalOA.toFixed(2);
        document.getElementById('totalFinal').innerText = totalFinal.toFixed(2);
    });
</script>
@endsection