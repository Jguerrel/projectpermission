<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeviceRequest;
use App\Http\Requests\UpdateDeviceRequest;
use App\Models\Device;
use Illuminate\View\View;
use App\Models\Typedevice;
use App\Models\BranchOffice;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Diskstorage;
use App\Models\Employee;
use App\Models\Disktype;
use App\Models\Ipaddress;
use App\Models\Microsoftoffice;
use App\Models\OperatingSystem;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('permission:ver-dispositivos', ['only' => ['index']]);
        $this->middleware('permission:crear-dispositivos', ['only' => ['create','store']]);
        $this->middleware('permission:editar-dispositivos', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-dispositivos', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('devices.index', [
            'devices' => Device::orderBy('id','ASC')->paginate(20)
        ]);
    }

    public function pagination(Request $request)
    {
        $user = Auth()->user();

        $data=Device::with('typedevice','branch_office','employee','disktype','ipaddress','carmodel','brand','diskstorage','operatingsystem','microsoftoffice');

        if ($request->filled('sucursal')) {

            $data->whereHas('branch_office', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->sucursal . '%');  });

        }

        if($request->ajax()) {return Datatables()->of($data)
            ->editColumn('status', function(Device $device) {
                return  ' <span class="text-'. ($device->status ? 'success' : 'danger') .'">Activo</span>';
            })
	        ->addColumn('action', function (Device $device) use ($user) {

                $btn = '<form action='.route("devices.destroy",$device->id).' method="post"><input type="hidden" name="_token"  value=" '.csrf_token().' " autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Do you want to delete this user?");';

                if ($user->can('ver-dispositivos'))
                {
                   $btn  = $btn . '<a href="'.route("devices.show",$device->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar-dispositivos'))
                {
                    $btn =$btn.'<a href="'.route("devices.edit",$device->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar-dispositivos'))
                {
                    $btn =$btn.'<button type="submit" class="btn btn-danger btn-sm" onclick="'. $onclick.'"><i class="fas fa-trash"></i> Eliminar</button>';
                }

                if ($device->typedevice_id==3)
                {

                    $btn =$btn.'<a type="submit" class="btn btn-success btn-sm" href="https://'. $device->ipaddress->ip.'" target="_blank"><i class="fas fa-link"></i> Ir</a>';

                }
                if ($device->typedevice_id==1 or $device->typedevice_id==2 )
                {
                    $btn =$btn.'<a type="submit" class="btn btn-success btn-sm" href="anydesk://'. $device->anydesknumber.'"><i class="fas fa-link"></i> Anydesk</a>';
                }
                  $btn =$btn .'</form>';
                  return $btn;

            })

            ->rawColumns(['status','action'])

            ->addIndexColumn()
	        ->make(true);
	    }

    }

    public function create()
    {

        $employees = Employee::all();
        $branchoffices = BranchOffice::all();
        $typedevices = Typedevice::all();
        $disktypes = Disktype::all();
        $ipadresses = Ipaddress::all();
        $carmodels = CarModel::all();
        $diskstorages = Diskstorage::all();
        $brands = Brand::all();
        $microsoftoffices = Microsoftoffice::all();
        $operatingsystems = OperatingSystem::all();
        return view('devices.create',compact('employees','branchoffices','typedevices','disktypes','ipadresses','carmodels','diskstorages','brands','microsoftoffices','operatingsystems') );
    }

/*subida de factura en pdf, img, png */
   public function uploadinvoice(Request $request)
   {
    $request->validate([
        'file' => 'required|mimes:jpeg,jpg,png,pdf|max:2048', // Solo imagenes o PDF
    ]);

    // Verificar si el archivo fue cargado
    if ($request->hasFile('file')) {
        // Guardar el archivo en el disco 'public/uploads'
        $filePath = $request->file('file')->store('invoices', 'public');

        return response()->json(['success' => true, 'file_path' => $filePath]);
    }

    return response()->json(['success' => false, 'message' => 'No se pudo cargar el archivo.'], 400);

   }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeviceRequest $request)
    {
        $input = $request->all();
        ///$compania=Compania::findorFail($companiaid);
        if ($image = $request->file('photo')) {
            $destinationPath = 'photos/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['photo'] =$destinationPath . $postImage;
        }
        //Subir foto de factura o pdf
        if ($request->hasFile('invoicepath')) {

            $filePath = $request->file('invoicepath')->store('invoice', 'public');
            $input['invoicepath'] =$filePath;
         }
        Device::create($input);

        return redirect()->route('devices.index')
                ->withSuccess('Dispositivo ha sido creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device) : View
    {
        return view('devices.show', [
            'device' => $device
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $device = Device::with('branch_office','typedevice','disktype','employee','ipaddress','carmodel','diskstorage','brand','microsoftoffice','operatingsystem')->findOrFail($id);
        $typedevices = Typedevice::get();
        $branch_offices = BranchOffice::get();
        $employees = Employee::get();
        $disktypes = Disktype::get();
        $ipaddresses = Ipaddress::get();
        $carmodels = CarModel::all();
        $diskstorages = Diskstorage::all();
        $brands = Brand::all();
        $microsoftoffices = Microsoftoffice::all();
        $operatingsystems = OperatingSystem::all();

        return view('devices.edit',compact('device','branch_offices','typedevices','disktypes','employees','ipaddresses','carmodels','diskstorages','brands','microsoftoffices','operatingsystems'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceRequest $request, Device $device)
    {

         $input = $request->all();
        if ($image = $request->file('photo')) {
            $destinationPath = 'photos/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['photo'] =$destinationPath . $postImage;
        }
        else{
            unset($input['photo']);
        }
;
        $device->update($input);

        return redirect()->route('devices.index')
                ->withSuccess('Dispositivo ha sido actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->route('devices.index')
                ->withSuccess('Dispositivo ha sido eliminado correctamente');
    }

    public function cargarfacturamultiple()
    {
        $cargarfacturamultiples = Device::select('id', 'serialnumber')->orderBy('id','ASC')->get();
        return view('devices.cargarfacturamultiple',
           compact('cargarfacturamultiples')
        );
    }
    public function cargarfacturamultiplepost(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'ids' => 'required|array',          // Debe ser un array de IDs
            'ids.*' => 'exists:devices,id',      // Cada ID debe existir en la tabla 'device'
            'invoicepath' => 'required|string',        // El nuevo valor de path debe ser un string válido
        ]);

        // Extraer los datos del request
        $ids = $request->input('ids');         // IDs de los registros a actualizar
        $path = $request->input('invoicepath');       // Nuevo valor para el campo path

        // Actualizar los registros
        Device::whereIn('id', $ids)->update(['invoicepath' => $path]);

        return redirect()->route('devices.index')
                ->withSuccess('Dispositivo ha sido actualizado correctamente.');
    }
}
