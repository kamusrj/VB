<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Catalogo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <a href="{{ url('/') }}" class="btn btn-dark"> <i class="fas fa-arrow-left"></i></a>
    <a href="{{ url('/salir') }}" class="btn btn-danger"> <i class="fas fa-sign-out-alt"></i></a>
    @if (Auth::check())
    {{ Auth::user()->nombre }} {{ Auth::user()->apellido}}
    @endif

    <div class="container"><br><br><br>
        @include('errorMj')
        <h2> <i class="fas fa-book"></i> Catalogo de libros </h2><br>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                @if(in_array(auth()->user()->rol, ['a', 'g', 'c']))
                <button type="button" class="btn btn-primary" style="background-color: #34ac54; border: none;" data-bs-toggle="modal" data-bs-target="#modalCrear">
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
                    @foreach ( $user as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nombre }}</td>

                        <td> @if ($item->editorial === 'ed')
                            Edisal
                            @elseif ($item->editorial === 'mdf')
                            Montañas de fuego
                            @elseif ($item->editorial === 'eng')
                            Ingles
                            @elseif ($item->editorial === 'info')
                            Informatica
                            @endif</td>
                        <td>{{ $item->descripcion }}</td>
                        <td>
                            @if (in_array(auth()->user()->rol, ['a', 'g', 'c']))
                            <button type="button" class="btn btn-danger" data-value-delete="{{ $item->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button type="button" class="btn btn-warning" data-value-editar="{{ $item->id }}">
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
        <!-----------------    Modal Crear       --------------------------->
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
                                <label for="ciclo">Editorial:</label>
                                <select name="editorial" id="editorial" class="form-control" require>
                                    <option value="" {{ old('editorial') == '' ? 'selected' : '' }}>-- Selecciona una editorial --</option>
                                    <option value="ed" {{ old('editorial') == 'par' ? 'selected' : '' }}>Edisal</option>
                                    <option value="mdf" {{ old('editorial') == 'pri' ? 'selected' : '' }}>Montañas de fuego</option>
                                    <option value="eng" {{ old('editorial') == 'seg' ? 'selected' : '' }}>Ingles</option>
                                    <option value="info" {{ old('editorial') == 'terc' ? 'selected' : '' }}>Informatica</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Descripción</label>
                                <input type="text" id="descripcion" name="descripcion" required class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-secondary" data-bs-dismiss="modal" style="border: none;" aria-label="Close">Cerrar</a>
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
                        <form action="{{ url('libro/update') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" id="Uid">
                            <div class="col-auto mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="Unombre" name="nombre">
                            </div>

                            <div class="col-auto mb-3">
                                <label for="ciclo">Editorial:</label>
                                <select name="editorial" id="Ueditorial" class="form-control">
                                    <option value="">-- Selecciona una editorial --</option>
                                    <option value="ed" {{ $item->editorial == 'ed' ? 'selected' : '' }}>Edisal</option>
                                    <option value="mdf" {{ $item->editorial == 'mdf' ? 'selected' : '' }}>Montañas de fuego</option>
                                    <option value="eng" {{ $item->editorial == 'eng' ? 'selected' : '' }}>Ingles</option>
                                    <option value="info" {{ $item->editorial == 'info' ? 'selected' : '' }}>Informatica</option>

                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" name="descripcion" id="Udescripcion" class="form-control" cols="30" rows="10"></input>
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
                        <form action="{{ url('libro/delete') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" id="deleteId">
                            <div class="col-auto mb-3">
                                <label for="deleteNombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="deleteNombre" name="nombre" disabled>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
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
                await fetch("{{ url('libro/up') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            "id": item.getAttribute("data-value-editar")
                        }),
                    }).then((response) => response.json())
                    .then((data) => {
                        modal_editar_title.innerText = "Edición para " + data[0].nombre;
                        codigo.value = data[0].id;
                        enombre.value = data[0].nombre;
                        eeditorial.value = data[0].editorial;
                        edescripcion.value = data[0].descripcion;
                        modal_editar.show();
                    });
            });
        });
    </script>

    <script>
        const modal_delete = new bootstrap.Modal("#modalDelete");
        const button_delete = document.querySelectorAll("[data-value-delete]");
        const deleteId = document.getElementById("deleteId");
        const deleteNombre = document.getElementById("deleteNombre");

        [].slice.call(button_delete).forEach(async function(item) {
            item.addEventListener('click', async () => {
                await fetch("{{ url('libro/up') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            "id": item.getAttribute("data-value-delete")
                        }),
                    }).then((response) => response.json())
                    .then((data) => {
                        deleteId.value = data[0].id;
                        deleteNombre.value = data[0].nombre;
                        modal_delete.show();
                    });
            });
        });
    </script>






</body>

</html>