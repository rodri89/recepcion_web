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
            'nombre' => 'min:1|max:250|required|string|unique:eventos,eve_descripcion',
            'localidad' => 'date',
            'telefono' => 'min:1|max:250|required|string',
        ];
    }

    public function messages()
    {
        return [
            'descripcion.min' => 'El campo Descripcion debe ser significativo.',
            'descripcion.max' => 'El campo Descripcion debe contener menos caracteres.',
            'descripcion.required' => 'El campo Descripcion es obligatorio.',
            'descripcion.unique' => 'Ya existe un evento con la misma Descrpcion.',

            'fecha.date' => 'Debe ingresar una fecha valida.',

            'lugar.max' => 'El campo Lugar debe contener menos caracteres.',
            'lugar.required' => 'El campo Lugar es obligatorio.',

            'cli_dni_show.min' => '',
            'cli_dni_show.required' => 'El campo DNI Cliente es obligatorio.',
            'cli_dni_show.exists' => 'El DNI ingresado debe pertenecer a un Cliente.',

            'mesas.numeric' => 'El campo Cantidad de Mesas solo permite numeros.',

            'lugares.numeric' => 'El campo Lugares por Mesa solo permite numeros.'
        ];
    }
}
