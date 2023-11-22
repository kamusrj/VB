@extends('layouts.master')
@section('title', 'inventario venta')
@section('content')
<div class="container">

    <div class="row">
        <div class="col my-3">
            <a href="{{ url('/') }}" class="btn btn-dark"> <i class="fas fa-arrow-left"></i></a>
            <a href="{{ url('/salir') }}" class="btn btn-danger"> <i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>
    <form action="{{url('panel/stockventa')}}" method="post">
        @csrf
        

                <h3>Listado de ventas <i class="fas fa-basket-shopping"></i> </h3>
                <div class="table table-striped">
                    <table class="table  table-sm table-bordered table-striped">
                        <thead>

                            @php
                            $numero = 1;
                            @endphp
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Libro</th>
                                <th scope="col">cantidad</th>
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
                        <tbody>
                            @foreach($inventario as $item)
                            <tr>
                                <td>{{ $numero }}</td>
                                <td>{{ $item->nombre_libro }}</td>
                                <td>
                                    <input name="id" value="{{ $item->id_venta }}" required hidden>
                                    <input name="libros_seleccionados[]" value="{{ $item->id_libro }}" required hidden>
                                    <span>{{ $item->stock_venta }}</span>
                                </td>
                                <td class="precio">
                                    $<span class="precio">{{ $item->precio }}</span>
                                </td>
                                <td>
                                    <input type="number" name="venta[]" min="0" max="{{ $item->stock_venta }}" value="0" oninput="calculateTotal(this, {{$item->precio}}, {{$item->descuento}},{{ $item->ofrecimiento_a }} )" required>
                                </td>
                                <td>
                                    <input type="number" id="total" name="totalvendio[]" min="0" value="0" readonly>
                                </td>
                                <td>
                                    <span>{{ $item->descuento }}</span>
                                </td>
                                <td>
                                    <input type="number" name="reintegro[]" min="0" value="0" readonly>
                                </td>
                                <td>
                                    <input type="number" name="TotalReintegro[]" min="0" value="0" readonly>
                                </td>

                                <td>
                                    <span>{{ $item->ofrecimiento_a }}</span>
                                </td>
                                <td>
                                    <input type="number" name="Totalofrecimiento_a[]" min="0" value="" readonly>
                                </td>
                            </tr>
                            @php
                            $numero++;
                            @endphp

                            @endforeach
                        </tbody>
                        </tbody>
                    </table>

                </div>
       
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
    <div class="col-md-3"> </div>

</div>
</div>
@endsection
@section('script')
<script>
    function calculateTotal(input, precio, descuento, ofrecimiento_a) {
        var venta = parseFloat(input.value) || 0;
        var totalVendido = venta * precio;
        var descuentoAplicado = precio * (descuento / 100);
        var totalReintegro = venta * descuentoAplicado.toFixed(2);
        var row = input.closest('tr');
        var totalof = venta * ofrecimiento_a;
        var totalReintegroField = row.querySelector('[name="TotalReintegro[]"]');
        var ofrecimientoField = row.querySelector('[name="Totalofrecimiento_a[]"]');
        input.closest('tr').querySelector('[name="totalvendio[]"]').value = totalVendido.toFixed(2);
        input.closest('tr').querySelector('[name="reintegro[]"]').value = descuentoAplicado.toFixed(2);
        totalReintegroField.value = totalReintegro.toFixed(2);
        input.closest('tr').querySelector('[name="Totalofrecimiento_a[]"]').value = totalof.toFixed(2);
    }
</script>
@endsection