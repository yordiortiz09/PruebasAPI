@extends('layout')

@section('title', 'Crear Producto')

@section('content')
    <h1>Crear Producto</h1>
    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        {{-- Campo para el nombre --}}
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input
                type="text"
                name="nombre"
                id="nombre-producto"
                class="form-control @error('nombre') is-invalid @enderror"
                value="{{ old('nombre') }}"
                required>
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo para el precio --}}
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input
                type="number"
                name="precio"
                id="precio-producto"
                class="form-control @error('precio') is-invalid @enderror"
                value="{{ old('precio') }}"
                step="0.01"
                required>
            @error('precio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo para el stock --}}
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input
                type="number"
                name="stock"
                id="stock-producto"
                class="form-control @error('stock') is-invalid @enderror"
                value="{{ old('stock') }}"
                required>
            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" id="btn-guardar-producto" class="btn btn-primary">Guardar</button>
    </form>
@endsection
