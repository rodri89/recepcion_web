<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'dni' => 'numeric|required|unique:clientes,cli_dni',
            'nombre' => 'string|max:30|required',
            'apellido' => 'string|max:30|required',
            'telefono' => 'numeric|required',
            'email' => 'string|max:50|required|unique:users,email|email'
        ];
    }

    public function messages()
    {
        return [
            'dni.max' => 'Este campo debe contener menos caracteres.',
            'dni.required' => 'Este campo es obligatorio.',
            'dni.unique' => 'Ya existe un cliente con el mismo DNI.',
            'dni.numeric' => 'Este campo solo puede contener numeros.',

            'nombre.max' => 'Este campo debe contener menos caracteres.',
            'nombre.required' => 'Este campo es obligatorio.',
        
            'apellido.max' => 'Este campo debe contener menos caracteres.',
            'apellido.required' => 'Este campo es obligatorio.',

            'telefono.numeric' => 'Este campo solo puede contener numeros.',
            'telefono.required' => 'Este campo es obligatorio.',
			
			'email.unique' => 'Ya existe un cliente con el mismo Mail.',
			'email.email' => 'El formato no es el correcto.',
			'email.max' => 'No debe contener tantos caracteres.',
        ];
    }

}
