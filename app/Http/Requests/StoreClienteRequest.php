<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|min:3|max:255',
            'correo' => 'required|email|max:255|unique:clientes,correo',
            'telefono' => 'required|regex:/^[0-9]+$/|min:10|max:10|unique:clientes,telefono',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del cliente es obligatorio.',
            'nombre.min' => 'El nombre del cliente debe tener al menos 3 caracteres.',
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'Debe ingresar un correo válido.',
            'correo.unique' => 'Este correo ya está registrado.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.unique' => 'Este teléfono ya está registrado.',
            'telefono.regex' => 'El teléfono solo puede contener números.',
            'telefono.max' => 'El teléfono no puede tener más de 10 caracteres.',
            'telefono.min' => 'El teléfono debe tener al menos 10 caracteres.',
        ];
    }
}
