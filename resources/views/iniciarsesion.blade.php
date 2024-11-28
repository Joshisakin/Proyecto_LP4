@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/styles6.css') }}">
@endsection

@section('content')
<section class="fondo">
    <div id="login" class="div">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email-login">Correo Electrónico</label>
            <input type="email" name="email" id="email-login" placeholder="Ingrese su correo" required>

            <label for="password-login">Contraseña</label>
            <input type="password" name="password" id="password-login" placeholder="Ingrese su contraseña" required>

            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</section>
@endsection
