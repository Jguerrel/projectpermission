<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use App\Models\BranchOffice;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreBranchOfficeRequest;
use App\Http\Requests\UpdateBranchOfficeRequest;
class BranchOfficeController extends Controller
{


    public function __construct()
    {

        $this->middleware('auth');
         $this->middleware('permission:ver-sucursales', ['only' => ['index']]);
         $this->middleware('permission:crear-sucursales', ['only' => ['create','store']]);
         $this->middleware('permission:editar-sucursales', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-sucursales', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $branchoffices = BranchOffice::orderBy('id','ASC')
        ->paginate(20);

        return view('branchoffices.index', compact('branchoffices'));
    }
    public function show(BranchOffice $branchoffice): View
    {

        return view('branchoffices.show', [
            'branchoffice' => $branchoffice
        ]);
    }

    public function create(): View
    {
        $branches = Branch::all();
        return view('branchoffices.create',compact('branches') );

    }
    public function edit($id)
    {
        $branchoffice = BranchOffice::findOrFail($id);;
        $branches = Branch::all();
        return view('branchoffices.edit',compact('branchoffice'));

    }

    public function update(UpdateBranchOfficeRequest $request, BranchOffice $branchoffice): RedirectResponse
    {
        $input = $request->all();

        $branchoffice->update($input);

        return redirect()->route('branchoffices.index')
                ->withSuccess('Sucursal ha sido actualizada correctamente.');
    }

    public function store(StoreBranchOfficeRequest $request): RedirectResponse
    {

        BranchOffice::create($request->all());
        return redirect()->route('branchoffices.index')
                ->withSuccess('Sucursal ha sido agregado correctamente.');
    }

    public function destroy(BranchOffice $branchoffice): RedirectResponse
    {
        $branchoffice->delete();
        return redirect()->route('branchoffices.index')
                ->withSuccess('Sucursal ha sido eliminado correctamente');
    }

}
