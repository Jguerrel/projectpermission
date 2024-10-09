<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateModelRequest extends FormRequest
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
            'name' => ['required',Rule::unique('brands','name')->ignore($this->brand)],
            'brand_id' => 'required|exists:brands,id'
            

        ];

     
    }

    public function messages()
    {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'brand_id.required' => 'La :attribute es obligatorio.',
            
    
        ];

    }
    public function attributes()
    {
        return [
            'name' => 'modelo ',
            'brand_id' => 'marca ',
        ];
    }
}
