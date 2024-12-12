@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<!-- Hero Section -->
<section class="hero-section position-relative">
    <div class="hero-image" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('imagen/pucallpa1.jpg') }}'); background-size: cover; background-position: center; height: 50vh;">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-3 fw-bold mb-4 text-white text-shadow animate__animated animate__fadeInUp">
                        Contáctanos
                    </h1>
                    <p class="lead mb-4 text-white text-shadow animate__animated animate__fadeInUp animate__delay-1s">
                        Estamos aquí para ayudarte a planificar tu próxima aventura
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-section py-5 position-relative" style="margin-top: -50px;">
    <div class="container">
        <div class="row g-4">
            <!-- Contact Information -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg h-100 hover-card">
                    <div class="card-body p-4">
                        <h3 class="h4 mb-4 fw-bold text-primary">Información de Contacto</h3>
                        <div class="contact-info">
                            <div class="d-flex mb-4 align-items-center contact-item">
                                <div class="flex-shrink-0">
                                    <div class="icon-circle bg-primary bg-opacity-10 text-primary">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fw-bold mb-1">Dirección</h5>
                                    <p class="mb-0 text-muted">Av. Principal 123, Iquitos, Perú</p>
                                </div>
                            </div>
                            <div class="d-flex mb-4 align-items-center contact-item">
                                <div class="flex-shrink-0">
                                    <div class="icon-circle bg-primary bg-opacity-10 text-primary">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fw-bold mb-1">Teléfono</h5>
                                    <p class="mb-0 text-muted">+51 123 456 789</p>
                                </div>
                            </div>
                            <div class="d-flex mb-4 align-items-center contact-item">
                                <div class="flex-shrink-0">
                                    <div class="icon-circle bg-primary bg-opacity-10 text-primary">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fw-bold mb-1">Email</h5>
                                    <p class="mb-0 text-muted">info@amazonriver.com</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center contact-item">
                                <div class="flex-shrink-0">
                                    <div class="icon-circle bg-primary bg-opacity-10 text-primary">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fw-bold mb-1">Horario de Atención</h5>
                                    <p class="mb-0 text-muted">Lunes a Viernes: 9:00 AM - 6:00 PM</p>
                                    <p class="mb-0 text-muted">Sábados: 9:00 AM - 1:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg hover-card">
                    <div class="card-body p-4 p-lg-5">
                        <h3 class="h4 mb-4 fw-bold text-primary">Envíanos un mensaje</h3>
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('contacto.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" placeholder="Tu nombre" required>
                                        <label for="name"><i class="fas fa-user me-2"></i>Nombre completo</label>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" placeholder="tu@email.com" required>
                                        <label for="email"><i class="fas fa-envelope me-2"></i>Correo electrónico</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                               id="subject" name="subject" placeholder="Asunto" required>
                                        <label for="subject"><i class="fas fa-heading me-2"></i>Asunto</label>
                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control @error('message') is-invalid @enderror"
                                                  id="message" name="message" placeholder="Tu mensaje"
                                                  style="height: 150px" required></textarea>
                                        <label for="message"><i class="fas fa-comment me-2"></i>Mensaje</label>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100 hover-btn">
                                        <i class="fas fa-paper-plane me-2"></i>Enviar Mensaje
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg overflow-hidden">
                    <div class="card-body p-0">
                        <h2 class="h3 fw-bold text-primary text-center py-4 mb-0 border-bottom">Encuéntranos</h2>
                        <div class="ratio ratio-21x9">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63523.13042453559!2d-73.2800061228027!3d-3.748971546495403!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91ea1086e2cc3c71%3A0x7f1dfe7f16c0d49c!2sIquitos!5e0!3m2!1ses!2spe!4v1638980149169!5m2!1ses!2spe"
                                    style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .text-shadow {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .contact-section {
        z-index: 1;
    }

    .hover-card {
        transition: all 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-5px);
    }

    .icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .contact-item {
        transition: all 0.3s ease;
    }

    .contact-item:hover {
        transform: translateX(5px);
    }

    .form-floating > label {
        padding-left: 1.75rem;
    }

    .form-floating > .form-control {
        padding: 1rem 1rem;
        height: calc(3.5rem + 2px);
        line-height: 1.25;
    }

    .form-floating > textarea.form-control {
        height: 150px;
        resize: none;
    }

    .hover-btn {
        transition: all 0.3s ease;
    }

    .hover-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    @media (max-width: 768px) {
        .hero-image {
            height: 40vh !important;
        }

        .contact-section {
            margin-top: -30px;
        }

        .form-floating > .form-control {
            font-size: 0.9rem;
        }

        .icon-circle {
            width: 40px;
            height: 40px;
            font-size: 1rem;
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
