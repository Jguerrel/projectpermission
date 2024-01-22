<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Cargo;
use App\Models\Departamento;
use App\Models\Compania;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-employee|edit-employee|delete-employee', ['only' => ['index','show']]);
        $this->middleware('permission:create-employee', ['only' => ['create','store']]);
        $this->middleware('permission:edit-employee', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-employee', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $employees = Employee::with('compania', 'departamento','cargo')
        ->orderBy('id','DESC')
        ->paginate(10);

        return view('employees.index', compact('employees'));
    }

    public function create(): View
    {
        $companias = Compania::get();
        $cargos = Cargo::get();
        $departamentos = Departamento::get();
        return view('employees.create',compact('companias','cargos','departamentos'));

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
        $employee = Employee::with('compania', 'departamento','cargo')->findOrFail($id);;
        $companias = Compania::all();
        $cargos = Cargo::get();
        $departamentos = Departamento::get();

        // return view('employees.edit', [
        //     'employee' => $employee
        // ]);
        return view('employees.edit',compact('employee','companias','cargos','departamentos'));

    }
    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $input = $request->all();

        ///$compania=Compania::findorFail($companiaid);
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
