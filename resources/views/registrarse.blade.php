@extends('layouts.app')

@section('title', 'Registrarse')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/styles3.css') }}">
@endsection

@section('content')
<section class="registro">
        <div class="registro-overlay"></div>
        <div class="registro-content">
            <h1>Únete a AmazonRiver</h1>
            <p>Viaja por el Amazonas como nunca antes. Regístrate y empieza la aventura.</p>
            <form class="registro-form">
                <div class="input-container">
                    <label for="nombre">Nombres</label>
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" id="nombre" placeholder="Nombre" required>
                    </div>
                </div>
                <div class="input-container">
                    <label for="apellidos">Apellidos</label>
                    <div class="input-group">
                        <i class="fas fa-user-tag"></i>
                        <input type="text" id="apellidos" placeholder="Apellidos" required>
                    </div>
                </div>
                <div class="input-container">
                    <label for="email">Correo electrónico</label>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" placeholder="Correo electrónico" required>
                    </div>
                </div>
                <div class="input-container">
                    <label for="password">Contraseña</label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" placeholder="Contraseña" required>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection