<?php

require_once 'C:\xampp\htdocs\jmexpeditions\app\config.php';
require_once BASE_PATH . '/views/web/partials/header.php'; // Asegúrate de que la ruta a header.php sea correcta
?>


<!-- Fullscreen Video Background -->
<section class="video-container">
    <video autoplay muted loop playsinline>
        <source src="<?php echo PUBLIC_URL; ?>/uploads/movie/movie_flyer.webm" type="video/webm">
        Tu navegador no soporta videos HTML5.
    </video>
    <div class="overlay">
        <h1 class="welcome-text text-sub">Bienvenido a JM Expeditions</h1>
        <a href="destinos.php" class="action-button">Explorar más</a>
    </div>
    <?php
    
    echo realpath(__DIR__ . '/../../app/config.php');
    ?>

</section>

<!-- Sección de contenido adicional -->
<section class="ftco-section services-section" style="background-color: white;">
    <div class="container">
        <div class="row d-flex">
            <!-- Columna de texto con animaciones -->
            <div class="col-md-6 d-flex align-items-center animate-section" data-animation="animate__fadeInLeft">
                <div class="heading-section mb-5">
                    <span class="subheading">Bienvenido a JM Expeditions</span>
                    <h2 class="mb-4">¡Es hora de comenzar tu aventura!</h2>
                    <p>
                        Somos una empresa especializada en el sector de viajes, ofreciendo experiencias únicas con guías certificados en alta montaña 🏔️. Explora destinos increíbles con nosotros y empieza tu próxima gran aventura.
                    </p>
                    <?php var_dump($URL);?>
                    <a href="#" class="btn btn-primary py-3 px-4 btn-text animate__bounceIn">Buscar Destinos</a>
                </div>
            </div>
            <!-- Columna de imagen con animación -->
            <div class="col-md-6 d-flex align-items-center animate-section" data-animation="animate__fadeInRight">
                <div class="services services-1 d-block img" style="background-image: url('<?php echo PUBLIC_URL; ?>/web/images/services-1.jpg'); background-size: cover; background-position: center; width: 100%; min-height: 400px;">
                    <div class="media-body text-center text-white">
                        <h3 class="heading mb-3 b-0 animate__fadeInUp">Tour Operator</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sección de Destinos Destacados -->
<section class="ftco-section bg-light" id="destinosDestacados">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-5 animate-section" data-animation="animate__fadeInDown">
                <h2 class="mb-4">Destinos Destacados</h2>
                <p>Explora nuestros destinos más populares y comienza tu aventura hoy.</p>
            </div>
        </div>
        <div class="row d-flex"> <!-- Añadido d-flex aquí para aplicar Flexbox -->
            <div class="col-md-4 animate-section mb-4 d-flex" data-animation="animate__fadeInLeft">
                <div class="destination flex-fill"> <!-- flex-fill para que tome el espacio disponible -->
                    <img src="<?php echo PUBLIC_URL; ?>/images/web/nevados.jpg" alt="Nevados" class="img-fluid">
                    <div class="p-5 pt-2 d-flex flex-column align-baseline justify-content-between">
                        <h3>Nevados de los Andes</h3>
                        <p>Admira la belleza de los nevados espectaculares y disfruta de actividades al aire libre.</p>
                        <a href="#" class="col-md-12 btn btn-primary">Ver Más</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 animate-section mb-4 d-flex" data-animation="animate__fadeInUp">
                <div class="destination flex-fill">
                    <img src="http://localhost:3000/jmexpeditions/public/images/web/lagunas.jpg" alt="Laguna" class="img-fluid">
                    <div class="p-5 pt-2 d-flex flex-column align-baseline justify-content-between">
                        <h3>Lagunas Escondidas</h3>
                        <p>Descubre las mágicas lagunas escondidas y su entorno natural impresionante.</p>
                        <a href="#" class="col-md-12 btn btn-primary">Ver Más</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 animate-section mb-4 d-flex" data-animation="animate__fadeInRight">
                <div class="destination flex-fill">
                    <img src="<?php echo PUBLIC_URL; ?>/images/web/sitios-arqueologicos.jpg" alt="Sitio Arqueológico" class="img-fluid">
                    <div class="p-5 pt-2 d-flex flex-column align-baseline justify-content-between">
                        <h3>Sitios Arqueológicos</h3>
                        <p>Explora los antiguos sitios arqueológicos y la historia que los rodea.</p>
                        <a href="#" class="col-md-12 btn btn-primary">Ver Más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Sección de Testimonios -->
