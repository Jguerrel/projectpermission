<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Typedevice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TypedeviceApiController extends Controller
{
    /**
     * GET /api/typedevices
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = min((int) $request->input('per_page', 15), 100);

        $query = Typedevice::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->orderBy('name')->paginate($perPage);

        return response()->json([
            'data' => $items->map(fn($t) => [
                'id'     => $t->id,
                'name'   => $t->name,
                'status' => (bool) $t->status,
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
     * POST /api/typedevices
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'   => 'required|string|max:255|unique:typedevices,name',
            'status' => 'boolean',
        ]);

        $data['status'] = $data['status'] ?? true;

        $typedevice = Typedevice::create($data);

        return response()->json([
            'message' => 'Tipo de dispositivo creado correctamente.',
            'data'    => ['id' => $typedevice->id, 'name' => $typedevice->name, 'status' => (bool) $typedevice->status],
        ], 201);
    }

    /**
     * PUT /api/typedevices/{id}
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $typedevice = Typedevice::findOrFail($id);

        $data = $request->validate([
            'name'   => 'sometimes|string|max:255|unique:typedevices,name,' . $id,
            'status' => 'sometimes|boolean',
        ]);

        $typedevice->update($data);

        return response()->json([
            'message' => 'Tipo de dispositivo actualizado correctamente.',
            'data'    => ['id' => $typedevice->id, 'name' => $typedevice->name, 'status' => (bool) $typedevice->status],
        ]);
    }
}