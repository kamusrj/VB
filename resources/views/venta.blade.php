<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .center-container {
            display: flex;
            margin-left: 10px;
            margin-right: 10px;
            align-items: center;
            justify-content: center;
            height: 100vh;

        }
    </style>
</head>

<body>
    <h1>Venta Directa </h1>


    <div class="center-container">

        <!--       $        -->
        <a href="{{ url('libro/') }}" class="btn btn-primary">
            <i class="fa-solid fa-dollar-sign" style="font-size: 40px;"></i>

        </a>

        <!--      Facturas    -->
        <a href="{{ url('factura/') }}" class="btn btn-warning">
            <i class="fas fa-file-invoice-dollar" style="font-size: 40px;"></i>

        </a>
        <!--       $        -->
        <a href="{{ url('admin/listar') }}" class="btn btn-success">
            <i class="fas fa-user" style="font-size: 40px;"></i>
        </a>
        <!--       $        -->
        <a href="{{ url('pedidos/') }}" class="btn btn-secondary">
            <i class="fas fa-basket-shopping" style="font-size: 40px;"></i>
        </a>
        <!--       $        -->
        <a href="{{ url('/salir') }}" class="btn btn-danger">

            <i class="fas fa-sign-out-alt" style="font-size: 40px;"></i>
        </a>



        <form action="{{ url('libro/guardar') }}" method="post">
            @csrf
            <label for="escuela">Selecciona una escuela:</label>
            <select name="escuela" id="escuela">
                @foreach($escuelas as $escuela)
                <option value="{{ $escuela->ID_Escuela }}">{{ $escuela->Nombre_Escuela }}</option>
                @endforeach
            </select>

            <label>Libros disponibles:</label>
            @foreach($libros as $libro)
            <label>
                <input type="checkbox" name="libros[]" value="{{ $libro->ID_Libro }}">
                {{ $libro->Título }}
            </label><br>
            @endforeach

            <button type="submit">Asignar Libros</button>
        </form>





    </div>
</body>

</html>