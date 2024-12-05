@extends('layout')

@section('title', 'Lista de Productos')

@section('content')
    <h1>Lista de Productos</h1>
    <a href="{{ route('productos.create') }}" id="btn-crear-producto" class="btn btn-primary mb-3">Crear Producto</a>

    @if ($productos->isEmpty())
        <div class="alert alert-info" id="no-productos-msg">
            No hay productos registrados actualmente.
        </div>
    @else
        <table class="table table-bordered" id="tabla-productos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr id="producto-{{ $producto->id }}">
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->precio }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>
                            <a href="{{ route('productos.edit', $producto->id) }}" id="btn-editar-{{ $producto->id }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="btn-eliminar-{{ $producto->id }}" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
