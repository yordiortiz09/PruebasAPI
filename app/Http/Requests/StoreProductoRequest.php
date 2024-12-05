<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'stock.required' => 'El stock del producto es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
        ];
    }
}
