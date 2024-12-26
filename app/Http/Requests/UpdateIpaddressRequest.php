<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateIpaddressRequest extends FormRequest
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
            'ip' => [
                'required',
                'ip', // Valida que sea una dirección IP válida
                Rule::unique('ipaddresses')->where(function ($query) {
                    return $query->where('branch_office_id', $this->branch_office_id);
                })->ignore($this->route('ipaddress')),
            ],
            'branch_office_id' => 'required|exists:branch_offices,id',
        ];
    }
    public function messages()
    {
        return [
            'ip.required' => 'El :attribute es obligatorio.',
            'ip.unique' => 'La combinacion de IP y Oficina ya existe.',
            'ip.ipv4' => 'El :attribute debe ser un ip valido.',
            'branch_office_id.exists' => 'El :attribute es obligatorio.',
            'branch_office_id.required' => 'El :attribute es obligatorio.'
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
