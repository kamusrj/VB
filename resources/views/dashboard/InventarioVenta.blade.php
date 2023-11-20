@extends('layouts.master')

@section('title', 'inventario venta')
@section('content')
<div class="containe">
    <div class="row">
        <div class="col-md-3"> </div>
        <div class="col-md-6">

            <h3>Inventario venta </h3>
            <table class="table table-striped">

                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Libro</th>
                        <th scope="col">cantidad</th>
                        <th scope="col">precio</th>
                        <th scope="col">venta</th>
                        <th scope="col">total vendido</th>
                        <th scope="col">Descuento %</th>
                        <th scope="col">Ofrecimientos <BR> adicionales</th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    @foreach($inventario as $item)
                    <tr>
                        <td>{{ $item->nombre_libro }}</td>
                        <td>
                            <input type="hidden" name="id" value="{{ $item->id_venta }}" required>
                            <input type="hidden" name="libros_seleccionados[]" value="{{ $item->id_libro }}" required>
                            <span>{{ $item->stock }}</span>
                        </td>
                        <td class="precio">
                            $<span class="precio">{{ $item->precio }}</span>
                        </td>
                        <td>
                            <input type="number" name="venta[]" min="0" value="" oninput="calculateTotal(this, {{$item->precio}}, {{$item->descuento}})" required>
                        </td>
                        <td>
                            <input type="number" name="totalvendio[]" min="0" value="" readonly>
                        </td>
                        <td>
                            <span>{{ $item->descuento }}</span>
                        </td>
                        <td>
                            <span>{{ $item->ofrecimiento_a }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </tbody>
            </table>
        </div>
        <div class="col-md-3"> </div>
    </div>
</div>
@endsection

@section('script')

<script>
    function calculateTotal(input, precio, descuento) {
        var venta = parseFloat(input.value) || 0;
        var totalVendido = venta * precio;
        input.closest('tr').querySelector('[name="totalvendio[]"]').value = totalVendido.toFixed(2);
    }
</script>
@endsection