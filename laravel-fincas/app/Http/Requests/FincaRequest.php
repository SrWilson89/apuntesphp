<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para validación de datos de Finca
 * 
 * Centraliza las reglas de validación para crear y actualizar fincas.
 */
class FincaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Ajustar según lógica de autorización
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => [
                'required',
                'string',
                'max:200'
            ],
            'direccion' => [
                'required',
                'string',
                'max:500'
            ],
            'codigo_postal' => [
                'required',
                'string',
                'max:10',
                'regex:/^[0-9]{5}$/' // Formato español de 5 dígitos
            ],
            'ciudad' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\-\']+$/'
            ],
            'provincia' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\-\']+$/'
            ],
            'propietario_id' => [
                'nullable',
                'integer',
                'exists:propietarios,id'
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la finca es obligatorio.',
            'direccion.required' => 'La dirección es obligatoria.',
            'codigo_postal.required' => 'El código postal es obligatorio.',
            'codigo_postal.regex' => 'El código postal debe tener 5 dígitos.',
            'ciudad.required' => 'La ciudad es obligatoria.',
            'ciudad.regex' => 'La ciudad solo puede contener letras, espacios y guiones.',
            'provincia.required' => 'La provincia es obligatoria.',
            'provincia.regex' => 'La provincia solo puede contener letras, espacios y guiones.',
            'propietario_id.exists' => 'El propietario seleccionado no existe.',
        ];
    }
}
