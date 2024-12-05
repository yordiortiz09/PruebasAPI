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
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255|unique:clientes,correo',
            'telefono' => 'required|string|max:15',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del cliente es obligatorio.',
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'Debe ingresar un correo válido.',
            'correo.unique' => 'Este correo ya está registrado.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.max' => 'El teléfono no puede tener más de 15 caracteres.',
        ];
    }
}
