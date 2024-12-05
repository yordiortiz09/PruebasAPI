@extends('layout')

@section('title', 'Editar Cliente')

@section('content')
    <h1>Editar Cliente</h1>

    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- Campo para el nombre --}}
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input
                type="text"
                name="nombre"
                class="form-control @error('nombre') is-invalid @enderror"
                value="{{ old('nombre', $cliente->nombre) }}"
                placeholder="Ingresa el nombre"
                required>
            {{-- Mostrar errores específicos del campo --}}
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo para el correo --}}
        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico</label>
            <input
                type="email"
                name="correo"
                class="form-control @error('correo') is-invalid @enderror"
                value="{{ old('correo', $cliente->correo) }}"
                placeholder="Ingresa el correo"
                required>
            {{-- Mostrar errores específicos del campo --}}
            @error('correo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo para el teléfono --}}
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input
                type="text"
                name="telefono"
                class="form-control @error('telefono') is-invalid @enderror"
                value="{{ old('telefono', $cliente->telefono) }}"
                placeholder="Ingresa el teléfono"
                required>
            {{-- Mostrar errores específicos del campo --}}
            @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Botón para actualizar --}}
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
