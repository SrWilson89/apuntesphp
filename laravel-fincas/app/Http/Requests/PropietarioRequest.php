<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Form Request para validación de datos de Propietario
 * 
 * Centraliza las reglas de validación para crear y actualizar propietarios,
 * siguiendo el principio de responsabilidad única.
 */
class PropietarioRequest extends FormRequest
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
        $propietarioId = $this->route('propietario')?->id;

        return [
            'nombre' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'apellidos' => [
                'required',
                'string',
                'max:150',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                Rule::unique('propietarios', 'email')->ignore($propietarioId)
            ],
            'telefono' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[+]?[0-9\s\-$$$$]+$/'
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'apellidos.regex' => 'Los apellidos solo pueden contener letras y espacios.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El formato del email no es válido.',
            'email.unique' => 'Este email ya está registrado.',
            'telefono.regex' => 'El formato del teléfono no es válido.',
        ];
    }
}
