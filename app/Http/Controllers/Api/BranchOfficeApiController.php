<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BranchOffice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BranchOfficeApiController extends Controller
{
    /**
     * GET /api/branchoffices
     * ?search=  busca en name
     * ?status=  1 activo | 0 inactivo
     * ?per_page= (default 15, max 100)
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = min((int) $request->input('per_page', 15), 100);

        $query = BranchOffice::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->orderBy('name')->paginate($perPage);

        return response()->json([
            'data' => $items->map(fn($b) => [
                'id'     => $b->id,
                'name'   => $b->name,
                'status' => (bool) $b->status,
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
     * POST /api/branchoffices
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'   => 'required|string|max:255|unique:branch_offices,name',
            'status' => 'boolean',
        ]);

        $data['status'] = $data['status'] ?? true;

        $branchoffice = BranchOffice::create($data);

        return response()->json([
            'message' => 'Sucursal creada correctamente.',
            'data'    => ['id' => $branchoffice->id, 'name' => $branchoffice->name, 'status' => (bool) $branchoffice->status],
        ], 201);
    }

    /**
     * PUT /api/branchoffices/{id}
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $branchoffice = BranchOffice::findOrFail($id);

        $data = $request->validate([
            'name'   => 'sometimes|string|max:255|unique:branch_offices,name,' . $id,
            'status' => 'sometimes|boolean',
        ]);

        $branchoffice->update($data);

        return response()->json([
            'message' => 'Sucursal actualizada correctamente.',
            'data'    => ['id' => $branchoffice->id, 'name' => $branchoffice->name, 'status' => (bool) $branchoffice->status],
        ]);
    }
}
