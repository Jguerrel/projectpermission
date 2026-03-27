<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountApiController extends Controller
{
    /**
     * GET /api/accounts
     * ?search=  busca en name o link
     * ?status=  1 activo | 0 inactivo
     * ?per_page= (default 15, max 100)
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = min((int) $request->input('per_page', 15), 100);

        $query = Account::query();

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', '%' . $term . '%')
                  ->orWhere('link', 'like', '%' . $term . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $accounts = $query->orderByDesc('id')->paginate($perPage);

        return response()->json([
            'data' => $accounts->map(fn($a) => [
                'id'          => $a->id,
                'name'        => $a->name,
                'link'        => $a->link,
                'description' => $a->description,
                'status'      => (bool) $a->status,
            ]),
            'pagination' => [
                'total'        => $accounts->total(),
                'per_page'     => $accounts->perPage(),
                'current_page' => $accounts->currentPage(),
                'last_page'    => $accounts->lastPage(),
            ],
        ]);
    }
}