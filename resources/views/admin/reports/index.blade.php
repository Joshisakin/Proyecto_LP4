@extends('layouts.admin')

@section('title', 'Reportes')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reportes</h1>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Usuarios Totales</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_users'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Rutas Activas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_routes'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-route fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Reservaciones Totales</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_reservations'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Ingresos Totales</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">S/. {{ number_format($stats['total_revenue'], 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Reservaciones por Mes -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Reservaciones por Mes</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="reservationsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rutas Populares -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rutas más Populares</h6>
                </div>
                <div class="card-body">
                    @foreach($popularRoutes as $route)
                    <div class="mb-3">
                        <h4 class="small font-weight-bold">
                            {{ $route->origen }} - {{ $route->destino }}
                            <span class="float-right">{{ $route->reservations_count }} reservas</span>
                        </h4>
                        <div class="progress">
                            @php
                                $percentage = ($route->reservations_count / max($popularRoutes->max('reservations_count'), 1)) * 100;
                            @endphp
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Generador de Reportes -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Generar Reporte</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.reports.generate') }}" method="POST" class="row">
                @csrf
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="type">Tipo de Reporte</label>
                        <select name="type" id="type" class="form-control">
                            <option value="sales">Ventas</option>
                            <option value="reservations">Reservaciones</option>
                            <option value="routes">Rutas</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="start_date">Fecha Inicial</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="end_date">Fecha Final</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="d-block">&nbsp;</label>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const months = @json($reservationsByMonth->pluck('month'));
    const totals = @json($reservationsByMonth->pluck('total'));

    const monthNames = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                       'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    const ctx = document.getElementById('reservationsChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months.map(m => monthNames[m-1]),
            datasets: [{
                label: 'Reservaciones',
                data: totals,
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7,
                        padding: 10
                    }
                }
            }
        }
    });
});
</script>
@endpush
