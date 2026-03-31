<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BrandApiController extends Controller
{
    /**
     * GET /api/brands
     * ?search=  busca en name
     * ?status=  1 activo | 0 inactivo
     * ?per_page= (default 15, max 100)
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = min((int) $request->input('per_page', 15), 100);

        $query = Brand::query();

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
     * POST /api/brands
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'   => 'required|string|max:255|unique:brands,name',
            'status' => 'boolean',
        ]);

        $data['status'] = $data['status'] ?? true;

        $brand = Brand::create($data);

        return response()->json([
            'message' => 'Marca creada correctamente.',
            'data'    => ['id' => $brand->id, 'name' => $brand->name, 'status' => (bool) $brand->status],
        ], 201);
    }

    /**
     * PUT /api/brands/{id}
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $brand = Brand::findOrFail($id);

        $data = $request->validate([
            'name'   => 'sometimes|string|max:255|unique:brands,name,' . $id,
            'status' => 'sometimes|boolean',
        ]);

        $brand->update($data);

        return response()->json([
            'message' => 'Marca actualizada correctamente.',
            'data'    => ['id' => $brand->id, 'name' => $brand->name, 'status' => (bool) $brand->status],
        ]);
    }
}