<section class="ftco-section testimonials-section"">
    <div class="testimonials-background"></div> <!-- Fondo de imagen -->
    <div class="container"> <!-- Contenido -->
        <div class="row">
            <div class="col-md-12 text-center mb-5 animate-section" data-animation="animate__fadeInDown">
                <h2 class="mb-4 text-white">Lo que dicen nuestros clientes</h2> <!-- Texto blanco -->
            </div>
        </div>
        <div class="row">
            <div class="swiper-container">
                <div class="swiper-wrapper mb-5">
                    <div class="swiper-slide">
                        <div class="testimonial">
                            <div class="testimonial-image">
                                <img src="<?php echo $URL; ?>assets/img/talha.jpg" alt="Juan Pérez" class="img-fluid rounded-circle">
                            </div>
                            <p>"Una experiencia increíble, ¡volveré sin duda!"</p>
                            <h4>Juan Pérez</h4>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial">
                            <div class="testimonial-image">
                                <img src="<?php echo $URL; ?>assets/img/sauro.jpg" alt="María López" class="img-fluid rounded-circle">
                            </div>
                            <p>"Los guías son muy profesionales y los destinos son hermosos."</p>
                            <h4>María López</h4>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial">
                            <div class="testimonial-image">
                                <img src="<?php echo $URL; ?>assets/img/profile.jpg" alt="Carlos Sánchez" class="img-fluid rounded-circle">
                            </div>
                            <p>"Una de las mejores experiencias de mi vida!"</p>
                            <h4>Carlos Sánchez</h4>
                        </div>
                    </div>
                    <!-- Agrega más testimonios aquí -->
                    <div class="swiper-slide">
                        <div class="testimonial">
                            <div class="testimonial-image">
                                <img src="<?php echo $URL; ?>assets/img/profile2.jpg" alt="Lucía Fernández" class="img-fluid rounded-circle">
                            </div>
                            <p>"Recomiendo totalmente este viaje, fue inolvidable."</p>
                            <h4>Lucía Fernández</h4>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial">
                            <div class="testimonial-image">
                                <img src="<?php echo $URL; ?>assets/img/mlane.jpg" alt="Andrés García" class="img-fluid rounded-circle">
                            </div>
                            <p>"Los destinos son espectaculares, una maravilla. lorem sdaf dsf sdaf sadf sadf sdf asdf sadf sadf sdf sad fdsfs asdfjsahdjf s"</p>
                            <h4>Andrés García</h4>
                        </div>
                    </div>
                </div>

                <!-- Paginación -->
                <!-- <div class="swiper-pagination b-0"></div> -->
                <!-- Botones de navegación -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

            </div>
        </div>
    </div>
</section>


<section class="ftco-section faq-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-5 animate-section" data-animation="animate__fadeInDown">
                <h2 class="mb-4">Preguntas Frecuentes</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="faq">
                    <h4>¿Cuál es el mejor momento para viajar?</h4>
                    <p>El mejor momento para viajar depende de tu destino. Consulta con nuestros expertos para recomendaciones personalizadas.</p>
                    <h4>¿Qué tipo de seguro debo tener?</h4>
                    <p>Recomendamos un seguro de viaje que cubra cancelaciones, emergencias médicas y pérdida de equipaje.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section gallery-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-5 animate-section" data-animation="animate__fadeInDown">
                <h2 class="mb-4">Galería de Destinos</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 animate-section" data-animation="animate__fadeInLeft">
                <img src="<?php echo PUBLIC_URL; ?>/web/images/destino1.jpg" alt="Destino 1" class="img-fluid">
            </div>
            <div class="col-md-4 animate-section" data-animation="animate__fadeInUp">
                <img src="images/destino2.jpg" alt="Destino 2" class="img-fluid">
            </div>
            <div class="col-md-4 animate-section" data-animation="animate__fadeInRight">
                <img src="images/destino3.jpg" alt="Destino 3" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<section class="ftco-section cta-section">
    <div class="container text-center">
        <h2 class="mb-4 animate-section" data-animation="animate__fadeIn">¿Listo para tu próxima aventura?</h2>
        <a href="reservas.php" class="btn btn-primary py-3 px-4 animate-section" data-animation="animate__pulse">Reserva Ahora</a>
    </div>
</section>


<!-- Sección de Ubicación -->
<section class="ftco-section location-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-5 animate-section" data-animation="animate__fadeInDown">
                <h2 class="mb-4">Ubicación</h2>
                <p>Encuentra el camino hacia tu próxima aventura y descubre lo que te rodea.</p>
            </div>
        </div>
        <div class="row align-items-stretch"> <!-- Alineación vertical -->
            <div class="col-md-6 animate-section" data-animation="animate__fadeInLeft">
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d827.1841516369471!2d-77.52998509916127!3d-9.528431107782659!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91a90ddba646eb19%3A0x88f2dd7b9e036655!2sJMEXPEDITION!5e0!3m2!1ses-419!2spe!4v1729820848525!5m2!1ses-419!2spe"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="col-md-6 animate-section" data-animation="animate__fadeInRight">
                <div class="location-info">
                    <h3><i class="fas fa-map-marker-alt"></i> Visítanos</h3>
                    <div class="row location-card">
                        <div class="info-item col-xxl-6">
                            <i class="fas fa-map"></i>
                            <!-- <p>Dirección:</p> -->
                            <p>jr. San Martin # 627, segundo piso, <strong> Huaraz, Perú </strong></p>
                        </div>
                        <div class="info-item col-xxl-6">
                            <i class="fas fa-phone-alt"></i>
                            <!-- <p>Teléfono:</p> -->
                            <p>+51 930 311 519</p>
                        </div>
                        <div class="info-item col-xxl-6">
                            <i class="fas fa-envelope"></i>
                            <!-- <p>Email:</p> -->
                            <p><a href="mailto:jmexpeditions2018@gmail.com" class="text-white">jmexpeditions2018@gmail.com</a></p>
                        </div>
                        <div class="info-item col-xxl-6">
                            <i class="fas fa-share-alt"></i>
                            <!-- <p>Síguenos:</p> -->
                            <p class="d-flex w-100 justify-content-around">
                                <a href="https://www.instagram.com/jmexpeditions" target="_blank" class="text-white"><i class="fab fa-instagram"></i> Instagram</a>
                                <a href="http://jmexpeditions.com" target="_blank" class="text-white"><i class="fas fa-globe"></i> Web</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<?php
// require_once $URL . '/partials/footer.php';
require_once BASE_PATH . '/view/web/partials/footer.php';

?>