@extends('layouts.app')

@section('title', 'Sobre Nosotros')

@section('content')
<!-- Hero Section -->
<section class="hero-section position-relative">
    <div class="hero-image" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('imagen/pucallpa1.jpg') }}'); background-size: cover; background-position: center; height: 60vh;">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-3 fw-bold mb-4 text-white text-shadow animate__animated animate__fadeInUp">
                        Nuestra Historia
                    </h1>
                    <p class="lead mb-4 text-white text-shadow animate__animated animate__fadeInUp animate__delay-1s">
                        Descubre quiénes somos y nuestra pasión por el Amazonas
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-4 animate__animated animate__fadeInLeft">Nuestra Misión</h2>
                <p class="lead mb-4 text-secondary">
                    En AmazonRiver, nos dedicamos a proporcionar experiencias únicas y sostenibles en el corazón del Amazonas,
                    conectando a viajeros con la magia de la selva mientras preservamos su belleza natural.
                </p>
                <p class="mb-4 text-muted">
                    Nuestro compromiso es ofrecer servicios turísticos de alta calidad que no solo satisfagan las expectativas
                    de nuestros clientes, sino que también contribuyan al desarrollo sostenible de las comunidades locales.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="rounded-4 overflow-hidden shadow-lg animate__animated animate__fadeInRight">
                    <img src="{{ asset('imagen/ruta2.jpeg') }}" alt="Nuestra Misión" class="img-fluid w-100" style="height: 400px; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">Nuestros Valores</h2>
            <p class="lead text-muted col-lg-8 mx-auto">Los principios que guían nuestro trabajo diario</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-card">
                    <div class="card-body p-4 text-center">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3 mx-auto" style="width: 60px; height: 60px; line-height: 60px;">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h3 class="h4 mb-3">Sostenibilidad</h3>
                        <p class="text-muted mb-0">Promovemos prácticas turísticas que respetan y preservan el medio ambiente para las futuras generaciones.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-card">
                    <div class="card-body p-4 text-center">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3 mx-auto" style="width: 60px; height: 60px; line-height: 60px;">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3 class="h4 mb-3">Comunidad</h3>
                        <p class="text-muted mb-0">Trabajamos en estrecha colaboración con las comunidades locales para generar un impacto positivo.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-card">
                    <div class="card-body p-4 text-center">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3 mx-auto" style="width: 60px; height: 60px; line-height: 60px;">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3 class="h4 mb-3">Excelencia</h3>
                        <p class="text-muted mb-0">Nos esforzamos por brindar el mejor servicio y experiencias memorables en cada viaje.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white position-relative overflow-hidden">
    <div class="container position-relative">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="display-5 fw-bold mb-4 animate__animated animate__fadeInUp">¿Listo para la aventura?</h2>
                <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">Únete a nosotros en una experiencia inolvidable en el Amazonas</p>
                <a href="{{ route('rutas.index') }}" class="btn btn-light btn-lg animate__animated animate__fadeInUp animate__delay-2s">
                    <i class="fas fa-compass me-2"></i>Explorar Rutas
                </a>
            </div>
        </div>
    </div>
    <div class="position-absolute top-0 end-0 mt-n4 me-n4" style="opacity: 0.1;">
        <i class="fas fa-compass fa-10x"></i>
    </div>
</section>

@push('styles')
<style>
    .text-shadow {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .hover-card {
        transition: all 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-5px);
    }

    .feature-icon i {
        font-size: 1.5rem;
    }

    @media (max-width: 768px) {
        .hero-image {
            height: 50vh !important;
        }

        .display-3 {
            font-size: 2.5rem;
        }

        .display-5 {
            font-size: 2rem;
        }
    }

    .animate__animated {
        animation-duration: 1s;
    }

    .bg-gradient {
        background: linear-gradient(45deg, var(--bs-primary), #2196f3);
    }
</style>
@endpush
@endsection
