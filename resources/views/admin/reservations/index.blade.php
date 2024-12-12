@extends('layouts.admin')

@section('title', 'Gestión de Reservaciones')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reservaciones</h1>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Reservaciones</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Ruta</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->id }}</td>
                            <td>{{ $reservation->user->name }}</td>
                            <td>{{ $reservation->route->origen }} - {{ $reservation->route->destino }}</td>
                            <td>{{ $reservation->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge badge-{{ $reservation->status_color }}">
                                    {{ $reservation->status_text }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.reservations.show', $reservation) }}"
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.reservations.edit', $reservation) }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.reservations.destroy', $reservation) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Está seguro de eliminar esta reservación?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endpush
