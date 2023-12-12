@extends('layouts.master')
@section('title', 'Libros')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col my-3">
                <form action="{{ url('venta/inventario/') }}" method="post">
                    
                    @csrf
                    <input type="number" name="id_venta" value="{{ $tituloVenta->id }}" hidden>
                    <h3>Institución: {{ $tituloVenta->institucion }}</h3>

                    <div class="row" style="min-height: 70vh;overflow: auto;">
                        <div class="row">
                            @php
                                $nombre_coleccion = '';
                            @endphp
                            @foreach ($libro as $l)
                                @if ($nombre_coleccion != $l->editorial)
                                    <hr>
                                    @php
                                        $nombre_coleccion = $l->editorial;
                                    @endphp
                                    @if ($nombre_coleccion == 'ed')
                                        <h4>Edisal</h4>
                                    @endif
                                    @if ($nombre_coleccion == 'mdf')
                                        <h4>Montañas de fuego</h4>
                                    @endif
                                    @if ($nombre_coleccion == 'eng')
                                        <h4>Ingl&eacute;s</h4>
                                    @endif
                                    @if ($nombre_coleccion == 'info')
                                        <h4>Inform&aacute;tica</h4>
                                    @endif
                                    @if ($nombre_coleccion == 'any')
                                        <h4>Otros</h4>
                                    @endif
                                @endif

                                <div class="col-md-3">
                                    <input class="form-check-input" type="checkbox" name="libros_seleccionados[]"
                                        value="{{ $l->id }}">
                                    <label class="form-check-label">
                                        {{ $l->nombre }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Enviar Libros Seleccionados</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')


@endsection
