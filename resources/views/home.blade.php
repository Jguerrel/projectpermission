@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</h1>
@stop

@section('css')
<style>
    .ip-card {
        border-radius: 10px;
        transition: transform .15s;
    }
    .ip-card:hover {
        transform: translateY(-3px);
    }
    .stat-number {
        font-size: 2.4rem;
        font-weight: 700;
        line-height: 1;
    }
    .ip-progress-wrap {
        background: #e9ecef;
        border-radius: 8px;
        height: 14px;
        overflow: hidden;
    }
    .ip-progress-bar {
        height: 14px;
        border-radius: 8px;
        transition: width .5s ease;
    }
    .chart-container {
        position: relative;
        height: 300px;
    }
</style>
@stop

@section('content')

{{-- ====================== IP DASHBOARD ====================== --}}
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header d-flex align-items-center">
                <h3 class="card-title mr-3"><i class="fas fa-network-wired mr-1"></i> Dashboard de IPs</h3>
                <div class="ml-auto" style="min-width:220px;">
                    <select id="branchFilter" class="form-control form-control-sm">
                        <option value="">Todas las sucursales</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div class="row" id="ipStatsRow">
                    {{-- Total --}}
                    <div class="col-12 col-sm-4 mb-3">
                        <div class="card ip-card bg-gradient-info text-white mb-0 h-100">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="text-uppercase small mb-1" style="letter-spacing:.05em;">Total IPs</div>
                                        <div class="stat-number" id="statTotal">{{ $ipStats['total'] }}</div>
                                    </div>
                                    <i class="fas fa-server fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Disponibles --}}
                    <div class="col-12 col-sm-4 mb-3">
                        <div class="card ip-card bg-gradient-success text-white mb-0 h-100">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="text-uppercase small mb-1" style="letter-spacing:.05em;">Disponibles</div>
                                        <div class="stat-number" id="statDisponibles">{{ $ipStats['disponibles'] }}</div>
                                    </div>
                                    <i class="fas fa-check-circle fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Ocupadas --}}
                    <div class="col-12 col-sm-4 mb-3">
                        <div class="card ip-card bg-gradient-danger text-white mb-0 h-100">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="text-uppercase small mb-1" style="letter-spacing:.05em;">Ocupadas</div>
                                        <div class="stat-number" id="statOcupadas">{{ $ipStats['ocupadas'] }}</div>
                                    </div>
                                    <i class="fas fa-desktop fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Barra de progreso --}}
                <div class="mt-2">
                    <div class="d-flex justify-content-between small text-muted mb-1">
                        <span>Ocupación</span>
                        <span id="ocupacionPct">
                            @if($ipStats['total'] > 0)
                                {{ round(($ipStats['ocupadas'] / $ipStats['total']) * 100) }}%
                            @else
                                0%
                            @endif
                        </span>
                    </div>
                    <div class="ip-progress-wrap">
                        <div class="ip-progress-bar bg-danger" id="ocupacionBar"
                             style="width: {{ $ipStats['total'] > 0 ? round(($ipStats['ocupadas'] / $ipStats['total']) * 100) : 0 }}%">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between small mt-1">
                        <span class="text-success"><i class="fas fa-circle mr-1"></i>Disponibles</span>
                        <span class="text-danger"><i class="fas fa-circle mr-1"></i>Ocupadas</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ====================== GRÁFICOS ====================== --}}
<div class="row">
    {{-- Pie: Dispositivos por Marca --}}
    <div class="col-12 col-lg-6">
        <div class="card card-outline card-warning">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i> Dispositivos por Marca</h3>
            </div>
            <div class="card-body">
                @if($devicesByBrand->isEmpty())
                    <p class="text-muted text-center">No hay datos de dispositivos.</p>
                @else
                    <div class="chart-container">
                        <canvas id="chartBrand"></canvas>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Pie: Dispositivos por Modelo --}}
    <div class="col-12 col-lg-6">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i> Dispositivos por Modelo</h3>
            </div>
            <div class="card-body">
                @if($devicesByModel->isEmpty())
                    <p class="text-muted text-center">No hay datos de dispositivos.</p>
                @else
                    <div class="chart-container">
                        <canvas id="chartModel"></canvas>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Accesos rápidos existentes --}}
@if (session('status'))
    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
@endif

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// ── Colores ──────────────────────────────────────────────────────────────
const PALETTE = [
    '#4dc9f6','#f67019','#f53794','#537bc4','#acc236',
    '#166a8f','#00a950','#58595b','#8549ba','#e8c13a',
    '#d45f5f','#6bcba5','#b5a4d4','#f7c59f','#a8dadc'
];

function colorSlice(n) {
    const colors = [];
    for (let i = 0; i < n; i++) colors.push(PALETTE[i % PALETTE.length]);
    return colors;
}

// ── Pie: Marcas ──────────────────────────────────────────────────────────
@if(!$devicesByBrand->isEmpty())
(function () {
    const labels = {!! $devicesByBrand->pluck('label')->toJson() !!};
    const data   = {!! $devicesByBrand->pluck('count')->toJson() !!};
    new Chart(document.getElementById('chartBrand'), {
        type: 'pie',
        data: {
            labels,
            datasets: [{
                data,
                backgroundColor: colorSlice(data.length),
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    callbacks: {
                        label: ctx => ` ${ctx.label}: ${ctx.parsed} dispositivo(s)`
                    }
                }
            }
        }
    });
})();
@endif

// ── Pie: Modelos ─────────────────────────────────────────────────────────
@if(!$devicesByModel->isEmpty())
(function () {
    const labels = {!! $devicesByModel->pluck('label')->toJson() !!};
    const data   = {!! $devicesByModel->pluck('count')->toJson() !!};
    new Chart(document.getElementById('chartModel'), {
        type: 'pie',
        data: {
            labels,
            datasets: [{
                data,
                backgroundColor: colorSlice(data.length),
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    callbacks: {
                        label: ctx => ` ${ctx.label}: ${ctx.parsed} dispositivo(s)`
                    }
                }
            }
        }
    });
})();
@endif

// ── Filtro de sucursal (AJAX) ─────────────────────────────────────────────
document.getElementById('branchFilter').addEventListener('change', function () {
    const branchId = this.value;
    const url = '{{ route("home.ipStats") }}' + (branchId ? '?branch_id=' + branchId : '');

    fetch(url, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(data => {
        document.getElementById('statTotal').textContent       = data.total;
        document.getElementById('statDisponibles').textContent = data.disponibles;
        document.getElementById('statOcupadas').textContent    = data.ocupadas;

        const pct = data.total > 0 ? Math.round((data.ocupadas / data.total) * 100) : 0;
        document.getElementById('ocupacionBar').style.width = pct + '%';
        document.getElementById('ocupacionPct').textContent = pct + '%';
    });
});
</script>
@stop
