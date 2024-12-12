@extends('layouts.app')

@section('content')
<!-- Hero Carousel -->
<div class="row">
    <div class="col-12 px-0">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('imagen/Iquitos.jpg') }}" class="d-block w-100" alt="Iquitos" style="height: 70vh; object-fit: cover;">
                    <div class="carousel-caption" style="background: rgba(0,0,0,0.5); padding: 2rem; border-radius: 1rem;">
                        <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">
                            Descubre Iquitos
                        </h1>
                        <p class="lead animate__animated animate__fadeInUp animate__delay-1s">
                            La puerta de entrada a la Amazonía peruana
                        </p>
                        <a href="{{ route('rutas.index') }}" class="btn btn-primary btn-lg animate__animated animate__fadeInUp animate__delay-2s">
                            <i class="fas fa-compass me-2"></i>Explorar Destino
                        </a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('imagen/Requenna.jpg') }}" class="d-block w-100" alt="Requena" style="height: 70vh; object-fit: cover;">
                    <div class="carousel-caption" style="background: rgba(0,0,0,0.5); padding: 2rem; border-radius: 1rem;">
                        <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">
                            Explora Requena
                        </h1>
                        <p class="lead animate__animated animate__fadeInUp animate__delay-1s">
                            Un tesoro escondido en la selva
                        </p>
                        <a href="{{ route('rutas.index') }}" class="btn btn-primary btn-lg animate__animated animate__fadeInUp animate__delay-2s">
                            <i class="fas fa-compass me-2"></i>Explorar Destino
                        </a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('imagen/CaballoCocha.jpg') }}" class="d-block w-100" alt="Caballo Cocha" style="height: 70vh; object-fit: cover;">
                    <div class="carousel-caption" style="background: rgba(0,0,0,0.5); padding: 2rem; border-radius: 1rem;">
                        <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">
                            Visita Caballo Cocha
                        </h1>
                        <p class="lead animate__animated animate__fadeInUp animate__delay-1s">
                            Naturaleza en su máxima expresión
                        </p>
                        <a href="{{ route('rutas.index') }}" class="btn btn-primary btn-lg animate__animated animate__fadeInUp animate__delay-2s">
                            <i class="fas fa-compass me-2"></i>Explorar Destino
                        </a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>
</div>

<!-- Rutas Section -->
<div class="container py-5">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h2 class="display-5 fw-bold">Próximas Rutas</h2>
            <p class="lead text-muted">Descubre nuestros próximos viajes y asegura tu lugar</p>
        </div>
    </div>

    <div class="row g-4">
        @php
            $rutas = $rutas ?? \App\Models\Route::available()
                ->orderBy('fecha_salida')
                ->limit(3)
                ->get();
        @endphp

        @forelse($rutas as $ruta)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 hover-shadow">
                    <div class="position-relative">
                        <img src="{{ $ruta->image_url }}"
                             class="card-img-top"
                             alt="Ruta {{ $ruta->origen }} - {{ $ruta->destino }}"
                             style="height: 200px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-primary rounded-pill">
                                {{ $ruta->boat_type }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <h5 class="card-title mb-0 fw-bold">
                                {{ $ruta->origen }} → {{ $ruta->destino }}
                            </h5>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="far fa-calendar text-primary me-2"></i>
                                <span>{{ $ruta->fecha_salida->format('d/m/Y g:i A') }}</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-users text-primary me-2"></i>
                                <span>{{ $ruta->asientos_disponibles }} asientos disponibles</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="far fa-clock text-primary me-2"></i>
                                <span>Duración: {{ number_format($ruta->duracion, 1) }} horas</span>
                            </div>
                        </div>

                        <hr class="my-3">

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-primary">
                                <span class="fs-6">Desde</span>
                                <span class="fs-4 fw-bold ms-1">S/.{{ number_format($ruta->precio, 2) }}</span>
                            </div>
                            <a href="{{ route('reservations.create', ['ruta_id' => $ruta->id]) }}"
                               class="btn btn-primary">
                                <i class="fas fa-ticket-alt me-1"></i>
                                Reservar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>
                    No hay rutas disponibles en este momento
                </div>
            </div>
        @endforelse
    </div>
</div>

@push('styles')
<style>
    .carousel-item img {
        filter: brightness(0.8);
    }

    .carousel-caption {
        bottom: 50%;
        transform: translateY(50%);
        max-width: 800px;
        margin: 0 auto;
        left: 10%;
        right: 10%;
    }

    @media (max-width: 768px) {
        .carousel-caption {
            padding: 1rem !important;
        }
        .carousel-caption h1 {
            font-size: 2rem;
        }
        .carousel-caption p {
            font-size: 1rem;
        }
        .carousel-caption .btn {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }
    }

    .hover-shadow {
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .badge {
        font-weight: 500;
        padding: 0.5em 1em;
    }

    .btn-primary {
        font-weight: 500;
        padding: 0.5rem 1.25rem;
        border-radius: 0.5rem;
    }

    hr {
        opacity: 0.1;
    }
</style>
@endpush
@endsection
