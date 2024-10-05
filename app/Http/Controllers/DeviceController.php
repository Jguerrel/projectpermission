<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeviceRequest;
use App\Http\Requests\UpdateDeviceRequest;
use App\Models\Device;
use Illuminate\View\View;
use App\Models\Typedevice;
use App\Models\BranchOffice;
use App\Models\Employee;
use App\Models\Disktype;
use App\Models\Ipaddress;

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

    public function pagination()
    {
        $user = Auth()->user();
        if(request()->ajax()) {

	        return Datatables()->of(Device::with('typedevice','branch_office','employee','disktype','ipaddress')->select('*'))
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

                  $btn =$btn .'</form>';
                  return $btn;

            })

            ->rawColumns(['action'])

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
        return view('devices.create',compact('employees','branchoffices','typedevices','disktypes','ipadresses') );
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
        $device = Device::with('branch_office','typedevice','disktype','employee','ipaddress')->findOrFail($id);;
        $typedevices = Typedevice::get();
        $branch_offices = BranchOffice::get();
        $employees = Employee::get();
        $disktypes = Disktype::get();
        $ipaddresses = Ipaddress::get();

        return view('devices.edit',compact('device','branch_offices','typedevices','disktypes','employees','ipaddresses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceRequest $request, Device $device)
    {
        dd("llegue");
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
}
