<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeApiController extends Controller
{
    /**
     * GET /api/employees
     * ?search=        busca en name o usrcod
     * ?department_id= filtra por departamento
     * ?status=        1 | 0
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = min((int) $request->input('per_page', 15), 100);

        $query = Employee::with('department', 'jobtitle');

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('name',   'like', '%' . $term . '%')
                  ->orWhere('usrcod', 'like', '%' . $term . '%');
            });
        }

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->orderBy('name')->paginate($perPage);

        return response()->json([
            'data' => $items->map(fn($e) => $this->format($e)),
            'pagination' => [
                'total'        => $items->total(),
                'per_page'     => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page'    => $items->lastPage(),
            ],
        ]);
    }

    /**
     * POST /api/employees
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'jobtitle_id'   => 'required|exists:jobtitles,id',
            'usrcod'        => 'nullable|string|max:100',
            'status'        => 'boolean',
        ]);

        $data['status'] = $data['status'] ?? true;

        $employee = Employee::create($data);
        $employee->load('department', 'jobtitle');

        return response()->json([
            'message' => 'Colaborador creado correctamente.',
            'data'    => $this->format($employee),
        ], 201);
    }

    /**
     * PUT /api/employees/{id}
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $employee = Employee::findOrFail($id);

        $data = $request->validate([
            'name'          => 'sometimes|string|max:255',
            'department_id' => 'sometimes|exists:departments,id',
            'jobtitle_id'   => 'sometimes|exists:jobtitles,id',
            'usrcod'        => 'sometimes|nullable|string|max:100',
            'status'        => 'sometimes|boolean',
        ]);

        $employee->update($data);
        $employee->load('department', 'jobtitle');

        return response()->json([
            'message' => 'Colaborador actualizado correctamente.',
            'data'    => $this->format($employee),
        ]);
    }

    private function format(Employee $e): array
    {
        return [
            'id'          => $e->id,
            'name'        => $e->name,
            'usrcod'      => $e->usrcod,
            'status'      => (bool) $e->status,
            'departamento' => $e->department?->name,
            'cargo'       => $e->jobtitle?->name,
        ];
    }
}