<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\http\Requests\StoreCompaniaRequest;
use App\http\Requests\UpdateCompaniaRequest;
use Illuminate\Http\RedirectResponse;

class BranchController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
         $this->middleware('permission:mostrar-companias|editar-companias|elininar-companias', ['only' => ['index']]);
         $this->middleware('permission:crear-companias', ['only' => ['create','store']]);
         $this->middleware('permission:editar-companias', ['only' => ['edit','update']]);
        $this->middleware('permission:elininar-companias', ['only' => ['destroy']]);
    }


    public function index(): View
    {
        return view('branches.index', [
            'branches' => Branch::orderBy('id','ASC')->paginate(20)
        ]);
    }

    public function create(): View
    {
        return view('branches.create');

    }

    public function show(Branch $branch): View
    {
        return view('branches.show', [
            'branch' => $branch
        ]);
    }


    public function store(StoreCompaniaRequest $request): RedirectResponse
    {

        Branch::create($request->all());
        return redirect()->route('branches.index')
                ->withSuccess('Compañia ha sido agregado correctamente.');
    }

    public function edit(Branch $branch)
    {
        return view('branches.edit', [
            'branch' => $branch
        ]);
    }

    public function update(UpdateCompaniaRequest $request, Branch $branch): RedirectResponse
    {
        $branch->update($request->all());
        return redirect()->route('branches.index')
                ->withSuccess('Compañia ha sido actualizado correctamente.');
    }


    public function destroy(Branch $branch): RedirectResponse
    {
        $branch->delete();
        return redirect()->route('branches.index')
                ->withSuccess('Compania ha sido eliminada correctamente');
    }



}
