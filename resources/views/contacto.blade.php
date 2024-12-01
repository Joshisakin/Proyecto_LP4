@extends('layouts.app')

@section('title','Contacto')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/styles4.css') }}">
@endsection

@section('content')
<section class="estructura">
        <div class="estructura-1">
            <div class="cuerpo">
                <div class="cuerpo-1">
                    <div>
                        <i class="fa-solid fa-map-location"></i>
                        <h2>Ubicación</h2>
                        <p>2 de mayo #345</p>
                    </div>
                </div>
                <div class="cuerpo-1">
                    <div>
                        <i class="fa-solid fa-mobile-screen-button"></i>
                        <h2>Celular</h2>
                        <p>987-678-890</p>
                    </div>
                </div>
                <div class="cuerpo-1">
                    <div>
                        <i class="fa-solid fa-phone"></i>
                        <h2>Telefono</h2>
                        <p>065-789678</p>
                    </div>
                </div>
                <div class="cuerpo-1">
                    <div>
                        <i class="fa-solid fa-envelope"></i>
                        <h2>Email</h2>
                        <p>
                        <a href="mailto:hello@theme.com">amazonriver@gmail.com</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="estructura-2">
        <div class="formulario">
            <h2>Formulario de contacto</h2>
            <form> 
                <label for="nombre">Nombre:
                    <input type="text" name="nombre" id="nombre" placeholder="Ingresa tu nombre" >
                </label>
                <label for="correo">Email:
                    <input type="email" name="correo" id="correo" placeholder="Ingresa tu email" >
                </label>
                <label for="mensaje">Mensaje:
                    <textarea name="info" id="info" rows="5" maxlength="500" ></textarea>
                </label>
                <button type="submit">Enviar</button>
            </form>
        </div>
        <div class="info">
            <h3>Ponerse en contacto</h3>
            <h4>AmazonRiver se enorgullece de ofrecer 
                los mejores servicios de transporte fluvial. 
                ¡Explora nuestras rutas, descubre destinos 
                increíbles y compra tus tickets fácilmente!
            </h4>
            <p>Disfruta de la experiencia de viajar por el río Amazonas 
                con comodidad y seguridad. Nuestra misión es brindarte 
                un viaje inolvidable, conectado con la naturaleza y 
                con todas las comodidades que necesitas para disfrutar 
                al máximo. ¡Únete a nosotros en esta aventura única!
            </p>
            <span class="iconos">
                <a href="https://www.facebook.com/tuperfil" target="_blank">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="https://wa.me/123456789" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="https://www.linkedin.com/in/tu-perfil" target="_blank">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="https://www.hotmail.com" target="_blank">
                    <i class="fas fa-envelope"></i>
                </a>
            </span>
        </div>
    </section>
@endsection