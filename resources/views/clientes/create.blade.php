@extends('layout')

@section('title', 'Crear Cliente')

@section('content')
    <h1>Crear Cliente</h1>

    {{-- Mostrar mensajes generales de error --}}
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf
        {{-- Campo para el nombre --}}
        <div class="mb-3">
            <label for="nombre-cliente" class="form-label">Nombre</label>
            <input
                type="text"
                id="nombre-cliente"
                name="nombre"
                class="form-control @error('nombre') is-invalid @enderror"
                value="{{ old('nombre') }}"
                placeholder="Ingresa el nombre"
                required>
            {{-- Mostrar errores específicos del campo --}}
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo para el correo --}}
        <div class="mb-3">
            <label for="correo-cliente" class="form-label">Correo Electrónico</label>
            <input
                type="email"
                id="correo-cliente"
                name="correo"
                class="form-control @error('correo') is-invalid @enderror"
                value="{{ old('correo') }}"
                placeholder="Ingresa el correo"
                required>
            {{-- Mostrar errores específicos del campo --}}
            @error('correo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo para el teléfono --}}
        <div class="mb-3">
            <label for="telefono-cliente" class="form-label">Teléfono</label>
            <input
                type="text"
                id="telefono-cliente"
                name="telefono"
                class="form-control @error('telefono') is-invalid @enderror"
                value="{{ old('telefono') }}"
                placeholder="Ingresa el teléfono"
                required>
            {{-- Mostrar errores específicos del campo --}}
            @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Botón para guardar --}}
        <button type="submit" id="btn-guardar-cliente" class="btn btn-primary">Guardar</button>
    </form>
@endsection
