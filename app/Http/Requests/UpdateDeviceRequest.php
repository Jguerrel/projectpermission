<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeviceRequest extends FormRequest
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
            'serialnumber' => 'required|string|max:250',
            'model' => 'required|string|max:250',
            'brand'=> 'required|string|max:250',
            'ram'=> 'required|string|max:250',
            'OS'=> 'required|string|max:250',

        ];

     
    }

    public function messages()
    {
        return [
            'serialnumber.required' => 'El :attribute es obligatorio.',
            'model.required' => 'El :attribute es obligatorio.',
            'brand.required' => 'El :attribute es obligatorio.',
            'ram.required' => 'El :attribute es obligatorio.',
            'OS.required' => 'El :attribute es obligatorio.',
            
       

        ];

    }
}
