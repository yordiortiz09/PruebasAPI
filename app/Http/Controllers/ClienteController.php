<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(StoreClienteRequest $request)
    {
        $cliente = Cliente::create($request->validated());

        if ($request->isMethod('post') && $request->wantsJson() === false) {
            return redirect()->route('clientes.index')->with('success', 'Cliente creado con éxito.');
        }

        return response()->json($cliente, 201);
    }

    public function show(Cliente $cliente)
    {
        return response()->json($cliente);
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        $cliente->update($request->validated());

        if ($request->isMethod('put') && $request->wantsJson() === false) {
            return redirect()->route('clientes.index')->with('success', 'Cliente actualizado con éxito.');
        }

        return response()->json($cliente);
    }

    public function destroy(Request $request, Cliente $cliente)
    {
        $cliente->delete();

        if ($request->isMethod('delete') && $request->wantsJson() === false) {
            return redirect()->route('clientes.index')->with('success', 'Cliente eliminado con éxito.');
        }

        return response()->noContent();
    }
}
