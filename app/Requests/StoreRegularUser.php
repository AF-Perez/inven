<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegularUser extends FormRequest
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
     * Obtiene reglas de validación aplicadas a la petición.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            // 'roles' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'cedula' => [
                'required',
                // TODO: realizar una validación más robusta de la cédula, (cálculo del último digito)
                // 'regex:/^(0[1-9]|1[0-9]|2[0-4]|30)[0-6][0-9]{7}([0-9][0-9][0-9])?$/',
            ],
            // 'cargo' => 'required',
            // 'area' => 'required',
            // 'institucion_id' => 'required',
        ];
    }
}
