<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTypeDeviceRequest extends FormRequest
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
            'name' => ['required',Rule::unique('typedevices','name')->ignore($this->typedevice)],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'name.unique' => 'Este :attribute ya existe'
        ];


    }

    public function attributes()
        {
            return [
                'name' => 'tipo de dispositivo ',
            ];
        }
}
