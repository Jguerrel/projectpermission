<?php

namespace App\Http\Controllers;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
         $this->middleware('permission:create-account|edit-account|delete-account', ['only' => ['index']]);
         $this->middleware('permission:create-account', ['only' => ['create','store']]);
         $this->middleware('permission:edit-account', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-account', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('account.index', [
            'accounts' => Account::orderBy('id','ASC')->paginate(20)
        ]);
    }

}
