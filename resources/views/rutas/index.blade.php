@extends('layouts.app')

@section('title', 'Rutas Disponibles')

@section('content')
<!-- Hero Section -->
<section class="hero-section position-relative bg-primary bg-gradient text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInUp">Rutas Disponibles</h1>
                <p class="lead mb-0 animate__animated animate__fadeInUp animate__delay-1s">
                    Encuentra tu próximo destino en la Amazonía
                </p>
            </div>
        </div>
    </div>
    <div class="position-absolute top-0 end-0 mt-3 me-5 text-white-50" style="opacity: 0.1;">
        <i class="fas fa-ship fa-10x"></i>
    </div>
</section>

<!-- Search Section -->
<section class="search-section position-relative" style="margin-top: -30px; z-index: 1;">
    <div class="container">
        <div class="card border-0 shadow-lg">
            <div class="card-body p-4">
                <form action="{{ route('rutas.search') }}" method="GET" class="needs-validation" novalidate>
                    <div class="row g-4">
                        <div class="col-md-5">
                            <div class="form-floating">
                                <input type="text"
                                       class="form-control"
                                       id="origen"
                                       name="origen"
                                       placeholder="Ciudad de origen"
                                       value="{{ request('origen') }}">
                                <label for="origen">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>Ciudad de origen
                                </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-floating">
                                <input type="text"
                                       class="form-control"
                                       id="destino"
                                       name="destino"
                                       placeholder="Ciudad de destino"
                                       value="{{ request('destino') }}">
                                <label for="destino">
                                    <i class="fas fa-map-marker text-primary me-2"></i>Ciudad de destino
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 d-grid">
                            <button type="submit" class="btn btn-primary btn-lg h-100 hover-btn">
                                <i class="fas fa-search me-2"></i>Buscar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Routes Section -->
<section class="routes-section py-5">
    <div class="container">
        @if($rutas->isEmpty())
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="alert alert-info border-0 shadow-sm p-4">
                        <i class="fas fa-info-circle fa-2x mb-3 text-primary"></i>
                        <h4 class="alert-heading">No hay rutas disponibles</h4>
                        <p class="mb-0">No se encontraron rutas disponibles con los criterios especificados. Por favor, intenta con diferentes destinos.</p>
                    </div>
                </div>
            </div>
        @else
            <div class="row g-4">
                @foreach($rutas as $ruta)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-lg hover-card">
                            <div class="position-relative">
                                <img src="{{ $ruta->image_url }}"
                                     class="card-img-top"
                                     alt="Ruta {{ $ruta->origen }} - {{ $ruta->destino }}"
                                     style="height: 200px; object-fit: cover;">
                                @if($ruta->boat_type)
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-primary rounded-pill">
                                            <i class="fas fa-ship me-1"></i>{{ $ruta->boat_type }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0 fw-bold text-primary">
                                        <i class="fas fa-route me-2"></i>{{ $ruta->origen }}
                                    </h5>
                                </div>
                                <div class="text-center my-3">
                                    <i class="fas fa-long-arrow-alt-right fa-2x text-primary"></i>
                                </div>
                                <h5 class="text-end mb-0 fw-bold text-primary">
                                    <i class="fas fa-map-marker-alt me-2"></i>{{ $ruta->destino }}
                                </h5>
                            </div>

                            <div class="card-body p-4">
                                <div class="route-info">
                                    <div class="d-flex align-items-center mb-3 info-item">
                                        <div class="icon-circle bg-primary bg-opacity-10 text-primary me-3">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Salida</small>
                                            <strong>{{ $ruta->fecha_salida->format('d/m/Y H:i') }}</strong>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3 info-item">
                                        <div class="icon-circle bg-primary bg-opacity-10 text-primary me-3">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Llegada</small>
                                            <strong>{{ $ruta->fecha_llegada->format('d/m/Y H:i') }}</strong>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3 info-item">
                                        <div class="icon-circle bg-primary bg-opacity-10 text-primary me-3">
                                            <i class="fas fa-hourglass-half"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Duración</small>
                                            <strong>{{ number_format($ruta->duracion, 1) }} horas</strong>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center info-item">
                                        <div class="icon-circle bg-primary bg-opacity-10 text-primary me-3">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Asientos disponibles</small>
                                            <strong>{{ $ruta->asientos_disponibles }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-white border-0 p-4">
                                <hr class="my-3 opacity-10">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="price-tag">
                                        <small class="text-muted d-block">Precio por persona</small>
                                        <span class="fs-4 fw-bold text-primary">{{ $ruta->getFormattedPrice() }}</span>
                                    </div>
                                    <a href="{{ route('reservations.create', ['ruta_id' => $ruta->id]) }}"
                                       class="btn btn-primary hover-btn">
                                        <i class="fas fa-ticket-alt me-2"></i>Reservar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $rutas->links() }}
            </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    .hero-section {
        position: relative;
        overflow: hidden;
    }

    .search-section .form-control {
        border: 1px solid rgba(0,0,0,0.1);
        padding: 1rem;
    }

    .search-section .form-control:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
    }

    .hover-card {
        transition: all 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-5px);
    }

    .icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .info-item {
        transition: all 0.3s ease;
    }

    .info-item:hover {
        transform: translateX(5px);
    }

    .hover-btn {
        transition: all 0.3s ease;
    }

    .hover-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .form-floating > label {
        padding-left: 1.75rem;
    }

    @media (max-width: 768px) {
        .hero-section {
            text-align: center;
            padding: 3rem 0;
        }

        .search-section {
            margin-top: -20px;
        }

        .card-header {
            text-align: center;
        }

        .card-header .badge {
            margin-top: 1rem;
            display: block;
        }

        .info-item {
            padding: 0.5rem;
        }

        .icon-circle {
            width: 35px;
            height: 35px;
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Validación del formulario
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endpush
@endsection
