<?php

namespace App\Http\Controllers;
use App\Models\Compania;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\http\Requests\StoreCompaniaRequest;
use App\http\Requests\UpdateCompaniaRequest;
use Illuminate\Http\RedirectResponse;

class CompaniaController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
         $this->middleware('permission:create-compania|edit-compania|delete-compania', ['only' => ['index']]);
         $this->middleware('permission:create-compania', ['only' => ['create','store']]);
         $this->middleware('permission:edit-compania', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-compania', ['only' => ['destroy']]);
    }


    public function index(): View
    {
        return view('companias.index', [
            'companias' => Compania::orderBy('id','ASC')->paginate(20)
        ]);
    }

    public function create(): View
    {
        return view('companias.create');

    }

    public function show(Compania $compania): View
    {
        return view('companias.show', [
            'compania' => $compania
        ]);
    }


    public function store(StoreCompaniaRequest $request): RedirectResponse
    {

        Compania::create($request->all());
        return redirect()->route('companias.index')
                ->withSuccess('Compañia ha sido agregado correctamente.');
    }

    public function edit(Compania $compania)
    {
        return view('companias.edit', [
            'compania' => $compania
        ]);
    }

    public function update(UpdateCompaniaRequest $request, Compania $compania): RedirectResponse
    {
        $compania->update($request->all());
        return redirect()->route('companias.index')
                ->withSuccess('Compañia ha sido actualizado correctamente.');
    }


    public function destroy(Compania $compania): RedirectResponse
    {
        $compania->delete();
        return redirect()->route('companias.index')
                ->withSuccess('Compania ha sido eliminada correctamente');
    }



}
