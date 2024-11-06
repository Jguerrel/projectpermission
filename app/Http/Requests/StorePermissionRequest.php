<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
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
            'name'=>'required|unique:permissions,name|string',
            'guard_name'=>'required|string',
        ];
    }
    public function messages()
    {
      return [
            'name.required' => 'El :attribute es obligatorio.',
            'guard_name.required' => 'El :attribute es obligatorio.',
            'name.unique'=> 'El :attribute ya existe.'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'permiso',
            'guard_name' => 'guard name ',
        ];
    }
}
