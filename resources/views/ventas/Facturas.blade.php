<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituciones</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <a href="{{ url('/') }}" class="btn btn-dark"> <i class="fas fa-arrow-left"></i></a>
    <a href="{{ url('/salir') }}" class="btn btn-danger"> <i class="fas fa-sign-out-alt"></i></a>
    @if (Auth::check())
    {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}
    @endif

    <div class="container">
        <h2>Nueva venta directa </h2>
        <form method="post" action="{{ url('factura/create') }}">
            @csrf
            @include('errorMj')

            <div class="form-group">
                <label for="Primaria"></label>
                <input type="text" name="id_venta" style="background-color: #f6f6f6;" class="form-control" id="id_venta" value="{{$tituloVenta->id}}" readonly>
            </div>
            <div class="form-group">
                <label for="Primaria">Institución</label>
                <input type="text" name="institucion" style="background-color: #f6f6f6;" class="form-control" id="institucion" value="{{$tituloVenta->institucion}}" readonly>
            </div>

            <div class="form-group">
                <label for="Director">Departamento de credito venta asignada a: </label>
                <input type="text" name="representante" class="form-control" id="director">
            </div>
            <div class="form-group">
                <label for="Encargado">Nota / Notas de remisión</label>
                <input type="text" name="n_remision" class="form-control" id="encargado">
            </div>
            <div class="form-group">
                <label for="Vendedor">Factura inicial</label>
                <input type="number" name="factura_i" class="form-control" id="telefono">
            </div>
            <div class="form-group">
                <label for="Vendedor">Factura final</label>
                <input type="number" name="factura_f" class="form-control" id="Vendedor">
            </div>

            <div class="form-group">
                <label for="Zona">Total de facturas</label>
                <input type="text" name="total_f" class="form-control" id="Total" readonly>
            </div>
            <div class="form-group">
                <label for="Vendedor">cupon inicial</label>
                <input type="number" name="cupon_i" class="form-control" id="telefono">
            </div>
            <div class="form-group">
                <label for="Vendedor">Cupon final</label>
                <input type="number" name="cupon_f" class="form-control" id="Vendedor">
            </div>

            <div class="form-group">
                <label for="Zona">Total de Cupones</label>
                <input type="text" name="cupon_t" class="form-control" id="Total" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>


    <script>
        $(document).ready(function() {
            // Captura los campos de factura inicial y factura final
            var facturaInicialInput = $("input[name='factura_i']");
            var facturaFinalInput = $("input[name='factura_f']");
            var totalFacturasInput = $("input[name='total_f']");

            // Agrega un evento de cambio a ambos campos
            facturaInicialInput.on('input', actualizarTotalFacturas);
            facturaFinalInput.on('input', actualizarTotalFacturas);

            // Función para actualizar el campo de "Total de facturas"
            function actualizarTotalFacturas() {
                // Obtén los valores actuales de las facturas inicial y final
                var facturaInicial = parseFloat(facturaInicialInput.val()) || 0;
                var facturaFinal = parseFloat(facturaFinalInput.val()) || 0;


                var totalFacturas = facturaFinal - facturaInicial;
                totalFacturasInput.val(parseInt(totalFacturas));
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            // Captura los campos de cupon inicial y cupon final
            var cuponInicialInput = $("input[name='cupon_i']");
            var cuponFinalInput = $("input[name='cupon_f']");
            var totalCuponesInput = $("input[name='cupon_t']");

            // Agrega un evento de cambio a ambos campos
            cuponInicialInput.on('input', calcularTotalCupones);
            cuponFinalInput.on('input', calcularTotalCupones);

            // Función para calcular el campo de "Total de Cupones"
            function calcularTotalCupones() {
                // Obtén los valores actuales de cupon inicial y final
                var cuponInicial = parseFloat(cuponInicialInput.val()) || 0;
                var cuponFinal = parseFloat(cuponFinalInput.val()) || 0;

                // Calcular la resta de cupones
                var totalCupones = cuponFinal - cuponInicial;

                // Mostrar el resultado en el campo Total de Cupones
                totalCuponesInput.val(totalCupones);
            }
        });
    </script>
</body>

</html>