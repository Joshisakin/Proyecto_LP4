<footer class="bg-dark text-light py-4 mt-auto">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h5 class="mb-3">AmazonRiver</h5>
                <p class="mb-3">
                    Descubre la magia del Amazonas con nosotros. Viajes seguros y experiencias únicas.
                </p>
                <div class="social-links">
                    <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-light"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h5 class="mb-3">Contacto</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Iquitos, Perú</li>
                    <li class="mb-2"><i class="fas fa-phone me-2"></i>(+51) 999-999-999</li>
                    <li class="mb-2"><i class="fas fa-envelope me-2"></i>info@amazonriver.com</li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h5 class="mb-3">Newsletter</h5>
                <p class="mb-3">Suscríbete para recibir noticias y ofertas especiales.</p>
                <div class="input-group">
                    <input type="email" class="form-control" placeholder="Tu email">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <small>&copy; {{ date('Y') }} AmazonRiver. Todos los derechos reservados.</small>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="{{ route('terminos') }}" class="text-light text-decoration-none me-3">Términos y Condiciones</a>
                <a href="{{ route('privacidad') }}" class="text-light text-decoration-none">Política de Privacidad</a>
            </div>
        </div>
    </div>
</footer>
