@extends('layouts.app')

@section('title', 'Restablecer Contraseña')

@section('content')
<div class="text-center mb-4">
    <h2 class="fw-bold text-primary">AmazonRiver</h2>
    <p class="text-muted">Establece tu nueva contraseña</p>
</div>

<form method="POST" action="{{ route('password.store') }}">
    @csrf

    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input type="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   name="email" 
                   placeholder="Correo Electrónico" 
                   value="{{ old('email', $request->email) }}" 
                   required 
                   autofocus 
                   autocomplete="username">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   name="password" 
                   placeholder="Nueva Contraseña" 
                   required 
                   autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" 
                   class="form-control" 
                   name="password_confirmation" 
                   placeholder="Confirmar Nueva Contraseña" 
                   required 
                   autocomplete="new-password">
        </div>
    </div>

    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary">
            Restablecer Contraseña
        </button>
    </div>

    <div class="text-center">
        <p class="text-muted">¿Recordaste tu contraseña? 
            <a href="{{ route('login') }}" class="fw-bold text-primary">Iniciar Sesión</a>
        </p>
    </div>
</form>
@endsection
