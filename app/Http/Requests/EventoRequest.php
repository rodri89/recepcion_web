<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
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
            'descripcion' => 'min:1|max:250|required|string|unique:eventos,eve_descripcion',
            'fecha' => 'date',
            'lugar' => 'min:1|max:250|required|string',
            'cli_dni' => 'numeric|exists:clientes,cli_dni|required',
            'mesas' => 'numeric',
            'lugares' => 'numeric'
        ];
    }

    public function messages()
    {
        return [
            'descripcion.min' => 'Este campo debe ser significativo.',
            'descripcion.max' => 'Este campo debe contener menos caracteres.',
            'descripcion.required' => 'Este campo es obligatorio.',
            'descripcion.unique' => 'Ya existe un evento con la misma Descrpcion.',

            'fecha.date' => 'Debe ingresar una fecha valida.',

            'lugar.max' => 'Este campo debe contener menos caracteres.',
            'lugar.required' => 'Este campo es obligatorio.',

            'cli_dni_show.min' => '',
            'cli_dni_show.required' => 'Este campo es obligatorio.',
            'cli_dni_show.exists' => 'El DNI ingresado debe pertenecer a un Cliente.',
			'cli_dni_show.numeric' => 'Este campo solo se permiten numeros.',

            'mesas.numeric' => 'Este campo solo permite numeros.',

            'lugares.numeric' => 'Este campo solo permite numeros.'
        ];
    }
}
