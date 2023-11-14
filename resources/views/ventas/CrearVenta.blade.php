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
    <br><br>
    <div class="container">
        <h2>Nueva venta directa </h2>
        <form method="POST" action="{{ url('venta/crear') }}">
            @csrf
            @include('errorMj')
            <div class="form-group">
                <label for="Primaria"></label>
                <input type="hidden" name="codigo" style="background-color: #f6f6f6;" class="form-control" id="codigo" value="{{$school->codigo}}" readonly>
            </div>
            <div class="form-group">
                <label for="Primaria">Institución</label>
                <input type="text" name="institucion" style="background-color: #f6f6f6;" class="form-control" id="institucion" value="{{ $school->nombre }}" readonly>
            </div>

            <div class="form-group">
                <label for="Director">Director</label>
                <input type="text" name="director" class="form-control" id="director">
            </div>
            <label for="Vendedor">Encargado</label>
            <select name="encargado" class="form-control" id="Vendedor">
                <option value="">Selecciona un Encargado</option>
                @foreach($encargado as $e)
                <option value="{{ $e->correo }}">{{ $e->nombre }} {{ $e->apellido }}</option>
                @endforeach
            </select>

            <div class="form-group">
                <label for="Vendedor">Teléfono</label>

                <input type="text" name="telefono" class="form-control" id="telefono">
            </div>
            <label for="Vendedor">Vendedor</label>
            <select name="vendedor" class="form-control" id="Vendedor">
                <option value="">Selecciona un vendedor</option>
                @foreach($vendedores as $vendedor)
                <option value="{{ $vendedor->correo }}">{{ $vendedor->nombre }} {{ $vendedor->apellido }}</option>
                @endforeach
            </select>

            <div class="form-group">
                <label for="Zona">Zona</label>
                <input type="text" name="zona" class="form-control" id="Zona">
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" class="form-control" id="direccion">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function() {
            $('#birth-date').mask('00/00/0000');
            $('#telefono').mask('0000-0000');
        });
    </script>


</body>

</html>