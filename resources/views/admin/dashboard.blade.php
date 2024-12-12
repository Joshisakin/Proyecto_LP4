@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="{{ route('admin.reports.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Rutas Activas Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Rutas Activas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['active_routes'] ?? 0 }}</div>
                            @if(isset($stats['routes_change']))
                            <div class="text-xs mt-2 {{ $stats['routes_change'] >= 0 ? 'text-success' : 'text-danger' }}">
                                <i class="fas fa-{{ $stats['routes_change'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                                {{ abs($stats['routes_change']) }}% desde el mes pasado
                            </div>
                            @endif
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-route fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ingresos Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Ingresos Totales</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">S/. {{ number_format($stats['total_revenue'] ?? 0, 2) }}</div>
                            @if(isset($stats['revenue_change']))
                            <div class="text-xs mt-2 {{ $stats['revenue_change'] >= 0 ? 'text-success' : 'text-danger' }}">
                                <i class="fas fa-{{ $stats['revenue_change'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                                {{ abs($stats['revenue_change']) }}% desde el mes pasado
                            </div>
                            @endif
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reservas Pendientes Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Reservas Pendientes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending_reservations'] ?? 0 }}</div>
                            @if(isset($stats['reservations_change']))
                            <div class="text-xs mt-2 {{ $stats['reservations_change'] >= 0 ? 'text-success' : 'text-danger' }}">
                                <i class="fas fa-{{ $stats['reservations_change'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                                {{ abs($stats['reservations_change']) }}% desde el mes pasado
                            </div>
                            @endif
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Usuarios Registrados Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Usuarios Registrados</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_users'] ?? 0 }}</div>
                            @if(isset($stats['users_change']))
                            <div class="text-xs mt-2 {{ $stats['users_change'] >= 0 ? 'text-success' : 'text-danger' }}">
                                <i class="fas fa-{{ $stats['users_change'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                                {{ abs($stats['users_change']) }}% desde el mes pasado
                            </div>
                            @endif
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Últimas Rutas -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Últimas Rutas</h6>
                    <a href="{{ route('admin.rutas.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus fa-sm"></i> Nueva Ruta
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Origen</th>
                                    <th>Destino</th>
                                    <th>Fecha</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latest_routes as $route)
                                <tr>
                                    <td>{{ $route->origen }}</td>
                                    <td>{{ $route->destino }}</td>
                                    <td>{{ $route->fecha_salida->format('d/m/Y H:i') }}</td>
                                    <td>S/. {{ number_format($route->precio, 2) }}</td>
                                    <td>
                                        <span class="badge badge-{{ $route->estado ? 'success' : 'danger' }}">
                                            {{ $route->estado ? 'Activa' : 'Inactiva' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.rutas.edit', $route) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No hay rutas registradas</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Últimos Usuarios -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Últimos Usuarios</h6>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm">
                        Ver Todos
                    </a>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @forelse($latest_users as $user)
                        <div class="list-group-item border-0 px-0">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3 ps-3">
                                    <h6 class="mb-0">{{ $user->name }}</h6>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                                <div class="text-muted small">
                                    {{ $user->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-3">
                            <p class="mb-0 text-muted">No hay usuarios registrados</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
