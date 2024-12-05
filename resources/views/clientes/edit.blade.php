@extends('layout')

@section('title', 'Editar Cliente')

@section('content')
    <h1>Editar Cliente</h1>
    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $cliente->nombre }}" placeholder="Ingresa el nombre" required>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico</label>
            <input type="email" name="correo" class="form-control" value="{{ $cliente->correo }}" placeholder="Ingresa el correo" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ $cliente->telefono }}" placeholder="Ingresa el teléfono" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
