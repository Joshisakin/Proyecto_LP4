@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Nueva Ruta</h1>
        <a href="{{ route('admin.rutas.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left fa-sm"></i> Volver
        </a>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Error</h4>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Información de la Ruta</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.rutas.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="origen" class="form-label">Origen</label>
                            <input type="text"
                                   class="form-control @error('origen') is-invalid @enderror"
                                   id="origen"
                                   name="origen"
                                   value="{{ old('origen') }}"
                                   required>
                            @error('origen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="destino" class="form-label">Destino</label>
                            <input type="text"
                                   class="form-control @error('destino') is-invalid @enderror"
                                   id="destino"
                                   name="destino"
                                   value="{{ old('destino') }}"
                                   required>
                            @error('destino')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fecha_salida" class="form-label">Fecha de Salida</label>
                            <input type="date"
                                   class="form-control @error('fecha_salida') is-invalid @enderror"
                                   id="fecha_salida"
                                   name="fecha_salida"
                                   value="{{ old('fecha_salida', date('Y-m-d')) }}"
                                   min="{{ date('Y-m-d') }}"
                                   required>
                            @error('fecha_salida')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hora_salida" class="form-label">Hora de Salida</label>
                            <input type="time"
                                   class="form-control @error('hora_salida') is-invalid @enderror"
                                   id="hora_salida"
                                   name="hora_salida"
                                   value="{{ old('hora_salida', date('H:i')) }}"
                                   required>
                            @error('hora_salida')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="duracion" class="form-label">Duración (horas)</label>
                            <input type="number"
                                   class="form-control @error('duracion') is-invalid @enderror"
                                   id="duracion"
                                   name="duracion"
                                   value="{{ old('duracion') }}"
                                   step="0.5"
                                   min="0.5"
                                   required>
                            @error('duracion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="precio" class="form-label">Precio (S/.)</label>
                            <div class="input-group">
                                <span class="input-group-text">S/.</span>
                                <input type="number"
                                       class="form-control @error('precio') is-invalid @enderror"
                                       id="precio"
                                       name="precio"
                                       value="{{ old('precio') }}"
                                       step="0.10"
                                       min="0"
                                       required>
                                @error('precio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="capacidad" class="form-label">Capacidad de Pasajeros</label>
                            <input type="number"
                                   class="form-control @error('capacidad') is-invalid @enderror"
                                   id="capacidad"
                                   name="capacidad"
                                   value="{{ old('capacidad') }}"
                                   min="1"
                                   required>
                            @error('capacidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror"
                                  id="descripcion"
                                  name="descripcion"
                                  rows="3">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox"
                               class="form-check-input @error('estado') is-invalid @enderror"
                               id="estado"
                               name="estado"
                               value="1"
                               {{ old('estado', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="estado">Ruta Activa</label>
                        @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Ruta
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validación del formulario
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });

    // Validación de campos numéricos
    const numericInputs = document.querySelectorAll('input[type="number"]');
    numericInputs.forEach(input => {
        input.addEventListener('input', function() {
            const min = parseFloat(this.getAttribute('min'));
            const step = parseFloat(this.getAttribute('step')) || 1;
            let value = parseFloat(this.value);

            if (!isNaN(value) && !isNaN(min) && value < min) {
                this.value = min;
            }

            if (!isNaN(value) && !isNaN(step)) {
                this.value = Math.round(value / step) * step;
            }
        });
    });
});
</script>
@endpush
