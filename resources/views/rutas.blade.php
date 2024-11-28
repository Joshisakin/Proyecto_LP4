@extends('layouts.app')

@section('title', 'Rutas')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/styles2.css') }}">
@endsection

@section('content')
    <div class="ruta-container">
        <h2>Selecciona tu Ruta</h2>
        <div class="ruta-form">
            <div class="campo">
                <label for="destino-inicial">
                    <i class="fas fa-map-marker-alt"></i> Origen:
                </label>
                <input type="text" id="destino-inicial" placeholder="Por favor Selecciona">
            </div>
            <div class="campo">
                <label for="destino-final">
                    <i class="fas fa-map-marker-alt"></i> Destino:
                </label>
                <input type="text" id="destino-final" placeholder="Por favor Selecciona">
            </div>
            <div class="campo">
                <label for="fecha">
                    <i class="fas fa-calendar-alt"></i> Fecha De Viaje:
                </label>
                <input type="date" id="fecha">
            </div>
            <button class="btn-buscar">
                <i class="fas fa-search"></i> Buscar
            </button>
        </div>
    </div>

    <div class="rutas">
    <h2>Nuestras Rutas</h2>
    </div>
        <section class="estructura">
            <div class="card">
                <div class="face front">
                    <img src="imagen/ruta1.jpg" alt="">
                    <h3>Ruta 1</h3>
                </div>
                <div class="face back">
                    <div class="carta-header">
                        <h2>Ruta del Viaje</h2>
                    </div>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="circle">1</div>
                            <div class="timeline-content right">
                                <p><i class="fas fa-map-marker-alt"></i>Iquitos</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="circle">2</div>
                            <div class="timeline-content right">
                                <p><i class="fas fa-map-marker-alt"></i>Pebas</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="circle">3</div>
                            <div class="timeline-content right">
                                <p><i class="fas fa-map-marker-alt"></i>San Pablo</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="circle">4</div>
                            <div class="timeline-content right">
                                <p><i class="fas fa-map-marker-alt"></i>Caballo Cocha</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="circle">5</div>
                            <div class="timeline-content right">
                                <p><i class="fas fa-map-marker-alt"></i>Santa Rosa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="face front">
                    <img src="imagen/ruta2.jpeg" alt="">
                    <h3>Ruta 2</h3>
                </div>
                <div class="face back">
                    <div class="carta-header">
                        <h2>Ruta del Viaje</h2>
                    </div>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="circle">1</div>
                            <div class="timeline-content right">
                                <p><i class="fas fa-map-marker-alt"></i>Iquitos</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="circle">2</div>
                            <div class="timeline-content right">
                                <p><i class="fas fa-map-marker-alt"></i>Puerto Alegría</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="circle">3</div>
                            <div class="timeline-content right">
                                <p><i class="fas fa-map-marker-alt"></i>Yavari</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="circle">4</div>
                            <div class="timeline-content right">
                                <p><i class="fas fa-map-marker-alt"></i>Sarayacu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="face front">
                    <img src="imagen/ruta3.jpg" alt="">
                    <h3>Ruta 3</h3>
                </div>
                <div class="face back">
                    <div class="carta-header">
                        <h2>Ruta del Viaje</h2>
                    </div>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="circle">1</div>
                            <div class="timeline-content right">
                                <p><i class="fas fa-map-marker-alt"></i>Iquitos</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="circle">2</div>
                            <div class="timeline-content right">
                                <p><i class="fas fa-map-marker-alt"></i>Requena</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="circle">3</div>
                            <div class="timeline-content right">
                                <p><i class="fas fa-map-marker-alt"></i>San Tomás</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="face front">
                    <img src="imagen/ruta4.jpg" alt="">
                    <h3>Ruta 4</h3>
                </div>
                <div class="face back">
                    <div class="carta-header">
                        <h2>Ruta del Viaje</h2>
                    </div>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="circle">1</div>
                            <div class="timeline-content right">
                                <p><i class="fas fa-map-marker-alt"></i>Iquitos</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="circle">2</div>
                            <div class="timeline-content right">
                                <p><i class="fas fa-map-marker-alt"></i>Nueva York</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="circle">3</div>
                            <div class="timeline-content right">
                                <p><i class="fas fa-map-marker-alt"></i>Santa Teresa</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="circle">4</div>
                            <div class="timeline-content right">
                                <p><i class="fas fa-map-marker-alt"></i>Chicago</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="circle">5</div>
                            <div class="timeline-content right">
                                <p><i class="fas fa-map-marker-alt"></i>Pucallpa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
