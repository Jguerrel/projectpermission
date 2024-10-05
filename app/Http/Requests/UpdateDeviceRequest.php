<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDeviceRequest extends FormRequest
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
            'serialnumber' => ['required',Rule::unique('devices','name')->ignore($this->device)],
            'model' => 'required|string|max:250',
            'brand'=> 'required|string|max:250',
            'ram'=> 'required|string|max:250',
            'OS'=> 'required|string|max:250',
            'typedevice_id' => 'required|exists:typedevices,id',
            'branch_id' => 'required|exists:branches,id',
            'branch_office_id' => 'required|exists:branch_offices,id',
            'employee_id' => 'required|exists:employees,id',
            'disktype_id' => 'required|exists:disktypes,id',
            'ipaddress_id' => 'required|exists:ipaddresses,id'
            

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
