<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|unique:users,name|string|max:250',
            'email' => 'required|string|email:rfc,dns|max:250|unique:users,email,'.$this->user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required'
        ];
    }
    public function messages()
    {
        return [

            'name.required' => 'El :attribute es obligatorio.',
            'email.required' => 'El :attribute es obligatorio.',
            'password.required' => 'El :attribute es obligatorio.',
            'name.unique' => 'El :attribute ya existe.',
            'email.unique' => 'El :attribute ya existe.',


        ];


    }

    public function attributes()
        {
            return [
                'name' => 'usuario ',
                'email'=>'correo',
                'password'=>'contraseña'
            ];
        }
}
