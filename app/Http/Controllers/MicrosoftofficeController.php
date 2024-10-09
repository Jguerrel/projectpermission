<?php

namespace App\Http\Controllers;

use App\Models\Microsoftoffice;
use App\Http\Requests\StoreMicrosoftofficeRequest;
use App\Http\Requests\UpdateMicrosoftofficeRequest;

class MicrosoftofficeController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
         $this->middleware('permission:ver-licenciaoffice', ['only' => ['index']]);
         $this->middleware('permission:crear-licenciaoffice', ['only' => ['create','store']]);
         $this->middleware('permission:editar-licenciaoffice', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-licenciaoffice', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('microsoftoffice.index', [
            'microsoftoffices' => microsoftoffice::orderBy('id','ASC')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMicrosoftofficeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Microsoftoffice $microsoftoffice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Microsoftoffice $microsoftoffice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMicrosoftofficeRequest $request, Microsoftoffice $microsoftoffice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Microsoftoffice $microsoftoffice)
    {
        //
    }
}
