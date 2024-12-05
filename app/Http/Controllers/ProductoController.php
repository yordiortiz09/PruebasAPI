<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(StoreProductoRequest $request)
    {
        $producto = Producto::create($request->validated());

        if ($request->isMethod('post') && $request->wantsJson() === false) {
            return redirect()->route('productos.index')->with('success', 'Producto creado con éxito.');
        }

        return response()->json($producto, 201);
    }

    public function show(Producto $producto)
    {
        return response()->json($producto);
    }

    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $producto->update($request->validated());

        if ($request->isMethod('put') && $request->wantsJson() === false) {
            return redirect()->route('productos.index')->with('success', 'Producto actualizado con éxito.');
        }

        return response()->json($producto);
    }

    public function destroy(Request $request, Producto $producto)
    {
        $producto->delete();

        if ($request->isMethod('delete') && $request->wantsJson() === false) {
            return redirect()->route('productos.index')->with('success', 'Producto eliminado con éxito.');
        }

        return response()->noContent();
    }
}
