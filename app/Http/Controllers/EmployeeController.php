<?php

namespace App\Http\Controllers;
use Illuminate\View\View;

use App\Models\User;
use App\Models\Employee;
use App\Models\Jobtitle;
use App\Models\Department;
use App\Models\Branch;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Http\RedirectResponse;



class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver-colaboradores', ['only' => ['index','show']]);
        $this->middleware('permission:crear-colaboradores', ['only' => ['create','store']]);
        $this->middleware('permission:editar-colaboradores', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-colaboradores', ['only' => ['destroy']]);
    }


    public function index()
    {
        return view('employees.index');
    }

    public function pagination(\Illuminate\Http\Request $request)
    {
        $user = Auth()->user();
        if(request()->ajax()) {
            $data = Employee::with('department', 'jobtitle')->select('*');
            if ($request->filled('name')) {
                $data->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->filled('name_sw')) {
                $data->where('name', 'like', $request->name_sw . '%');
            }
            if ($request->filled('name_nc')) {
                $data->where('name', 'not like', '%' . $request->name_nc . '%');
            }
            if ($request->filled('department')) {
                $data->whereHas('department', fn($q) => $q->where('name', 'like', '%' . $request->department . '%'));
            }
            if ($request->filled('department_sw')) {
                $data->whereHas('department', fn($q) => $q->where('name', 'like', $request->department_sw . '%'));
            }
            if ($request->filled('department_nc')) {
                $data->whereHas('department', fn($q) => $q->where('name', 'not like', '%' . $request->department_nc . '%'));
            }
            if ($request->filled('status')) {
                $data->where('status', $request->status);
            }
	        return Datatables()->of($data)
            ->editColumn('status', function(Employee $employee) {
                return  '<span class="text-'. ($employee->status ? 'success' : 'danger') .'">'. ($employee->status ? 'Activo' : 'Inactivo').'</span>';
            })
            ->addColumn('action', function (Employee $employee) use ($user) {

                $btn = '<form action='.route("employees.destroy",$employee->id).' method="post"><input type="hidden" name="_token"  value=" '.csrf_token().' " autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Do you want to delete this user?");';
                if ($user->can('ver-colaboradores'))
                {
                   $btn  = $btn . '<a href="'.route("employees.show",$employee->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar-colaboradores'))
                {
                    $btn =$btn.'<a href="'.route("employees.edit",$employee->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar-colaboradores'))
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
        $jobtitles = Jobtitle::all();
        $departments = Department::all();
        return view('employees.create',compact('jobtitles','departments') );

    }
    public function show(Employee $employee): View

    {
        return view('employees.show', [
            'employee' => $employee
        ]);
    }

    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
          $input = $request->all();

        if ($image = $request->file('photo')) {
            $destinationPath = 'photos/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['photo'] =$destinationPath . $postImage;
        }
        Employee::create($input);

        return redirect()->route('employees.index')
                ->withSuccess('Colaborador ha sido creado correctamente.');
    }

    public function edit($id)
    {
        $employee = Employee::with('department','jobtitle')->findOrFail($id);;
        $jobtitles = Jobtitle::get();
        $departments = Department::get();
        return view('employees.edit',compact('employee','jobtitles','departments'));

    }
    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
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

        $employee->update($input);

        return redirect()->route('employees.index')
                ->withSuccess('Colaborador ha sido actualizado correctamente.');
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();
        return redirect()->route('employees.index')
                ->withSuccess('Colaborador ha sido eliminado correctamente');
    }



}
