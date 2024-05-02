<?php

namespace App\Http\Controllers;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\UpdateDepartamentoRequest;
use Illuminate\Http\RedirectResponse;
use App\http\Requests\StoreDepartamentoRequest;


class DepartmentController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('permission:create-departamento|edit-departamento|delete-departamento', ['only' => ['index']]);
        $this->middleware('permission:create-departamento', ['only' => ['create','store']]);
        $this->middleware('permission:edit-departamento', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-departamento', ['only' => ['destroy']]);
    }
    public function index(): View
    {
        return view('departments.index', [
            'departments' => Department::orderBy('id','ASC')->paginate(20)
        ]);
    }

    public function create(): View
    {
        return view('departments.create');

    }

    public function store(StoreDepartamentoRequest $request): RedirectResponse
    {

        Department::create($request->all());
        return redirect()->route('departments.index')
                ->withSuccess('Departmento ha sido agregado correctamente.');
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
