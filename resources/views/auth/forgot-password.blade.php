@extends('layouts.app')

@section('title', 'Restablecer Contraseña')

@section('content')
<div class="text-center mb-4">
    <h2 class="fw-bold text-primary">AmazonRiver</h2>
    <p class="text-muted">Recupera el acceso a tu cuenta</p>
</div>

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    @if (session('status'))
        <div class="alert alert-success text-center">
            {{ session('status') }}
        </div>
    @endif

    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input type="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   name="email" 
                   placeholder="Correo Electrónico" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary">
            Enviar Enlace de Restablecimiento
        </button>
    </div>

    <div class="text-center">
        <p class="text-muted">¿Recordaste tu contraseña? 
            <a href="{{ route('login') }}" class="fw-bold text-primary">Iniciar Sesión</a>
        </p>
    </div>
</form>
@endsection
