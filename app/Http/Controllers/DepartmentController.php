<?php

namespace App\Http\Controllers;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\UpdateDepartamentoRequest;
use Illuminate\Http\RedirectResponse;
use App\http\Requests\StoreDepartamentoRequest;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('permission:ver-departamentos', ['only' => ['index']]);
        $this->middleware('permission:crear-departamentos', ['only' => ['create','store']]);
        $this->middleware('permission:editar-departamentos', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-departamentos', ['only' => ['destroy']]);
    }
    public function index(): View
    {
        return view('departments.index', [
            'departments' => Department::orderBy('id','ASC')->paginate(20)
        ]);
    }
    public function pagination()
    {
        $user = Auth()->user();
        if(request()->ajax()) {

	        return Datatables()->of(Department::select('*'))
            ->editColumn('status', function(Department $department) {
                return  '<span class="text-'. ($department->status ? 'success' : 'danger') .'">'. ($department->status ? 'Activo' : 'Inactivo').'</span>';
            })
            ->addColumn('action', function (Department $department) use ($user) {

                $btn = '<form action='.route("departments.destroy",$department->id).' method="post"><input type="hidden" name="_token"  value=" '.csrf_token().' " autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Do you want to delete this user?");';
                if ($user->can('ver-departamentos'))
                {
                   $btn  = $btn . '<a href="'.route("departments.show",$department->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar-departamentos'))
                {
                    $btn =$btn.'<a href="'.route("departments.edit",$department->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar-departamentos'))
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
        return view('departments.create');

    }

    public function store(StoreDepartamentoRequest $request): RedirectResponse
    {

        Department::create($request->all());
        return redirect()->route('departments.index')
                ->withSuccess('Departamento ha sido agregado correctamente.');
    }

    public function show(Department $department): View
    {
        return view('departments.show', [
            'department' => $department
        ]);
    }

    public function edit(Department $department)
    {
        return view('departments.edit', [
            'department' => $department
        ]);
    }
    public function update(UpdateDepartamentoRequest $request, Department $department): RedirectResponse
    {
        $department->update($request->all());

        Log::channel('Registro actualizado en la tabla users:', [
            'id' => $department->id,
            'name' => $department->name,
            'email' => $user->email,
            'updated_at' => $user->updated_at
        ]);

        return redirect()->route('departments.index')
                ->withSuccess('Departamento ha sido actualizado correctamente.');
    }
    public function destroy(Department $department): RedirectResponse
    {
        $department->delete();
        return redirect()->route('departments.index')
                ->withSuccess('departamento ha sido eliminado correctamente');
    }

}
