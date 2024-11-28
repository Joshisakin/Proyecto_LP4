@extends('layouts.app')

@section('title', 'Inicio - AmazonRiver')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
    <!-- Sección de Bienvenida -->
    <div class="bienvenida-impactante" style="background-image: url('https://www.turiweb.pe/wp-content/uploads/2024/03/ferry-070324.jpg'); background-size: cover; background-position: center;">
        <div class="bienvenida-overlay"></div>
        <div class="bienvenida-content">
            <h1>¡Bienvenido a la Mejor Experiencia de Transporte Fluvial!</h1>
            <p>Explora las maravillas del río con comodidad y seguridad. Reserva tu viaje con nosotros.</p>
            <div class="enlace">
                <a href="#" class="boton-explora"><i class="fas fa-ship"></i> Comienza tu Viaje</a>
            </div>
        </div>
    </div>

    <!-- Sección de Destinos -->
    <section class="carta-contenido">
        <h2>Destinos Destacados</h2>
        <div class="cartas">
            <div class="carta">
                <img src="imagen/Iquitos.jpg">
                <div class="carta-info">
                    <h3>Iquitos</h3>
                    <p>La Isla Bonita</p>
                    <a href="#" class="boton-ver-mas">Ver más <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="carta">
                <img src="imagen/pucallpa1.jpg">
                <div class="carta-info">
                    <h3>Pucallpa</h3>
                    <p>La Tierra Colorada</p>
                    <a href="#" class="boton-ver-mas">Ver más <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="carta">
                <img src="imagen/Requenna.jpg">
                <div class="carta-info">
                    <h3>Requena</h3>
                    <p>La Atenas del Ucayali</p>
                    <a href="#" class="boton-ver-mas">Ver más <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="carta">
                <img src="imagen/CaballoCocha.jpg">
                <div class="carta-info">
                    <h3>Caballo Cocha</h3>
                    <p>Tierra de Mitos y Leyendas</p>
                    <a href="#" class="boton-ver-mas">Ver más <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

        <!-- Sección Quiénes Somos -->
        <section class="quienes-somos">
        <h2>¿Quiénes Somos?</h2>
        <p>Somos una plataforma dedicada a conectar a los viajeros con las mejores empresas de transporte fluvial. Nuestra misión es ofrecer una experiencia de viaje segura, cómoda y confiable.</p>
    </section>

    <!-- Sección ¿Por qué Elegirnos? -->
    <section class="por-que-elegirnos">
        <h2>¿Por qué Elegirnos?</h2>
        <div class="beneficios">
            <div class="beneficio">
                <i class="fas fa-check-circle"></i>
                <h3>Viajes Seguros</h3>
                <p>Nuestra prioridad es la seguridad en cada viaje, con las mejores compañías del sector.</p>
            </div>
            <div class="beneficio">
                <i class="fas fa-clock"></i>
                <h3>Horarios Flexibles</h3>
                <p>Ofrecemos una amplia gama de horarios para que puedas planificar tu viaje sin complicaciones.</p>
            </div>
            <div class="beneficio">
                <i class="fas fa-thumbs-up"></i>
                <h3>Calidad Garantizada</h3>
                <p>Trabajamos con empresas que cumplen los estándares más altos de calidad y confort.</p>
            </div>
        </div>
    </section>
@endsection
