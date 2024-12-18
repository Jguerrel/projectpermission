<?php

namespace App\Http\Controllers;
use App\Models\Typedevice;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreTypeDeviceRequest;
use App\Http\Requests\UpdateTypeDeviceRequest;

class TypedeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver-tipodispositivos', ['only' => ['index','show']]);
        $this->middleware('permission:crear-tipodispositivos', ['only' => ['create','store']]);
        $this->middleware('permission:editar-tipodispositivos', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-tipodispositivos', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('typedevices.index', [
            'typedevices' => Typedevice::orderBy('id','DESC')->paginate(10)
        ]);
    }

    public function pagination()
    {
        $user = Auth()->user();
        if(request()->ajax()) {

	        return Datatables()->of(Typedevice::select('*'))
            ->editColumn('status', function(Typedevice $typedevice) {
                return  '<span class="text-'. ($typedevice->status ? 'success' : 'danger') .'">'. ($typedevice->status ? 'Activo' : 'Inactivo').'</span>';
            })
	        ->addColumn('action', function (Typedevice $typedevice) use ($user) {

                $btn = '<form action='.route("typedevices.destroy",$typedevice->id).' method="post"><input type="hidden" name="_token"  value=" '.csrf_token().' " autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Seguro que quieres eliminar esta cuenta?");';
                if ($user->can('ver-cuentas'))
                {
                   $btn  = $btn . '<a href="'.route("typedevices.show",$typedevice->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar-cuentas'))
                {
                    $btn =$btn.'<a href="'.route("typedevices.edit",$typedevice->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar-cuentas'))
                {
                    $btn =$btn.'<button type="submit" class="btn btn-danger btn-sm" onclick="'. $onclick.'"><i class="fas fa-trash"></i> Eliminar</button>';
                }

                  $btn =$btn .'</form>';
                  return $btn;

            })

            ->rawColumns(['status','action'])
            ->addIndexColumn()
	        ->make(true);
	    }


    }
    public function create(): View
    {
        return view('typedevices.create');

    }
    public function show(Typedevice $typedevice): View
    {
        return view('typedevices.show', [
            'typedevice' => $typedevice
        ]);
    }
    public function store(StoreTypeDeviceRequest $request): RedirectResponse
    {
        Typedevice::create($request->all());
        return redirect()->route('typedevices.index')
        ->with('success','Tipo de dispositivo creado correctamente');

    }

    public function edit(Typedevice $typedevice)
    {


        return view('typedevices.edit',compact('typedevice'));
    }


    public function update(UpdateTypeDeviceRequest $request, Typedevice $typedevice): RedirectResponse
    {
        $typedevice->update($request->all());

        return redirect()->route('typedevices.index')
                ->withSuccess('Tipo de Dispositivo ha sido actualizado correctamente.');
    }


    public function destroy(Typedevice $typedevice): RedirectResponse
    {
        $typedevice->delete();
        return redirect()->route('typedevices.index')
                ->withSuccess('Tipo de dispositivo ha sido eliminada correctamente');
    }

}
