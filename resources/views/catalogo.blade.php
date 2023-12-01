@extends('layouts.master')

@section('title', 'Calatogo')

@section('content')


    <div class="container">

        <div class="row">
            <div class="col">
                <h2> <i class="fas fa-book"></i> Catalogo de libros </h2><br>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        @if (in_array(auth()->user()->rol, ['a', 'g', 'c']))
                            <button type="button" class="btn btn-primary" style="background-color: #34ac54; border: none;"
                                data-bs-toggle="modal" data-bs-target="#modalCrear">
                                Nuevo Libro
                            </button><br><br>
                        @endif
                        <thead>
                            <tr>
                                <th>Cod.</th>
                                <th>Nombre</th>
                                <th>Editorial</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nombre }}</td>

                                    <td>
                                        @if ($item->editorial === 'ed')
                                            Edisal
                                        @elseif ($item->editorial === 'mdf')
                                            Montañas de fuego
                                        @elseif ($item->editorial === 'eng')
                                            Ingles
                                        @elseif ($item->editorial === 'info')
                                            Informatica
                                        @endif
                                    </td>
                                    <td>{{ $item->descripcion }}</td>
                                    <td>
                                        @if (in_array(auth()->user()->rol, ['a', 'g', 'c']))
                                            <button type="button" class="btn btn-danger"
                                                data-value-delete="{{ $item->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning"
                                                data-value-editar="{{ $item->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $user->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #563d7c !important;">
                    <h6 class="modal-title" style="color: #fff; text-align: center;">
                        Crear Libro
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="userForm" action="{{ url('libro/crear') }}" method="POST">
                    @csrf
                    <div class="modal-body" id="cont_modal">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="editorial">Editorial:</label>
                            <select name="editorial" id="editorial" class="form-control" require>
                                <option value="" {{ old('editorial') == '' ? 'selected' : '' }}>-- Selecciona una
                                    editorial --</option>
                                <option value="ed" {{ old('editorial') == 'par' ? 'selected' : '' }}>Edisal</option>
                                <option value="mdf" {{ old('editorial') == 'pri' ? 'selected' : '' }}>Montañas de
                                    fuego</option>
                                <option value="eng" {{ old('editorial') == 'seg' ? 'selected' : '' }}>Ingles
                                </option>
                                <option value="info" {{ old('editorial') == 'terc' ? 'selected' : '' }}>Informatica
                                </option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" id="descripcion" name="descripcion" required class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-bs-dismiss="modal" style="border: none;"
                            aria-label="Close">Cerrar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modificar -->
    <div class="modal fade" id="modalEditar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditarTitle">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('libro/actualizar') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="Uid">
                        <div class="col-auto mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="Unombre" name="nombre">
                        </div>

                        <div class="col-auto mb-3">
                            <label for="Ueditorial">Editorial:</label>
                            <select name="editorial" id="Ueditorial" class="form-control">
                                <option value="">-- Selecciona una editorial --</option>
                                <option value="ed" {{ $item->editorial == 'ed' ? 'selected' : '' }}>Edisal
                                </option>
                                <option value="mdf" {{ $item->editorial == 'mdf' ? 'selected' : '' }}>Montañas de
                                    fuego</option>
                                <option value="eng" {{ $item->editorial == 'eng' ? 'selected' : '' }}>Ingles
                                </option>
                                <option value="info" {{ $item->editorial == 'info' ? 'selected' : '' }}>Informatica
                                </option>

                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" name="descripcion" id="Udescripcion" class="form-control"
                                cols="30" rows="10"></input>
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
    <div class="modal fade" id="modalEliminar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEliminarTitle">¡Advertencia!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('libro/eliminar') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="eliminarId">
                        <div class="col-auto mb-3">
                            <p>¿Seguro que quieres eliminar el libro <b id="eliminarNombre"></b>?</p>
                        </div>
                        <div class="col-12 mb-3 g-1">
                            <button class="w-100 btn btn-danger" type="submit">Si, Eliminar</button>
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
        const codigo = document.getElementById("Uid");
        const enombre = document.getElementById("Unombre");
        const eeditorial = document.getElementById("Ueditorial");
        const edescripcion = document.getElementById("Udescripcion");
        //  modal_editar_component.addEventListener("hidden.bs.modal", () => {
        //     document.location.href = "l/ ";
        //  });
        [].slice.call(button_editar).forEach(async function(item) {
            item.addEventListener('click', async () => {
                await fetch("{{ url('libro/obtener') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            "id": item.getAttribute("data-value-editar")
                        }),
                    }).then((response) => response.json())
                    .then((data) => {
                        modal_editar_title.innerText = "Edición para " + data.nombre;
                        codigo.value = data.id;
                        enombre.value = data.nombre;
                        eeditorial.value = data.editorial;
                        edescripcion.value = data.descripcion;
                        modal_editar.show();
                    });
            });
        });

        const modal_eliminar = new bootstrap.Modal("#modalEliminar");
        const button_eliminar = document.querySelectorAll("[data-value-delete]");
        const eliminarId = document.getElementById("eliminarId");
        const eliminarNombre = document.getElementById("eliminarNombre");

        [].slice.call(button_eliminar).forEach(async function(item) {
            item.addEventListener('click', async () => {
                await fetch("{{ url('libro/obtener') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            "id": item.getAttribute("data-value-delete")
                        }),
                    }).then((response) => response.json())
                    .then((data) => {
                        eliminarId.value = data.id;
                        eliminarNombre.innerText = data.nombre;
                        modal_eliminar.show();
                    });
            });
        });
    </script>
@endsection
