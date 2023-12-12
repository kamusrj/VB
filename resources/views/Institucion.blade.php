@extends('layouts.master')

@section('title', 'Instituciones')

@section('content')
<div class="container">

    <div class="row">
        <div class="col my-3">
            <a href="{{ url('/') }}" class="btn btn-dark"> <i class="fas fa-arrow-left"></i></a>

        </div>
    </div>

    @include('errorMj')
    <h2> <i class="fas fa-school"></i> Instituciones </h2><br>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            @if (in_array(auth()->user()->rol, ['a', 'g', 'c']))
            <button type="button" class="btn btn-primary" style="background-color: #34ac54; border: none;" data-bs-toggle="modal" data-bs-target="#modalCrear">
                Nueva Institucion
            </button><br><br>
            @endif
            <thead>
                <tr>
                    <th>Cod.</th>
                    <th>Nombre</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($instituciones as $item)
                <tr>
                    <td>{{ $item->codigo }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td>
                        @if (in_array(auth()->user()->rol, ['a', 'g', 'c']))

                        @if ($item->codigo != '00001')


                        <div class="btn-group" role="group" aria-label="Basic example">
                            @if ($item->estado === 'off')
                            <button type="button" class="btn btn-danger" data-value-delete="{{ $item->codigo }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endif

                            @endif


                            <button type="button" class="btn btn-primary" data-value-editar="{{ $item->codigo }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            @if ($item->estado === 'off')
                            <a href="{{ url('venta/nueva/' . $item->codigo) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Nueva venta">
                                <i class="fa-regular fa-calendar-plus"></i>
                            </a>
                            @endif
                            @if ($item->estado === 'on')
                            <a href="{{ url('institucion/salir') }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Ver venta">
                                <i class="fa-solid fa-truck fa-xl"></i>
                            </a>
                            @endif
                            @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="modalCrear">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #563d7c !important;">
                <h6 class="modal-title" style="color: #fff; text-align: center;">
                    Crear Institución
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body" id="cont_modal">
                <form id="userForm" action="{{ url('institucion/crear') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="codigo">Codigo:</label>
                        <input type="text" id="codigo" name="codigo" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required class="form-control">
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-bs-dismiss="modal" style="border: none;" aria-label="Close">Cerrar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
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
                <form action="{{ url('institucion/actualizar') }}" method="post">
                    @csrf
                    <input type="hidden" name="codigo" id="Ucodigo">
                    <div class="col-auto mb-3">
                        <label for="Unombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="Unombre" name="nombre">
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
                <h1 class="modal-title fs-5" id="modalEliminarTitle">Eliminar instituci&oacute;n</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('institucion/eliminar') }}" method="post">
                    @csrf
                    <input type="hidden" name="codigo" id="eliminarId">
                    <div class="col-auto mb-3">
                        <p>¿Seguro que quieres eliminar la instituci&oacute;n <span id="eliminarNombre"></span>?
                        </p>
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
    const codigo = document.getElementById("Ucodigo");
    const nombre = document.getElementById("Unombre");

    //  modal_editar_component.addEventListener("hidden.bs.modal", () => {
    //     document.location.href = "l/ ";
    //  });
    [].slice.call(button_editar).forEach(async function(item) {
        item.addEventListener('click', async () => {
            await fetch("{{ url('institucion/obtener') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        "codigo": item.getAttribute("data-value-editar")
                    }),
                }).then((response) => response.json())
                .then((data) => {
                    modal_editar_title.innerText = "Edición para " + data.codigo;
                    codigo.value = data.codigo;
                    nombre.value = data.nombre;
                    modal_editar.show();
                });
        });
    });

    const modal_eliminar = new bootstrap.Modal("#modalEliminar");
    const button_delete = document.querySelectorAll("[data-value-delete]");
    const eliminarId = document.getElementById("eliminarId");
    const eliminarNombre = document.getElementById("eliminarNombre");

    [].slice.call(button_delete).forEach(async function(item) {
        item.addEventListener('click', async () => {
            await fetch("{{ url('institucion/obtener') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        "codigo": item.getAttribute("data-value-delete")
                    }),
                }).then((response) => response.json())
                .then((data) => {
                    eliminarId.value = data.codigo;
                    eliminarNombre.innerText = data.nombre;
                    modal_eliminar.show();
                });
        });
    });
</script>
@endsection