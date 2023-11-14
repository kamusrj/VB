<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <a href="{{ url('/salir') }}" class="btn btn-danger"> <i class="fas fa-sign-out-alt"></i></a>
    <div class="container"><br><br><br>
        <h2> <i class="fas fa-users"></i> Lista de usuarios </h2>
        </form>
        <ul class="user-list" id="userList">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <button type="button" class="btn btn-primary" style="background-color: #34ac54; border: none;" data-bs-toggle="modal" data-bs-target="#modalCrear">
                        Nuevo usuario
                    </button><br><br>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Nickname</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $listar as $item)
                        <tr>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->apellido }}</td>
                            <td>{{ $item->correo }}</td>
                            <td> @if ($item->rol === 'a')
                                Administrador
                                @elseif ($item->rol === 'v')
                                Visitante
                                @elseif ($item->rol === 'e')
                                Editor
                                @elseif ($item->rol === 'c')
                                Colaborador
                                @elseif ($item->rol === 'b')
                                Beta Tester
                                @elseif ($item->rol === 'g')
                                Invitado
                                @else
                                Otro
                                @endif</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" style="background-color:red; border: none;" data-bs-target="#modaldelete{{ $item->correo }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                </button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{ $item->correo }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <!-----------------    Modal Crear       --------------------------->

                                <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #563d7c !important;">
                                                <h6 class="modal-title" style="color: #fff; text-align: center;">
                                                    Crear Usuario
                                                </h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="userForm" action="{{ url('admin/crear') }}" method="POST">
                                                @csrf
                                                <div class="modal-body" id="cont_modal">
                                                    <div class="form-group">
                                                        <label for="correo">Nombre de usuario:</label>
                                                        <input type="text" id="correo" name="correo" required class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="clave">Clave:</label>
                                                        <input type="password" id="clave" name="clave" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nombre">Nombre:</label>
                                                        <input type="text" id="nombre" name="nombre" required class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="apellido">Apellido:</label>
                                                        <input type="text" id="apellido" name="apellido" required class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="rol">Rol:</label>
                                                        <select name="rol" id="rol" class="form-control">
                                                            <option value="" {{ old('rol') == '' ? 'selected' : '' }}>-- Selecciona un rol --</option>
                                                            <option value="v" {{ old('rol') == 'v' ? 'selected' : '' }}>Vendedor</option>
                                                            <option value="e" {{ old('rol') == 'e' ? 'selected' : '' }}>Encargado</option>
                                                            <option value="c" {{ old('rol') == 'c' ? 'selected' : '' }}>Contabilidad</option>
                                                            <option value="b" {{ old('rol') == 'b' ? 'selected' : '' }}>Bodega</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#" class="btn btn-secondary" data-bs-dismiss="modal" style="border: none;" aria-label="Close">Cerrar</a>
                                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-----------------    Modal Actualizar        --------------------------->
                                <div class="modal fade" id="modal{{ $item->correo }}" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">

                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: red !important;">
                                                <h6 class="modal-title" style="color: #fff; text-align: center;">
                                                    Actualizar Información de {{$item->nombre}}
                                                </h6>
                                            </div>
                                            <form method="POST" action="{{ url('admin/actualizar') }} ">
                                                @csrf
                                                <div class="modal-body" id="cont_modal">
                                                    <div class="form-group">
                                                        <label for="correo">Nombre de usuario:</label>
                                                        <input type="text" id="correo" class="form-control" value="{{$item->correo}}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="clave">Clave:</label>
                                                        <input type="password" id="clave" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nombre">Nombre:</label>
                                                        <input type="text" id="nombre" name="nombre" class="form-control" value="{{$item->nombre}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="apellido">Apellido:</label>
                                                        <input type="text" id="apellido" name="apellido" class="form-control" value="{{$item->apellido}}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cerrar</a>
                                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Eliminar -->
                                <div class="modal fade" id="modaldelete{{ $item->correo }}" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #563d7c !important;">
                                                    <h6 class="modal-title" style="color: #fff; text-align: center;">
                                                        Actualizar Información de {{$item->nombre}}
                                                    </h6>
                                                </div>
                                                <form method="POST" action="{{ url('admin/eliminar') }} ">
                                                    @csrf
                                                    <div class="modal-body" id="cont_modal">

                                                        <div class="form-group">
                                                            <label for="apellido">
                                                                <h4>Desea eliminar al usuario:<br><br> {{$item->nombre}} {{$item->apellido}}</h4>
                                                            </label><br>
                                                            <br>
                                                            <input type="hidden" name="eliminar" value="{{$item->correo}}">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                                                cancelar
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">eliminar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>