<?php

namespace App\Http\Controllers;
use App\Models\Jobtitle;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateCargoRequest;
use App\Http\Requests\StoreCargoRequest;
use DataTables;

class JobTitleController extends Controller
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
        return view('jobtitles.index', [
            'jobtitles' => jobtitle::orderBy('id','ASC')->paginate(10)
        ]);
    }

    public function pagination()
    {

        if(request()->ajax()) {

	        return Datatables()->of(jobtitle::select('*'))
	        ->addColumn('action', 'blog-action')
	        ->rawColumns(['action'])
	        ->addIndexColumn()
	        ->make(true);
	    }
        return view('jobtitles.pagination', compact('jobtitles'));

    }

    public function create(): View
    {
        return view('jobtitles.create');

    }
    public function store(StoreCargoRequest $request): RedirectResponse
    {
        jobtitle::create($request->all());
        return redirect()->route('jobtitles.index')
        ->with('success','Cargo creado correctamente');

    }
    public function show(Jobtitle $jobtitle)
    {
        return view('jobtitles.show', [
            'jobtitle' => $jobtitle
        ]);
    }

    public function edit(Jobtitle $jobtitle)
    {
        return view('jobtitles.edit', [
            'jobtitle' => $jobtitle
        ]);
    }
    public function update(UpdateCargoRequest $request, Jobtitle $jobtitle): RedirectResponse
    {
        $jobtitle->update($request->all());
        return redirect()->route('jobtitles.index')
                ->withSuccess('Cargo ha sido actualizado correctamente.');
    }

    public function destroy(Jobtitle $jobtitle): RedirectResponse
    {
        $jobtitle->delete();
        return redirect()->route('jobtitles.index')
                ->withSuccess('Cargo ha sido eliminado correctamente.');
    }

}
