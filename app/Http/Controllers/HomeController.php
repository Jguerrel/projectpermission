<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ipaddress;
use App\Models\Device;
use App\Models\BranchOffice;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $branches = BranchOffice::orderBy('name')->get();

        $ipStats = $this->getIpStats(null);

        $devicesByBrand = Device::select('brand_id', DB::raw('count(*) as total'))
            ->with('brand')
            ->groupBy('brand_id')
            ->get()
            ->map(fn($d) => [
                'label' => $d->brand->name ?? 'Sin marca',
                'count' => $d->total,
            ]);

        $devicesByModel = Device::select('carmodel_id', DB::raw('count(*) as total'))
            ->with('carmodel')
            ->groupBy('carmodel_id')
            ->get()
            ->map(fn($d) => [
                'label' => $d->carmodel->name ?? 'Sin modelo',
                'count' => $d->total,
            ]);

        return view('home', compact('branches', 'ipStats', 'devicesByBrand', 'devicesByModel'));
    }

    /**
     * AJAX: IP stats filtered by branch.
     */
    public function ipStats(Request $request)
    {
        $branchId = $request->input('branch_id');
        return response()->json($this->getIpStats($branchId));
    }

    private function getIpStats($branchId)
    {
        $query = Ipaddress::query();
        if ($branchId) {
            $query->where('branch_office_id', $branchId);
        }

        $total      = (clone $query)->count();
        $ocupadas   = (clone $query)->whereHas('device')->count();
        $disponibles = $total - $ocupadas;

        return [
            'total'      => $total,
            'disponibles' => $disponibles,
            'ocupadas'   => $ocupadas,
        ];
    }
}
