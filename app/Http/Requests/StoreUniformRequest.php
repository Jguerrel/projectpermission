<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUniformRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'uniformlevels.*.size' => 'required|string|max:150',
            'uniformlevels.*.existence' => 'required|integer|min:0',
            'uniformlevels.*.departure' => 'required|integer|min:0',
            'uniformlevels.*.stock' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [

            'name.required' => 'El :attribute es obligatorio.',

        ];


    }

    public function attributes()
    {
        return [
            'name' => 'producto ',

        ];
    }
}
