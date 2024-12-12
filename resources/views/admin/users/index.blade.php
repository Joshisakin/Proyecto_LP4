@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestión de Usuarios</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus fa-sm"></i> Nuevo Usuario
        </a>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Listado de Usuarios</h6>
            <div class="dropdown no-arrow">
                <button class="btn btn-link btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuButton">
                    <div class="dropdown-header">Exportar:</div>
                    <a class="dropdown-item" href="#" id="exportarPDF">
                        <i class="fas fa-file-pdf fa-sm fa-fw mr-2 text-gray-400"></i>
                        Exportar PDF
                    </a>
                    <a class="dropdown-item" href="#" id="exportarExcel">
                        <i class="fas fa-file-excel fa-sm fa-fw mr-2 text-gray-400"></i>
                        Exportar Excel
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>EMAIL</th>
                            <th>ROL</th>
                            <th>FECHA DE REGISTRO</th>
                            <th>ÚLTIMA ACTUALIZACIÓN</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <div>{{ $user->name }}</div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge {{ $user->role === 'admin' ? 'bg-primary' : 'bg-secondary' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.users.show', $user) }}"
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($user->role !== 'admin')
                                    <form action="{{ route('admin.users.destroy', $user) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-end mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
    font-weight: 600;
}

.badge {
    font-size: 0.75rem;
    padding: 0.5em 0.75em;
    font-weight: 600;
}

.btn-group .btn {
    padding: 0.25rem 0.5rem;
}

.btn-group .btn i {
    font-size: 0.875rem;
}
</style>
@endpush
