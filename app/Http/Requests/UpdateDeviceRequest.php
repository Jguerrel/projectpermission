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
            'serialnumber' => ['required',Rule::unique('devices','serialnumber')->ignore($this->device)],
            'ram'=> 'required|numeric',
            'operatingsystem_id'=> 'required|exists:operatingsystems,id',
            'typedevice_id' => 'required|exists:typedevices,id',
            'branch_id' => 'required|exists:branches,id',
            'branch_office_id' => 'required|exists:branch_offices,id',
            'employee_id' => 'required|exists:employees,id',
            'disktype_id' => 'required|exists:disktypes,id',
            'ipaddress_id' => 'required|exists:ipaddresses,id',
            'diskstorage_id' => 'required|exists:diskstorages,id',
            'carmodel_id' => 'required|exists:carmodels,id',
            'brand_id' => 'required|exists:brands,id'


        ];


    }

    public function messages()
    {
        return [
            'serialnumber.required' => 'El :attribute es obligatorio.',
            'carmodel_id.required' => 'El :attribute es obligatorio.',
            'ram.numeric' => 'El atributo :attribute debe ser un valor numerico.',
            'brand_id.required' => 'El :attribute es obligatorio.',
            'operatingsystem_id.required' => 'El :attribute es obligatorio.',

        ];

    }
    public function attributes()
    {
        return [

            'serialnumber' => 'numero de serie ',
            'operatingsystem_id' => 'sistema operativo',
            'carmodel_id' => 'modelo',
            'branch_office_id' => 'sucursal',

        ];
    }
}
