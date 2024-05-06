<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Employee;
use App\Models\Jobtitle;
use App\Models\Department;
use App\Models\Branch;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Yajra\DataTables\Contracts\DataTable;



class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:mostrar-colaboradores|editar-colaboradores|eliminar-colaboradores', ['only' => ['index','show']]);
        $this->middleware('permission:crear-colaboradores', ['only' => ['create','store']]);
        $this->middleware('permission:editar-colaboradores', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-colaboradores', ['only' => ['destroy']]);
    }

    // public function index(Request $request): View
    // {

    //     $employees = Employee::with('branch', 'department','jobtitle')
    //     ->orderBy('id','DESC')
    //     ->paginate(10);

    //     return view('employees.index', compact('employees'));

    // }
    public function index()
    {
        return view('employees.index');
    }

    public function pagination()
    {
        $user = Auth()->user();
        if(request()->ajax()) {

	        return Datatables()->of(Employee::with('branch', 'department','jobtitle')->select('*'))
	        ->addColumn('action', function (Employee $employee) use ($user) {

                $btn = '<form action='.route("employees.destroy",$employee->id).' method="post"><input type="hidden" name="_token" value="CFBNenxDwWPoyJ1YgORiS6JyrnK663TuxbIJUeDu" autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Do you want to delete this user?");';
                if ($user->can('mostrar_colaboradores'))
                {
                   $btn  = $btn . '<a href="'.route("employees.show",$employee->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar_colaboradores'))
                {
                    $btn =$btn.'<a href="'.route("employees.edit",$employee->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar_colaboradores'))
                {
                    $btn =$btn.'<button type="submit" class="btn btn-danger btn-sm" onclick="'. $onclick.'"><i class="fas fa-trash"></i> Eliminar</button>';
                }

                  $btn =$btn .'</form>';
                  return $btn;

            })
            // ->addColumn('Edit', function (Employee $employee,$user) {
            //     return '<a href="'.route("employees.edit",$employee->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
            // })
            // ->addColumn('Delete', function (Employee $employee,$user) {
            //     return '<a href="'.route("employees.delete",$employee->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
            // })
            ->rawColumns(['action'])
            ->addIndexColumn()
	        ->make(true);
	    }
        return view('employees.pagination', compact('employees'));

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
        ///$compania=Compania::findorFail($companiaid);
        if ($image = $request->file('photo')) {
            $destinationPath = 'photos/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['photo'] =$destinationPath . $postImage;
        }
        // dd($input['photo']);
        Employee::create($input);

        return redirect()->route('employees.index')
                ->withSuccess('Colaborador ha sido creado correctamente.');
    }

    public function edit($id)
    {
        $employee = Employee::with('branch', 'department','jobtitle')->findOrFail($id);;
        $branches = Branch::all();
        $jobtitles = Jobtitle::get();
        $departments = Department::get();

        // return view('employees.edit', [
        //     'employee' => $employee
        // ]);
        return view('employees.edit',compact('employee','branches','jobtitles','departments'));

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

    public function create(): View
    {
        $branches = Branch::all();
        $jobtitles = Jobtitle::all();
        $departments = Department::all();
        return view('employees.create',compact('branches','jobtitles','departments') );

    }
    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();
        return redirect()->route('employees.index')
                ->withSuccess('Colaborador ha sido eliminado correctamente');
    }



}
