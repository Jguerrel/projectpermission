<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompaniaRequest extends FormRequest
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
            'ciacod'=>'required|string',
            'name'=>'required|string',
        ];
    }

    public function messages()
    {
        return [
            'ciacod.required' => 'El :attribute es obligatorio.',
            'name.required' => 'El :attribute es obligatorio.',
        ];


    }

    public function attributes()
        {
            return [
                'ciacod' => 'codigo',
                'name' => 'nombre ',
            ];
        }
}
