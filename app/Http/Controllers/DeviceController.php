<?php

namespace App\Http\Controllers;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeviceController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('permission:create-device|edit-device|delete-device', ['only' => ['index']]);
        $this->middleware('permission:create-device', ['only' => ['create','store']]);
        $this->middleware('permission:edit-device', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-device', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('devices.index', [
            'devices' => Device::orderBy('id','ASC')->paginate(20)
        ]);
    }
}
