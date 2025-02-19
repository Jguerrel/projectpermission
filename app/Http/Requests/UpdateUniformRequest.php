<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateUniformRequest extends FormRequest
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
            'name' => ['required',Rule::unique('uniforms','name')->ignore($this->uniform)],
            'levels.*.size' => 'required|string|max:150',
            'levels.*.existence' => 'required|integer|min:0',
            'levels.*.departure' => 'required|integer|min:0',
            'levels.*.stock' => 'required|integer|min:0',
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
