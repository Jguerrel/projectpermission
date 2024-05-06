<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDisktypeRequest;
use App\Http\Requests\UpdateDisktypeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Disktype;
use Illuminate\View\View;
class DisktypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('permission:crear-tipodiscos|editar-tipodiscos|eliminar-tipodiscos', ['only' => ['index']]);
        $this->middleware('permission:crear-tipodiscos', ['only' => ['create','store']]);
        $this->middleware('permission:editar-tipodiscos', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-tipodiscos', ['only' => ['destroy']]);
    }
    public function index()
    {
        return view('disktypes.index', [
            'disktypes' => Disktype::orderBy('id','ASC')->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('disktypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDisktypeRequest $request)
    {
        Disktype::create($request->all());
        return redirect()->route('disktypes.index')
                ->withSuccess('Tipo de disco ha sido agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Disktype $disktype): View
    {
        return view('disktypes.show', [
            'disktype' => $disktype
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disktype $disktype)
    {
        return view('disktypes.edit', [
            'disktype' => $disktype
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDisktypeRequest $request, Disktype $disktype)
    {
        $disktype->update($request->all());
        return redirect()->route('disktypes.index')
                ->withSuccess('Tipo de disco ha sido actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disktype $disktype)
    {
        $disktype->delete();
        return redirect()->route('disktypes.index')
                ->withSuccess('Tipo de disco ha sido eliminado correctamente');
    }
}
