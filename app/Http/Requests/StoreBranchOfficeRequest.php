<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranchOfficeRequest extends FormRequest
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

            'name'=>'required|unique:branch_offices,name|string',
            
        ];
    }

    public function messages()
    {
        return [

            'name.required' => 'El :attribute es obligatorio.',
            'name.unique' => 'La :attribute ya existe.',
            
        ];


    }

    public function attributes()
        {
            return [

                'name' => 'sucursal ',
                'status' => 'estado ',
            ];
        }

}
