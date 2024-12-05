@extends('layout')

@section('title', 'Crear Cliente')

@section('content')
    <h1>Crear Cliente</h1>
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Ingresa el nombre" required>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico</label>
            <input type="email" name="correo" class="form-control" placeholder="Ingresa el correo" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" placeholder="Ingresa el teléfono" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection
