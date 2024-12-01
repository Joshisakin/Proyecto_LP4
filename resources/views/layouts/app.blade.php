<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AmazonRiver')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="navbar">
            <div class="logo">
                <a href="/">AmazonRiver</a>
            </div>
            <nav>
                <a href="{{ route('rutas') }}">Rutas</a>
                <a href="#">Reservas</a>
                <a href="{{ route('contacto') }}">Contacto</a>
            </nav>
            <div class="login">
                <a href="{{ route('registrarse') }}">Registrarse</a>
                <a href="{{ route('iniciarsesion') }}">Iniciar Sesión</a>
            </div>
        </div>
    </header>

    <!-- Contenido principal -->
    <main>
        @yield('styles')
        @yield('content')
    </main>

    <!-- Pie de página -->
    <footer class="footer">
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-whatsapp"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
        <div class="links">
            <a href="#">Términos y Condiciones</a> |
            <a href="#">Quiénes Somos</a> |
            <a href="#">Privacidad</a> |
            <a href="#">Información Legal</a>
        </div>
        <div class="bottom-section">
            <div class="company-name">AmazonRiver</div>
            <div>&copy; 2024 AmazonRiver International</div>
        </div>
    </footer>
</body>
</html>
