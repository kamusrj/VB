<!DOCTYPE html>
<html lang="es">

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
            justify-content: center;
            align-items: center;
            margin-top: -50px;
        }

        .center-container a {
            display: inline-block;
            padding: 20px 30px;
            font-size: 20px;
            border-radius: 5px;
            margin: 10px;
            text-decoration: none;
            color: #fff;
        }

        .center-container a:hover {
            background-color: #eee;
            color: #333;
        }

        .center-container .btn-primary {
            background-color: #28a745;
        }

        .center-container .btn-warning {
            background-color: #ffc107;
        }

        .center-container .btn-success {
            background-color: #007bff;
        }

        .center-container .btn-secondary {
            background-color: #6c757d;
        }

        .center-container .btn-danger {
            background-color: #dc3545;
        }
    </style>
</head>

<body>
    Perfil
    @if (Auth::check())
    <h3> {{ Auth::user()->nombre }} {{ Auth::user()->apellido}} </h3>
    @endif
    <div class="center-container">
        <a href="{{ url('libro/') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Listado de Libros">
            <i class="fas fa-book" style="font-size: 40px;"></i>
        </a>
        <a href="{{ url('institucion/') }}" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Listado de instituciones">
            <i class="fas fa-school" style="font-size: 40px;"></i>
        </a>
        <a href="{{ url('admin/listar') }}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Listado de usuarios">
            <i class="fas fa-user" style="font-size: 40px;"></i>
        </a>
        <a href="{{ url('venta/') }}" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Ventas directas ">
            <i class="fas fa-basket-shopping" style="font-size: 40px;"></i>
        </a>
        <a href="{{ url('/salir') }}" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="cerrar session">
            <i class="fas fa-sign-out-alt" style="font-size: 40px;"></i>
        </a>
    </div>
</body>

</html>