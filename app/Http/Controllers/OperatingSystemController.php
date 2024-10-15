<?php

namespace App\Http\Controllers;

use App\Models\OperatingSystem;
use App\Http\Requests\StoreOperatingSystemRequest;
use App\Http\Requests\UpdateOperatingSystemRequest;
use Illuminate\Http\RedirectResponse;
class OperatingSystemController extends Controller
{


    public function __construct()
    {

        $this->middleware('auth');
         $this->middleware('permission:ver-sistemaoperativos', ['only' => ['index']]);
         $this->middleware('permission:crear-sistemaoperativos', ['only' => ['create','store']]);
         $this->middleware('permission:editar-sistemaoperativos', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-sistemaoperativos', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('operatingsystems.index', [
            'operatingsystems' => OperatingSystem::orderBy('id','ASC')->paginate(20)
        ]);
    }

    /*Paginacion*/
    public function pagination()
    {
        $user = Auth()->user();
        if(request()->ajax()) {

	        return Datatables()->of(OperatingSystem::select('*'))
            ->editColumn('status', function(OperatingSystem $operatingsystem) {
                return  '<span class="text-'. ($operatingsystem->status ? 'success' : 'danger') .'">'. ($operatingsystem->status ? 'Activo' : 'Inactivo').'</span>';
            })
            ->addColumn('action', function (OperatingSystem $operatingsystem) use ($user) {

                $btn = '<form action='.route("operatingsystems.destroy",$operatingsystem->id).' method="post"><input type="hidden" name="_token"  value=" '.csrf_token().' " autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Do you want to delete this user?");';
                if ($user->can('ver-sistemaoperativos'))
                {
                   $btn  = $btn . '<a href="'.route("operatingsystems.show",$operatingsystem->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar-sistemaoperativos'))
                {
                    $btn =$btn.'<a href="'.route("operatingsystems.edit",$operatingsystem->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar-sistemaoperativos'))
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
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('operatingsystems.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOperatingSystemRequest $request): RedirectResponse
    {
          OperatingSystem::create($request->all());
        return redirect()->route('operatingsystems.index')
                ->withSuccess('Sistema Operativo ha sido agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OperatingSystem $operatingsystem)
    {
        return view('operatingsystems.show', [
            'operatingsystem' => $operatingsystem
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OperatingSystem $operatingsystem)
    {
        return view('operatingsystems.edit', [
            'operatingsystem' => $operatingsystem
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOperatingSystemRequest $request, OperatingSystem $operatingsystem)
    {
        $operatingsystem->update($request->all());
        return redirect()->route('operatingsystems.index')
                ->withSuccess('Sistema Operativo ha sido actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OperatingSystem $operatingsystem)
    {
        $operatingsystem->delete();
        return redirect()->route('operatingsystems.index')
                ->withSuccess('Sistema Operativo ha sido eliminado correctamente');
    }
}
