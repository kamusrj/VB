@extends('layouts.master')

@section('title', 'Venta Directa')

@section('content')

    <div class="d-flex w-100" style="height:60vh;">
        <div class="m-auto">
            <div class="card shadow">
                <div class="card-body" style="width: 420px;">
                    <h2>Iniciar Sesión</h2>
                    <form action="{{ url('iniciar') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="username">Nombre de Usuario:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-success">Iniciar Sesión</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
