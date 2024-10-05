<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBranchOfficeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

 
    public function rules(): array
    {
        return [

            'name'=>['required',Rule::unique('branch_offices','name')->ignore($this->branchoffice)] 
        ];
    }

    public function messages()
    {
        return [

            'name.required' => 'El :attribute es obligatorio.',
            'name.unique' => 'La :attribute ya existe.'

        ];


    }

    public function attributes()
        {
            return [

                'name' => 'sucursal '

            ];
        }

}
