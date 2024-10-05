<?php

namespace App\Http\Controllers;
use App\Models\Jobtitle;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateCargoRequest;
use App\Http\Requests\StoreCargoRequest;
use DataTables;

class JobTitleController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
         $this->middleware('permission:ver-cargos', ['only' => ['index']]);
         $this->middleware('permission:crear-cargos', ['only' => ['create','store']]);
         $this->middleware('permission:editar-cargos', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-cargos', ['only' => ['destroy']]);
    }


    public function index(): View
    {
        return view('jobtitles.index', [
            'jobtitles' => jobtitle::orderBy('id','ASC')->paginate(10)
        ]);
    }

    public function pagination()
    {
        $user = Auth()->user();
        if(request()->ajax()) {

	        return Datatables()->of(Jobtitle::select('*'))
            ->editColumn('status', function(Jobtitle $jobtitle) {
                return  '<span class="text-'. ($jobtitle->status ? 'success' : 'danger') .'">'. ($jobtitle->status ? 'Activo' : 'Inactivo').'</span>';
            })
            ->addColumn('action', function (Jobtitle $jobtitle) use ($user) {

                $btn = '<form action='.route("jobtitles.destroy",$jobtitle->id).' method="post"><input type="hidden" name="_token"  value=" '.csrf_token().' " autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Do you want to delete this user?");';
                if ($user->can('ver-cargos'))
                {
                   $btn  = $btn . '<a href="'.route("jobtitles.show",$jobtitle->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar-cargos'))
                {
                    $btn =$btn.'<a href="'.route("jobtitles.edit",$jobtitle->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar-cargos'))
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
        return view('jobtitles.create');

    }
    public function store(StoreCargoRequest $request): RedirectResponse
    {
        jobtitle::create($request->all());
        return redirect()->route('jobtitles.index')
        ->with('success','Cargo creado correctamente');

    }
    public function show(Jobtitle $jobtitle)
    {
        return view('jobtitles.show', [
            'jobtitle' => $jobtitle
        ]);
    }

    public function edit(Jobtitle $jobtitle)
    {
        return view('jobtitles.edit', [
            'jobtitle' => $jobtitle
        ]);
    }
    public function update(UpdateCargoRequest $request, Jobtitle $jobtitle): RedirectResponse
    {
        $jobtitle->update($request->all());
        return redirect()->route('jobtitles.index')
                ->withSuccess('Cargo ha sido actualizado correctamente.');
    }

    public function destroy(Jobtitle $jobtitle): RedirectResponse
    {
        $jobtitle->delete();
        return redirect()->route('jobtitles.index')
                ->withSuccess('Cargo ha sido eliminado correctamente.');
    }

}
