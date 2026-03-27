<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ipaddress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IpaddressApiController extends Controller
{
    /**
     * GET /api/ipaddresses
     * ?search=          busca en ip
     * ?branch_office_id= filtra por sucursal
     * ?status=          1 | 0
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = min((int) $request->input('per_page', 15), 100);

        $query = Ipaddress::with('branch_office');

        if ($request->filled('search')) {
            $query->where('ip', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('branch_office_id')) {
            $query->where('branch_office_id', $request->branch_office_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->orderBy('ip')->paginate($perPage);

        return response()->json([
            'data' => $items->map(fn($i) => [
                'id'       => $i->id,
                'ip'       => $i->ip,
                'status'   => (bool) $i->status,
                'sucursal' => $i->branch_office?->name,
            ]),
            'pagination' => [
                'total'        => $items->total(),
                'per_page'     => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page'    => $items->lastPage(),
            ],
        ]);
    }

    /**
     * POST /api/ipaddresses
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'ip'               => 'required|string|max:45|unique:ipaddresses,ip',
            'branch_office_id' => 'required|exists:branchoffices,id',
            'status'           => 'boolean',
        ]);

        $data['status'] = $data['status'] ?? true;

        $ip = Ipaddress::create($data);
        $ip->load('branch_office');

        return response()->json([
            'message' => 'Dirección IP creada correctamente.',
            'data'    => ['id' => $ip->id, 'ip' => $ip->ip, 'sucursal' => $ip->branch_office?->name, 'status' => (bool) $ip->status],
        ], 201);
    }

    /**
     * PUT /api/ipaddresses/{id}
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $ip = Ipaddress::findOrFail($id);

        $data = $request->validate([
            'ip'               => 'sometimes|string|max:45|unique:ipaddresses,ip,' . $id,
            'branch_office_id' => 'sometimes|exists:branchoffices,id',
            'status'           => 'sometimes|boolean',
        ]);

        $ip->update($data);
        $ip->load('branch_office');

        return response()->json([
            'message' => 'Dirección IP actualizada correctamente.',
            'data'    => ['id' => $ip->id, 'ip' => $ip->ip, 'sucursal' => $ip->branch_office?->name, 'status' => (bool) $ip->status],
        ]);
    }
}