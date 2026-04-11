<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use App\Models\BranchOffice;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreBranchOfficeRequest;
use App\Http\Requests\UpdateBranchOfficeRequest;


class BranchOfficeController extends Controller
{


    public function __construct()
    {

        $this->middleware('auth');
         $this->middleware('permission:ver-sucursales', ['only' => ['index','listJson']]);
         $this->middleware('permission:crear-sucursales', ['only' => ['create','store']]);
         $this->middleware('permission:editar-sucursales', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-sucursales', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $branchoffices = BranchOffice::orderBy('id','ASC')
        ->paginate(50);

        return view('branchoffices.index', compact('branchoffices'));
    }

    public function pagination(Request $request)
    {
        $user = Auth()->user();
        if(request()->ajax()) {
            $data = BranchOffice::select('*');
            if ($request->filled('name')) {
                $data->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->filled('name_sw')) {
                $data->where('name', 'like', $request->name_sw . '%');
            }
            if ($request->filled('name_nc')) {
                $data->where('name', 'not like', '%' . $request->name_nc . '%');
            }
            if ($request->filled('status')) {
                $data->where('status', $request->status);
            }
	        return Datatables()->of($data)
            ->editColumn('status', function(BranchOffice $branchoffice) {
                return  '<span class="text-'. ($branchoffice->status ? 'success' : 'danger') .'">'. ($branchoffice->status ? 'Activo' : 'Inactivo').'</span>';
            })
            ->addColumn('action', function (BranchOffice $branchoffice) use ($user) {

                $btn = '<form action='.route("branchoffices.destroy",$branchoffice->id).' method="post"><input type="hidden" name="_token"  value=" '.csrf_token().' " autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Do you want to delete this user?");';
                if ($user->can('ver-sucursales'))
                {
                   $btn  = $btn . '<a href="'.route("branchoffices.show",$branchoffice->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar-sucursales'))
                {
                    $btn =$btn.'<a href="'.route("branchoffices.edit",$branchoffice->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar-sucursales'))
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
    public function show(BranchOffice $branchoffice): View
    {

        return view('branchoffices.show', [
            'branchoffice' => $branchoffice
        ]);
    }

    public function create(): View
    {
        return view('branchoffices.create' );

    }
    public function edit($id)
    {
        $branchoffice = BranchOffice::findOrFail($id);;

        return view('branchoffices.edit',compact('branchoffice'));

    }

    public function update(UpdateBranchOfficeRequest $request, BranchOffice $branchoffice): RedirectResponse
    {
        $branchoffice->update($request->all());

        return redirect()->route('branchoffices.index')
                ->withSuccess('Sucursal ha sido actualizada correctamente.');
    }

    public function store(StoreBranchOfficeRequest $request): RedirectResponse
    {

        BranchOffice::create($request->all());

        return redirect()->route('branchoffices.index')
                ->withSuccess('Sucursal ha sido agregado correctamente.');
    }

    /**
     * GET /admin/branchoffices/json  — lista para Select2 AJAX
     */
    public function listJson(Request $request)
    {
        $query = BranchOffice::where('status', 1);
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        return response()->json(
            $query->orderBy('name')->get()->map(fn($b) => ['id' => $b->id, 'text' => $b->name])
        );
    }

    public function destroy(BranchOffice $branchoffice): RedirectResponse
    {
        $branchoffice->delete();
        return redirect()->route('branchoffices.index')
                ->withSuccess('Sucursal ha sido eliminado correctamente');
    }

}
