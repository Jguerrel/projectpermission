<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIpaddressRequest extends FormRequest
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

            'ip'=>'required|ipv4|unique:ipaddresses,ip|string',
            'branch_office_id' => 'required|exists:branch_offices,id',
        ];
    }
    public function messages()
    {
        return [
            'ip.required' => 'El :attribute es obligatorio.',
            'branch_office_id.required' => 'El :attribute es obligatorio.',
            'ip.unique' => 'El :attribute ya existe.',
            'ip.ipv4' => 'El :attribute debe ser un ip valido.',
        ];

    }

      public function attributes()
        {
            return [
                'ip' => 'IP',
                'branch_office_id' => 'Sucursal',

            ];
        }

}
