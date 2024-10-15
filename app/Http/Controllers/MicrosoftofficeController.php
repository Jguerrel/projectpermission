<?php

namespace App\Http\Controllers;

use App\Models\Microsoftoffice;
use App\Http\Requests\StoreMicrosoftofficeRequest;
use App\Http\Requests\UpdateMicrosoftofficeRequest;

class MicrosoftofficeController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
         $this->middleware('permission:ver-licenciaoffice', ['only' => ['index']]);
         $this->middleware('permission:crear-licenciaoffice', ['only' => ['create','store']]);
         $this->middleware('permission:editar-licenciaoffice', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-licenciaoffice', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('microsoftoffices.index', [
            'microsoftoffices' => Microsoftoffice::orderBy('id','ASC')->paginate(10)
        ]);
    }

     /*Paginacion*/
    public function pagination()
    {
        $user = Auth()->user();
        if(request()->ajax()) {

	        return Datatables()->of(Microsoftoffice::select('*'))
            ->editColumn('status', function(Microsoftoffice $microsoftoffice) {
                return  '<span class="text-'. ($microsoftoffice->status ? 'success' : 'danger') .'">'. ($microsoftoffice->status ? 'Activo' : 'Inactivo').'</span>';
            })
            ->addColumn('action', function (Microsoftoffice $microsoftoffice) use ($user) {

                $btn = '<form action='.route("microsoftoffices.destroy",$microsoftoffice->id).' method="post"><input type="hidden" name="_token"  value=" '.csrf_token().' " autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Do you want to delete this user?");';
                if ($user->can('ver-licenciaoffice'))
                {
                   $btn  = $btn . '<a href="'.route("microsoftoffices.show",$microsoftoffice->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar-licenciaoffice'))
                {
                    $btn =$btn.'<a href="'.route("microsoftoffices.edit",$microsoftoffice->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar-licenciaoffice'))
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
        return view('microsoftoffices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMicrosoftofficeRequest $request)
    {
        Microsoftoffice::create($request->all());
        return redirect()->route('microsoftoffices.index')
                ->withSuccess('Office ha sido agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Microsoftoffice $microsoftoffice)
    {
        return view('microsoftoffices.show', [
            'microsoftoffice' => $microsoftoffice
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Microsoftoffice $microsoftoffice)
    {
        return view('microsoftoffices.edit', [
            'microsoftoffice' => $microsoftoffice
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMicrosoftofficeRequest $request, Microsoftoffice $microsoftoffice)
    {
        $microsoftoffice->update($request->all());
        return redirect()->route('microsoftoffices.index')
                ->withSuccess('Office ha sido actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Microsoftoffice $microsoftoffice)
    {
        $microsoftoffice->delete();
        return redirect()->route('microsoftoffices.index')
                ->withSuccess('Office ha sido eliminado correctamente');
    }
}
