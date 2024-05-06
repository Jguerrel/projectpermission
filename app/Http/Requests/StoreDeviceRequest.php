<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeviceRequest extends FormRequest
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
            'typedevice_id' => 'required|exists:typedevices,id',
            'branch_id' => 'required|exists:branches,id',
            'branch_office_id' => 'required|exists:branch_offices,id',
            'employee_id' => 'required|exists:employees,id',
            'disktype_id' => 'required|exists:disktypes,id'
        ];
    }

    
}
