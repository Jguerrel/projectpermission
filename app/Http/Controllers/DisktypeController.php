<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDisktypeRequest;
use App\Http\Requests\UpdateDisktypeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Disktype;
use Illuminate\View\View;
class DisktypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('permission:ver-tipodiscos', ['only' => ['index']]);
        $this->middleware('permission:crear-tipodiscos', ['only' => ['create','store']]);
        $this->middleware('permission:editar-tipodiscos', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-tipodiscos', ['only' => ['destroy']]);
    }
    public function index()
    {
        return view('disktypes.index', [
            'disktypes' => Disktype::orderBy('id','ASC')->paginate(20)
        ]);
    }

    public function pagination()
    {
        $user = Auth()->user();
        if(request()->ajax()) {

	        return Datatables()->of(Disktype::select('*'))
            ->editColumn('status', function(Disktype $disktype) {
                return  '<span class="text-'. ($disktype->status ? 'success' : 'danger') .'">'. ($disktype->status ? 'Activo' : 'Inactivo').'</span>';
            })
            ->addColumn('action', function (Disktype $disktype) use ($user) {

                $btn = '<form action='.route("disktypes.destroy",$disktype->id).' method="post"><input type="hidden" name="_token"  value=" '.csrf_token().' " autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Quieres eliminar el tipo de disco?");';
                if ($user->can('ver-tiposdiscos'))
                {
                   $btn  = $btn . '<a href="'.route("disktypes.show",$disktype->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar-tiposdiscos'))
                {
                    $btn =$btn.'<a href="'.route("disktypes.edit",$disktype->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar-tiposdiscos'))
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
    public function create()
    {
        return view('disktypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDisktypeRequest $request)
    {
        Disktype::create($request->all());
        return redirect()->route('disktypes.index')
                ->withSuccess('Tipo de disco ha sido agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Disktype $disktype): View
    {
        return view('disktypes.show', [
            'disktype' => $disktype
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disktype $disktype)
    {
        return view('disktypes.edit', [
            'disktype' => $disktype
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDisktypeRequest $request, Disktype $disktype)
    {
        $disktype->update($request->all());
        return redirect()->route('disktypes.index')
                ->withSuccess('Tipo de disco ha sido actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disktype $disktype)
    {
        $disktype->delete();
        return redirect()->route('disktypes.index')
                ->withSuccess('Tipo de disco ha sido eliminado correctamente');
    }
}
