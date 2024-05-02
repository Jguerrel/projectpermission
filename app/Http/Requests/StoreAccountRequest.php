<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string',
            'password'=>'required|string',
            'link'=>'required|string',
            'description'=>'required|string',
        ];
    }
    public function messages()
    {
        return [

            'name.required' => 'El :attribute es obligatorio.',
            'password.required' => 'El :attribute es obligatorio.',
            'link.required' => 'El :attribute es obligatorio.',
            'description.required' => 'La :attribute es obligatorio.',
        ];


    }

    public function attributes()
    {
        return [

            'name' => 'nombre ',
            'password' => 'contraseña ',
            'link' => 'link ',
            'description' => 'descripcion ',
        ];
    }
}
