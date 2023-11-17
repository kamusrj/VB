@extends('layouts.master')
@section('title', 'Libros')
@section('content')


<div class="container">
    <br>
    <form action="{{ url('venta/inventario/') }}" method="post">
        @csrf
        @include('errorMj')

        <div class="form-group">
            <label for="Primaria"></label>
            <input type="hidden" name="id_venta" style="background-color: #f6f6f6;" class="form-control" id="id_venta" value="{{$tituloVenta->id}}" readonly>
        </div>
        <div class="form-group">
            <label for="Primaria">Institución: {{$tituloVenta->institucion}}</label>

        </div>

        <label for="">
            <h4>Edisal</h4>
        </label>
        <div class="row" style="max-height: 30vh;overflow: auto; border-style: groove; border-color:#e3e4e5; border-width: 8px; background-color:white">
            <div class="row">
                @foreach($libro as $l)
                @if($l['editorial'] ==='ed')
                <div class="col-md-3">
                    <input class="form-check-input" type="checkbox" name="libros_seleccionados[]" value="{{ $l->id }}">
                    <label class="form-check-label">
                        {{ $l->nombre }}
                    </label>
                </div>
                @endif
                @endforeach
            </div>
        </div><br>
        <label for="">
            <h4>Montañas de fuego</h4>
        </label>
        <div class="row" style="max-height: 30vh;overflow: auto; border-style: groove; border-color:#e3e4e5; border-width: 8px; background-color:white">
            <div class="row">
                @foreach($libro as $l)
                @if($l['editorial'] ==='mdf')
                <div class="col-md-3">
                    <input class="form-check-input" type="checkbox" name="libros_seleccionados[]" value="{{ $l->id }}">
                    <label class="form-check-label">
                        {{ $l->nombre }}
                    </label>
                </div>
                @endif
                @endforeach
            </div>
        </div><br>
        <h4>Ingles</h4>
        <div class="row" style="max-height: 30vh;overflow: auto; border-style: groove; border-color:#e3e4e5; border-width: 8px; background-color:white">
            <div class="row">
                @foreach($libro as $l)
                @if($l['editorial'] ==='eng')
                <div class="col-md-3">
                    <input class="form-check-input" type="checkbox" name="libros_seleccionados[]" value="{{ $l->id }}">
                    <label class="form-check-label">
                        {{ $l->nombre }}
                    </label>
                </div>
                @endif
                @endforeach
            </div>
        </div><br>
        <h4>Informatica</h4>
        <div class="row" style="max-height: 30vh;overflow: auto; border-style: groove; border-color:#e3e4e5; border-width: 8px; background-color:white">
            <div class="row">
                @foreach($libro as $l)
                @if($l['editorial'] ==='info')
                <div class="col-md-3">
                    <input class="form-check-input" type="checkbox" name="libros_seleccionados[]" value="{{ $l->id }}">
                    <label class="form-check-label">
                        {{ $l->nombre }}
                    </label>
                </div>
                @endif
                @endforeach
            </div>
        </div><br>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Enviar Libros Seleccionados</button>
        </div>
</div>
</div>
</div><br><br><br>
@endsection
@section('script')

<script>
    async function guardarLibro() {
        const libros_selected = document.querySelectorAll("[data-value-select]");
        var dataLibros = [];

        [].slice.call(libros_selected).forEach(element => {
            if (element.checked) {
                dataLibros.push(element.getAttribute("data-value-select"));
            }
        });

        if (dataLibros.length === 0) {
            return;
        }

        try {
            const response = await fetch("{{ url('panel/inventario') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    libros: dataLibros
                }),
            });

            if (!response.ok) {
                throw new Error('Error en la solicitud.');
            }

            const data = await response.json();
            document.location.href = data;
        } catch (error) {
            console.error('Error:', error);

        }
    }
</script>
@endsection