@extends('layouts.master')
@section('title', 'Datos de venta')
@section('content')
<div class="container">
    <div class="row">
        <div class="col my-3">
            <a href="{{ url('panel/perfilVenta/' . $id . '/' . $fecha) }}" class="btn btn-dark"> <i class="fas fa-arrow-left"></i></a>
        </div>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="false">Venta</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Documentaci&oacute;n</button>
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
            <h3><i class="fas fa-basket-shopping"> Datos de venta </i> </h3><br>
            <div class="table table-striped">
                <table class="table  table-sm table-bordered table-striped" style="text-align: center;">
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
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <h4>Fecha:{{$fecha}}</h4><br>
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
                                <span>{{ $item->ofrecimiento_a}}</span>
                            </td>
                            <td>
                                <span>{{ $item->totaloa }}</span>
                            </td>
                            <td>
                                @if($item->vendido == 0)
                                <button type="button" class="btn btn-warning" data-value-editar="{{ $item->id_libro}}">
                                    <i class="fas fa-edit"></i>
                                </button>@endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                <div>
                    <strong> Venta: $<span id="totalVenta"></span></strong><br><br>
                    <strong style="margin-bottom: 10px;"> Reintegro: $<span id="totalReintegro"></span></strong><br><br>
                    <strong> Total O/A: $<span id="totalOA"></span></strong>
                    <hr>
                    <strong>Total: $<span id="totalFinal"></span> </strong>
                </div>

                <!-- Modificar -->
                <div class="modal fade" id="modalEditar" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content" style="background-color: white;">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalEditarTitle">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('panel/actualizarIn/') }}" method="post">
                                    @csrf
                                    <input name="id_libro" id="Ulibro" hidden>
                                    <input name="id_venta" id="Uventa" hidden>
                                    <input name="fecha" id='Ufecha' hidden>
                                    <div class="col-auto mb-3">
                                        <label for="precio" class="form-label">Precio</label>
                                        <input type="number" class="form-control" id="Uprecio" step="any" name="precio">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="descuento" class="form-label">Descuento %</label>
                                        <input type="number" name="descuento" id="Udescuento" class="form-control"></input>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="OA" class="form-label">Ofrecimientos Adicionales</label>
                                        <input type="number" name="oa" id="Uoa" class="form-control" step="any"></input>
                                    </div>
                                    <hr>
                                    <span>Modificacion de inventario </span>
                                    <br><br>
                                    <div class="col-12 mb-3">
                                        <label for="stock" class="form-label">Inventario Actual</label>
                                        <input type="number" id="Ustock" class="form-control" style="background-color: #ffff;" disabled></input>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="mod" class="form-label">Modifición <br>(ingrese la cantidad de libros a aumentar o disminuir)</label>
                                        <input type="number" name="modificacion" id="mod" value="0" class="form-control"></input>
                                    </div>
                                    <div class="col-12 mb-3 g-1">
                                        <button class="w-100 btn btn-success" type="submit">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            @include('dashboard.componentesDetalleVenta.Documentacion')

        </div>
        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
            @include('dashboard.componentesDetalleVenta.cambio')
        </div>
        <div class="tab-pane fade" id="-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">


        </div>
    </div>
</div>

@endsection
@section('script')

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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

    // modificion libro

    const modal_editar = new bootstrap.Modal("#modalEditar");
    const modal_editar_component = document.getElementById("modalEditar");
    const modal_editar_title = document.getElementById('modalEditarTitle');
    const button_editar = document.querySelectorAll("[data-value-editar]");

    const id_libro = document.getElementById("Ulibro");
    const id_venta = document.getElementById("Uventa");
    const fecha = document.getElementById("Ufecha");
    const precio = document.getElementById("Uprecio");
    const descuento = document.getElementById("Udescuento");
    const oa = document.getElementById("Uoa");
    const stock = document.getElementById("Ustock");
    const mod = document.getElementById("mod");


    [].slice.call(button_editar).forEach(async function(item) {
        item.addEventListener('click', async () => {
            await fetch("{{ url('panel/buscarInventario') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        "id_libro": item.getAttribute("data-value-editar"),
                        "id_venta": '{{$id}}'
                    }),
                }).then((response) => response.json())
                .then((data) => {
                    modal_editar_title.innerText = "Edición para " + data.nombre_libro;
                    id_libro.value = data.id_libro;
                    id_venta.value = data.id_venta;
                    fecha.value = data.fecha;
                    precio.value = data.precio;
                    descuento.value = data.descuento;
                    oa.value = data.ofrecimiento_a;
                    stock.value = data.stock_venta;

                    modal_editar.show();

                    modal_editar_component.addEventListener('hidden.bs.modal', function() {

                        mod.value = 0;
                    });
                });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const total = document.getElementById('total');
        const campos = document.querySelectorAll("[data-denominacion]");

        function calcularTotal() {
            let total_actual = 0;
            [].slice.call(campos).forEach(function(campo) {
                let denominacion = campo.getAttribute("data-denominacion");
                total_actual += campo.value * denominacion;
            });
            total.innerText = parseFloat(total_actual).toFixed(2);
        }
        calcularTotal();
    });
</script>
@endsection