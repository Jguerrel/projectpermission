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
        return view('departamentos.create');

    }

    public function store(StoreDepartamentoRequest $request): RedirectResponse
    {

        Department::create($request->all());
        return redirect()->route('departamentos.index')
                ->withSuccess('Departmento ha sido agregado correctamente.');
    }

    public function show(Department $departamento): View
    {
        return view('departamentos.show', [
            'departamento' => $departamento
        ]);
    }

    public function edit(Department $departamento)
    {
        return view('departamentos.edit', [
            'departamento' => $departamento
        ]);
    }
    public function update(UpdateDepartamentoRequest $request, Department $departamento): RedirectResponse
    {
        $departamento->update($request->all());
        return redirect()->route('departamentos.index')
                ->withSuccess('Departamento ha sido actualizado correctamente.');
    }
    public function destroy(Department $departamento): RedirectResponse
    {
        $departamento->delete();
        return redirect()->route('departamentos.index')
                ->withSuccess('departamento ha sido eliminado correctamente');
    }

}
