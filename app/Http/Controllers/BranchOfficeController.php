<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use App\Models\BranchOffice;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class BranchOfficeController extends Controller
{


    public function __construct()
    {

        $this->middleware('auth');
         $this->middleware('permission:create-sucursal|edit-sucursal|delete-sucursal', ['only' => ['index']]);
         $this->middleware('permission:create-sucursal', ['only' => ['create','store']]);
         $this->middleware('permission:edit-sucursal', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-sucursal', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        // return view('branch_offices.index', [
        //     'branchoffices' => BranchOffice::orderBy('id','ASC')->paginate(20)
        // ]);
        $branchoffices = BranchOffice::with('branch')
        ->orderBy('id','DESC')
        ->paginate(10);

        return view('branchoffices.index', compact('branchoffices'));
    }

}
