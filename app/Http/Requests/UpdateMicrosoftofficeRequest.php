<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateMicrosoftofficeRequest extends FormRequest
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
            'name' => ['required',Rule::unique('microsoftoffice','name')->ignore($this->microsoftoffice)]

        ];
    }
    public function messages()
    {
        return [

            'name.required' => 'El :attribute es obligatorio.',
            'name.unique' => 'El :attribute ya existe.',
        ];

    }

    public function attributes()
    {
        return [
            'name' => 'Office ',
        ];
    }
}
