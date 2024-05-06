<?php

namespace App\Http\Controllers;
use App\Models\Typedevice;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreTypeDeviceRequest;
use App\Http\Requests\UpdateTypeDeviceRequest;

class TypedeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver-tipodispositivos', ['only' => ['index','show']]);
        $this->middleware('permission:crear-tipodispositivos', ['only' => ['create','store']]);
        $this->middleware('permission:editar-tipodispositivos', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-tipodispositivos', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('typedevices.index', [
            'typedevices' => Typedevice::orderBy('id','DESC')->paginate(10)
        ]);
    }

    public function create(): View
    {
        return view('typedevices.create');

    }
    public function show(Typedevice $typedevice): View
    {
        return view('typedevices.show', [
            'typedevice' => $typedevice
        ]);
    }
    public function store(StoreTypeDeviceRequest $request): RedirectResponse
    {
        Typedevice::create($request->all());
        return redirect()->route('typedevices.index')
        ->with('success','Tipo de dispositivo creado correctamente');

    }

    public function edit(Typedevice $typedevice)
    {
        return view('typedevices.edit', [
            'typedevice' => $typedevice
        ]);
    }


    public function update(UpdateTypeDeviceRequest $request, TypeDevice $typedevice): RedirectResponse
    {
        $typedevice->update($request->all());
        return redirect()->route('typedevices.index')
                ->withSuccess('Tipo de Dispositivo ha sido actualizado correctamente.');
    }


    public function destroy(Typedevice $typedevice): RedirectResponse
    {
        $typedevice->delete();
        return redirect()->route('typedevices.index')
                ->withSuccess('Tipo de dispositivo ha sido eliminada correctamente');
    }

}
