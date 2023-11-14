<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>

    <div class="container">
        <a href="{{ url('/') }}" class="btn btn-dark"> <i class="fas fa-arrow-left"></i></a>
        <a href="{{ url('/salir') }}" class="btn btn-danger"> <i class="fas fa-sign-out-alt"></i></a>
        @if (Auth::check())
        {{ Auth::user()->nombre }} {{ Auth::user()->apellido}}
        @endif
        <div>
            <div class="container"><br><br><br>

                @include('errorMj')

                <h2> <i class="fas fa-users"></i> Lista de usuarios </h2>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        @if(in_array(auth()->user()->rol, ['a', 'g', 'c']))
                        <button type="button" class="btn btn-primary" style="background-color: #34ac54; border: none;" data-bs-toggle="modal" data-bs-target="#modalCrear">
                            @endif
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
                                    Vendedor
                                    @elseif ($item->rol === 'e')
                                    Encargado
                                    @elseif ($item->rol === 'c')
                                    Colaborador
                                    @elseif ($item->rol === 'b')
                                    Bodega
                                    @elseif ($item->rol === 'g')
                                    Invitado
                                    @endif</td>

                                <td>

                                    @if (in_array(auth()->user()->rol, ['a', 'g', 'c']))
                                    <button type="button" class="btn btn-danger" data-value-delete="{{ $item->correo }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning" data-value-editar="{{ $item->correo }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    @endif
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $listar->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
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
                <div class="modal fade" id="modalEditar" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalEditarTitle">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('admin/actualizar') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="correo" id="Ucorreo">
                                    <div class="col-auto mb-3">
                                        <label for="version" class="form-label">clave</label>
                                        <input type="password" step="1" class="form-control" name="clave" id="">
                                    </div>
                                    <div class="col-auto mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="Unombre" name="nombre">
                                    </div>
                                    <div class="col-auto mb-3">
                                        <label for="nombre" class="form-label">Apellido</label>
                                        <input type="text" class="form-control" id="Uapellido" name="apellido">
                                    </div>


                                    <div class="col-12 mb-3 g-1">
                                        <button class="w-100 btn btn-success" type="submit">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Eliminar -->

                <div class="modal fade" id="modalDelete" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalDeleteTitle">Eliminar Libro</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('admin/delete') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" id="deletecorreo">
                                    <div class="col-auto mb-3">
                                        <label for="deleteNombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="codigo" id="deleteNombre" disabled>
                                    </div>
                                    <div class="col-12 mb-3 g-1">
                                        <button class="w-100 btn btn-danger" type="submit">Eliminar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <!-- Scritp para llenar modal update  -->

    <script>
        const modal_editar = new bootstrap.Modal("#modalEditar");
        const modal_editar_component = document.getElementById("modalEditar");
        const modal_editar_title = document.getElementById('modalEditarTitle');
        const button_editar = document.querySelectorAll("[data-value-editar]");
        const codigo = document.getElementById("Ucorreo");
        const nombre = document.getElementById("Unombre");
        const apellido = document.getElementById("Uapellido");

        //  modal_editar_component.addEventListener("hidden.bs.modal", () => {
        //     document.location.href = "l/ ";
        //  });
        [].slice.call(button_editar).forEach(async function(item) {
            item.addEventListener('click', async () => {
                await fetch("{{ url('admin/up') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            "correo": item.getAttribute("data-value-editar")
                        }),
                    }).then((response) => response.json())
                    .then((data) => {
                        modal_editar_title.innerText = "Edición para " + data[0].correo;
                        codigo.value = data[0].correo;
                        nombre.value = data[0].nombre;
                        apellido.value = data[0].apellido;

                        modal_editar.show();
                    });
            });
        });
    </script>
    <!-- Scritp para llenar modal delete  -->
    <script>
        const modal_delete = new bootstrap.Modal(document.getElementById("modalDelete"));
        const button_delete = document.querySelectorAll("[data-value-delete]");
        const deleteId = document.getElementById("deletecorreo");
        const deleteNombre = document.getElementById("deleteNombre");

        [].slice.call(button_delete).forEach(async function(item) {
            item.addEventListener('click', async () => {
                await fetch("{{ url('admin/up') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            "correo": item.getAttribute("data-value-delete")
                        }),
                    }).then((response) => response.json())
                    .then((data) => {
                        deleteId.value = data[0].correo;
                        deleteNombre.value = data[0].nombre;

                        modal_delete.show();
                    });
            });
        });
    </script>
</body>

</html>