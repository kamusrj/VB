@extends('layouts.master')

@section('title', 'Usuarios')

@section('content')
<div class="container">
    <div class="row">
        <div class="col my-3">
            <a href="{{ url('/') }}" class="btn btn-dark"> <i class="fas fa-arrow-left"></i></a>

        </div>
    </div>

    <div class="row">
        <div class="col">
            @include('errorMj')
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h2> <i class="fas fa-users"></i> Lista de usuarios </h2>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    @if (in_array(auth()->user()->rol, ['a', 'g', 'c']))
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
                        @foreach ($listar as $item)
                        <tr>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->apellido }}</td>
                            <td>{{ $item->correo }}</td>
                            <td>
                                @if ($item->rol === 'a')
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
                                @endif
                            </td>

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
        </div>
    </div>
</div>

<!--  Crear usuario       -->
<div class="modal fade" id="modalCrear">
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

            <div class="modal-body" id="cont_modal">
                <form id="userForm" action="{{ url('admin/crear') }}" method="POST">
                    @csrf
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
                            <option value="" {{ old('rol') == '' ? 'selected' : '' }}>-- Selecciona
                                un rol --</option>
                            <option value="v" {{ old('rol') == 'v' ? 'selected' : '' }}>Vendedor
                            </option>
                            <option value="e" {{ old('rol') == 'e' ? 'selected' : '' }}>Encargado
                            </option>
                            <option value="c" {{ old('rol') == 'c' ? 'selected' : '' }}>Contabilidad
                            </option>
                            <option value="b" {{ old('rol') == 'b' ? 'selected' : '' }}>Bodega
                            </option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-bs-dismiss="modal" style="border: none;" aria-label="Close">Cerrar</a>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="modalEditar">
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
                        <label for="Uclave" class="form-label">clave</label>
                        <input type="password" step="1" class="form-control" name="clave" id="Uclave">
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
<div class="modal fade" id="modalEliminar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEliminarTitle">Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('admin/eliminar') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="eliminarCorreo">
                    <div class="col-auto mb-3">
                        <p>¿Seguro que quieres eliminar el usuario <span id="eliminarNombre"></span>?</p>
                    </div>
                    <div class="col-12 mb-3 g-1">
                        <button class="w-100 btn btn-danger" type="submit">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
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
            await fetch("{{ url('admin/obtener') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        "correo": item.getAttribute("data-value-editar")
                    }),
                }).then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    modal_editar_title.innerText = "Edición para " + data.correo;
                    codigo.value = data.correo;
                    nombre.value = data.nombre;
                    apellido.value = data.apellido;

                    modal_editar.show();
                });
        });
    });

    const modal_eliminar = new bootstrap.Modal("#modalEliminar");
    const button_delete = document.querySelectorAll("[data-value-delete]");
    const eliminarId = document.getElementById("eliminarCorreo");
    const eliminarNombre = document.getElementById("eliminarNombre");

    [].slice.call(button_delete).forEach(async function(item) {
        item.addEventListener('click', async () => {
            await fetch("{{ url('admin/obtener') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        "correo": item.getAttribute("data-value-delete")
                    }),
                }).then((response) => response.json())
                .then((data) => {
                    eliminarId.value = data.correo;
                    eliminarNombre.innerText = data.nombre;
                    modal_eliminar.show();
                });
        });
    });
</script>
@endsection