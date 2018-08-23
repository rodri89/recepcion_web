<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\user;

class ClienteRequestUpdate extends FormRequest
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
            'dni' => 'numeric|required',
            'nombre' => 'string|max:30|required',
            'apellido' => 'string|max:30|required',
            'telefono' => 'numeric|required',
            'mail' => 'string|min:1|max:50|required|email|unique:users,email',
        ];
    }

    public function messages()
    {
        return [
            'dni.max' => 'El campo DNI debe contener menos caracteres.',
            'dni.required' => 'El campo DNI es obligatorio.',
            'dni.numeric' => 'El DNI solo puede contener numeros.',

            'nombre.max' => 'El campo Nombre debe contener menos caracteres.',
            'nombre.required' => 'El campo Nombre es obligatorio.',
        
            'apellido.max' => 'El campo Nombre debe contener menos caracteres.',
            'apellido.required' => 'El campo Nombre es obligatorio.',

            'telefono.numeric' => 'El Telefono solo puede contener numeros.',
            'telefono.required' => 'El campo Telefono es obligatorio.',
			
        ];
    }

}
