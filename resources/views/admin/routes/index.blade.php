@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestión de Rutas</h1>
        <a href="{{ route('admin.rutas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus fa-sm"></i> Nueva Ruta
        </a>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Listado de Rutas</h6>
            <div class="dropdown no-arrow">
                <button class="btn btn-link btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuButton">
                    <div class="dropdown-header">Acciones:</div>
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
                            <th>ORIGEN</th>
                            <th>DESTINO</th>
                            <th>FECHA/HORA</th>
                            <th>DURACIÓN</th>
                            <th>PRECIO</th>
                            <th>CAPACIDAD</th>
                            <th>DISPONIBLES</th>
                            <th>ESTADO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($routes as $route)
                        <tr>
                            <td>{{ $route->origen }}</td>
                            <td>{{ $route->destino }}</td>
                            <td>{{ $route->fecha_salida->format('d/m/Y H:i') }}</td>
                            <td>{{ number_format($route->duracion, 1) }} hrs</td>
                            <td>S/ {{ number_format($route->precio, 2) }}</td>
                            <td>{{ $route->capacidad }}</td>
                            <td>
                                <span class="badge bg-success">{{ $route->capacidad }}</span>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                           id="estado{{ $route->id }}"
                                           {{ $route->estado ? 'checked' : '' }}
                                           onchange="cambiarEstado({{ $route->id }})">
                                </div>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.rutas.edit', $route) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.rutas.destroy', $route) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de eliminar esta ruta?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-end mt-3">
                {{ $routes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function cambiarEstado(routeId) {
    const checkbox = document.getElementById('estado' + routeId);
    const estado = checkbox.checked;

    // Aquí puedes agregar la lógica para actualizar el estado mediante AJAX
    fetch(`/admin/rutas/${routeId}/toggle-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ estado: estado })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mostrar mensaje de éxito
            alert('Estado actualizado correctamente');
        } else {
            // Si hay error, revertir el cambio
            checkbox.checked = !estado;
            alert('Error al actualizar el estado');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        checkbox.checked = !estado;
        alert('Error al actualizar el estado');
    });
}
</script>
@endpush
