<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeviceApiController extends Controller
{
    /**
     * GET /api/devices
     * Lista dispositivos con paginación y filtros opcionales.
     *
     * Query params opcionales:
     *   ?search=     Busca en serialnumber o anydesknumber
     *   ?status=     1 = activo, 0 = inactivo
     *   ?per_page=   Registros por página (default 15, máx 100)
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = min((int) $request->input('per_page', 15), 100);

        $query = Device::with([
            'typedevice', 'branch_office', 'employee',
            'brand', 'carmodel', 'operatingsystem',
            'microsoftoffice', 'disktype', 'diskstorage', 'ipaddress',
        ]);

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('serialnumber',   'like', '%' . $term . '%')
                  ->orWhere('anydesknumber', 'like', '%' . $term . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $devices = $query->orderByDesc('id')->paginate($perPage);

        return response()->json([
            'data'       => $devices->map(fn($d) => $this->formatDevice($d)),
            'pagination' => [
                'total'        => $devices->total(),
                'per_page'     => $devices->perPage(),
                'current_page' => $devices->currentPage(),
                'last_page'    => $devices->lastPage(),
            ],
        ]);
    }

    /**
     * POST /api/devices
     * Registra un nuevo dispositivo.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'serialnumber'       => 'required|string|max:255|unique:devices,serialnumber',
            'typedevice_id'      => 'required|exists:typedevices,id',
            'branch_office_id'   => 'required|exists:branchoffices,id',
            'brand_id'           => 'required|exists:brands,id',
            'carmodel_id'        => 'nullable|exists:carmodels,id',
            'operatingsystem_id' => 'nullable|exists:operatingsystems,id',
            'microsoftoffice_id' => 'nullable|exists:microsoftoffices,id',
            'diskstorage_id'     => 'nullable|exists:diskstorages,id',
            'disktype_id'        => 'nullable|exists:disktypes,id',
            'ipaddress_id'       => 'nullable|exists:ipaddresses,id',
            'employee_id'        => 'nullable|exists:employees,id',
            'ram'                => 'nullable|string|max:50',
            'anydesknumber'      => 'nullable|string|max:100',
            'datedevicepurchase' => 'nullable|date',
            'devicecomment'      => 'nullable|string|max:1000',
            'status'             => 'boolean',
        ]);

        $data['status'] = $data['status'] ?? true;

        $device = Device::create($data);
        $device->load([
            'typedevice', 'branch_office', 'employee',
            'brand', 'carmodel', 'operatingsystem',
        ]);

        return response()->json([
            'message' => 'Dispositivo registrado correctamente.',
            'data'    => $this->formatDevice($device),
        ], 201);
    }

    private function formatDevice(Device $d): array
    {
        return [
            'id'                 => $d->id,
            'serialnumber'       => $d->serialnumber,
            'anydesknumber'      => $d->anydesknumber,
            'ram'                => $d->ram,
            'status'             => (bool) $d->status,
            'datedevicepurchase' => $d->datedevicepurchase,
            'devicecomment'      => $d->devicecomment,
            'ip'                 => $d->ipaddress?->ip,
            'tipo'               => $d->typedevice?->name,
            'sucursal'           => $d->branch_office?->name,
            'empleado'           => $d->employee?->name,
            'marca'              => $d->brand?->name,
            'modelo'             => $d->carmodel?->name,
            'sistema_operativo'  => $d->operatingsystem?->name,
            'office'             => $d->microsoftoffice?->name,
            'tipo_disco'         => $d->disktype?->name,
            'almacenamiento'     => $d->diskstorage?->name,
        ];
    }
}
