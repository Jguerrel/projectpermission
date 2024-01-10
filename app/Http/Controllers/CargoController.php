<?php

namespace App\Http\Controllers;
use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateCargoRequest;
use App\Http\Requests\StoreCargoRequest;
class CargoController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
         $this->middleware('permission:create-cargo|edit-cargo|delete-cargo', ['only' => ['index']]);
         $this->middleware('permission:create-cargo', ['only' => ['create','store']]);
         $this->middleware('permission:edit-cargo', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-cargo', ['only' => ['destroy']]);
    }


    public function index(): View
    {
        return view('cargos.index', [
            'cargos' => Cargo::orderBy('id','ASC')->paginate(20)
        ]);
    }

    public function create(): View
    {
        return view('cargos.create');

    }
    public function store(StoreCargoRequest $request): RedirectResponse
    {
        Cargo::create($request->all());
        return redirect()->route('cargos.index')
        ->with('success','Cargo creado correctamente');

    }
    public function show(Cargo $cargo)
    {
        return view('cargos.show', [
            'cargo' => $cargo
        ]);
    }

    public function edit(Cargo $cargo)
    {
        return view('cargos.edit', [
            'cargo' => $cargo
        ]);
    }
    public function update(UpdateCargoRequest $request, Cargo $cargo): RedirectResponse
    {
        $cargo->update($request->all());
        return redirect()->route('cargos.index')
                ->withSuccess('Cargo ha sido actualizado correctamente.');
    }

    public function destroy(Cargo $cargo): RedirectResponse
    {
        $cargo->delete();
        return redirect()->route('cargos.index')
                ->withSuccess('Cargo ha sido eliminado correctamente.');
    }

}
