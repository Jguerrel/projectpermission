<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarModelApiController extends Controller
{
    /**
     * GET /api/carmodels
     * ?search=   busca en name
     * ?brand_id= filtra por marca
     * ?status=   1 | 0
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = min((int) $request->input('per_page', 15), 100);

        $query = CarModel::with('brand');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->orderBy('name')->paginate($perPage);

        return response()->json([
            'data' => $items->map(fn($m) => [
                'id'       => $m->id,
                'name'     => $m->name,
                'status'   => (bool) $m->status,
                'brand_id' => $m->brand_id,
                'marca'    => $m->brand?->name,
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
     * POST /api/carmodels
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'status'   => 'boolean',
        ]);

        $data['status'] = $data['status'] ?? true;

        $model = CarModel::create($data);
        $model->load('brand');

        return response()->json([
            'message' => 'Modelo creado correctamente.',
            'data'    => ['id' => $model->id, 'name' => $model->name, 'brand_id' => $model->brand_id, 'marca' => $model->brand?->name, 'status' => (bool) $model->status],
        ], 201);
    }

    /**
     * PUT /api/carmodels/{id}
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $model = CarModel::findOrFail($id);

        $data = $request->validate([
            'name'     => 'sometimes|string|max:255',
            'brand_id' => 'sometimes|exists:brands,id',
            'status'   => 'sometimes|boolean',
        ]);

        $model->update($data);
        $model->load('brand');

        return response()->json([
            'message' => 'Modelo actualizado correctamente.',
            'data'    => ['id' => $model->id, 'name' => $model->name, 'brand_id' => $model->brand_id, 'marca' => $model->brand?->name, 'status' => (bool) $model->status],
        ]);
    }
}