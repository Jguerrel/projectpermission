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
             'serialnumber' => 'required|unique:devices,serialnumber|string|max:250',
             'carmodel_id' => 'required|exists:carmodels,id',
             'ram'=> 'required|numeric',
             'datedevicepurchase'=> 'required|date',
             'operatingsystem_id'=> 'required|exists:operatingsystems,id',
             'typedevice_id' => 'required|exists:typedevices,id',
             'brand_id' => 'required|exists:brands,id',
             'branch_office_id' => 'required|exists:branch_offices,id',
             'employee_id' => 'required|exists:employees,id',
             'disktype_id' => 'required|exists:disktypes,id',
             'microsoftoffice_id' => 'required|exists:microsoftoffices,id',
             'diskstorage_id' => 'required|exists:diskstorages,id',
             'ipaddress_id' => 'required|exists:ipaddresses,id'
        ];
    }
    public function messages()
    {
        return [

            'serialnumber.required' => 'El :attribute es obligatorio.',
            'carmodel_id.required' => 'El :attribute es obligatorio.',
            'operatingsystem_id.required' => 'El :attribute es obligatorio.',
            'serialnumber.unique' => 'El :attribute ya existe.',
            'brand_id.required' => 'La :attribute es obligatorio.',
            'branch_office_id.required' => 'La :attribute es obligatorio.',
            'employee_id.required' => 'La :attribute es obligatorio.',
            'ram.numeric' => 'El atributo :attribute debe ser un valor numerico.',
            'ram.required' => 'La :attribute es obligatorio.',
            'datedevicepurchase.required' => 'La :attribute es obligatorio.',
            'invoicepath' => "La :attribute debe ser en formato pdf, img, png.",
            'ipaddress_id' =>'La :attribute es obligatorio.',
            'typedevice_id' =>'La :attribute es obligatorio.',
            'disktype_id' =>'La :attribute es obligatorio.',
            'microsoftoffice_id' =>'La :attribute es obligatorio.',
            'diskstorage_id' =>'La :attribute es obligatorio.',
        ];


     }


    public function attributes()
        {
            return [

                'serialnumber' => 'numero de serie ',
                'operatingsystem_id' => 'sistema operativo',
                'carmodel_id' => 'modelo',
                'branch_office_id' => 'sucursal',
                'datedevicepurchase'=>'fecha de compra',
                'invoicepath'=>'factura',
                 'diskstorage_id'=>'tamaño de disco',
                 'ipaddress_id'=>'direccion ip',
                 'microsoftoffice_id'=>'office',
                 'disktype_id'=>'tipo de disco',
                 'brand_id'=>'marca',
                 'branch_office_id'=>'sucursal',
                 'operatingsystem_id'=>'sistema operativo',
                 'typedevice_id'=>'tipo de dispositivo',
                 'employee_id'=>'colaborador',
                 'disktype_id'=>'tipo de disco',
            ];
        }

}
