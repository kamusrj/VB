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
        <h2> {{$tituloVenta->institucion}}</h2>

        <form method="post" action="{{ url('factura/createEfectivo') }}">
            @csrf
            @include('errorMj')

            <div class="form-group">
                <label for="Primaria"></label>
                <input type="hidden" name="id_venta" style="background-color: #f6f6f6;" class="form-control" id="id_venta" value="{{$tituloVenta->id}}" readonly>
            </div>
            <div class="form-group">
                <h2>Efectivo para Cambio </h2>

            </div>

            <div class="container ">

                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <table class="table table-bordered">
                        <h5>Denominacion</h5>
                        <tbody class="table table-bordered table-sm">
                            <tr>
                                <th scope="row" class="col-4">$0.01</th>
                                <td class="col-8">
                                    <input type="number" step="0.01" name="centavo_uno" class="form-control" id="c_1">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="col-4">$0.05</th>
                                <td class="col-8">
                                    <input type="text" name="centavo_cinco" class="form-control" id="c_5">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="col-4">$0.10</th>
                                <td class="col-8">
                                    <input type="text" name="centavo_diez" class="form-control" id="c_10">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="col-4">$0.25</th>
                                <td class="col-8">
                                    <input type="text" name="centavo_veinticinco" class="form-control" id="c_25">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="col-4">$1.00</th>
                                <td class="col-8">
                                    <input type="text" name="dolar_uno" class="form-control" id="d_1">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="col-4">$5.00</th>
                                <td class="col-8">
                                    <input type="text" name="dolar_cinco" class="form-control" id="d_5">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="col-4">$10.00</th>
                                <td class="col-8">
                                    <input type="text" name="dolar_diez" class="form-control" id="d_10">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="col-4">$20.00</th>
                                <td class="col-8">
                                    <input type="text" name="dolar_veinte" class="form-control" id="d_10">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="col-4">Total</th>
                                <td class="col-8">
                                    <input type="text" name="total" class="form-control" id="total" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4"></div>
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
            var camposMonetarios = $('input[id^="c_"], input[id^="d_"]');
            camposMonetarios.on('input', function() {
                calcularTotal();
            });

            function calcularTotal() {
                var total = 0;
                camposMonetarios.each(function() {
                    var valor = parseFloat($(this).val()) || 0;
                    total += valor;
                });
                $('input[name="total"]').val(total.toFixed(2));
            }
        });
    </script>
</body>

</html>