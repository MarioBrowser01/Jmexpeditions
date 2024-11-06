<?php
// require_once 'layouts/header.php';
include '../app/controller/config.php';
require_once dirname(__DIR__) . '/templates/layouts/header.php';
?>

<div class="hero-wrap js-fullheight position-relative">
	<div class="overlay"></div>

	<!-- Video de fondo -->
	<video id="background-video" class="w-100 position-absolute" style="object-fit: cover;" autoplay muted loop playsinline>
		<source src="../public/uploads/movie/movie_flyer.webm" type="video/webm">
		<source src="../public/uploads/movie/movie_flyer.mp4" type="video/mp4">
		Your browser does not support the video tag.
	</video>

	<!-- Contenido sobre el video -->
	<div class="container position-relative z-index-10">
		<div class="row no-gutters slider-text js-fullheight align-items-center">
			<div class="col-md-7 ftco-animate text-light">
				<h1 class="mb-4 titulo">Bienvenidos a JMEXPEDITIONS</h1>
				<p class="caps">La agencia de viajes de los expertos</p>
			</div>
			<div class="col-md-5 d-flex justify-content-end">
				<a href="paquetes.php" class="btn btn-flight py-3 px-4">
					<span class="icon"><i class="fas fa-plane-departure"></i></span>
					<span class="text">&ThinSpace; ¡Ver Destinos!</span>
				</a>
			</div>
		</div>
	</div>

	<!-- Botón de control de volumen -->
	<div class="video-controls text-center position-absolute">
		<button id="mute-btn" class="mute-btn">
			<i class="fas fa-volume-mute fa-2x"></i>
		</button>
	</div>

	<!-- Imágenes redondas en la esquina inferior derecha -->
	<div class="certification-logos position-absolute">
		<a href="https://www.ifmga.info/" target="_blank"><img src="../assets/img/layouts/certificate1.jpg" alt="Certificación 1" class="certification-icon mb-3"></a>
		<a href="https://agmp.pe/agmp/guias-uiagm-peru/" target="_blank"><img src="../assets/img/layouts/certificate2.png" alt="Certificación 2" class="certification-icon mb-3"></a>
		<!-- <img src="img/img3.jpg" alt="Certificación 3" class="certification-icon"> -->
	</div>
</div>
<section class="ftco-section testimony-section bg-bottom" style="background-image: url(images/bg_1.jpg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                <span class="subheading">Testimonios</span>
                <h2 class="mb-4">Comentarios Turísticos</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 d-flex align-items-stretch ftco-animate">
                <div class="services services-1 color-1 img" style="background-image: url(images/services-1.jpg);">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-paragliding"></span></div>
                    <div class="media-body p-4">
                        <h3 class="heading mb-3">Actividades</h3>
                        <p>Disfruta de emocionantes aventuras al aire libre, con actividades personalizadas para todos los niveles.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 d-flex align-items-stretch ftco-animate">
                <div class="services services-1 color-2 img" style="background-image: url(images/services-2.jpg);">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
                    <div class="media-body p-4">
                        <h3 class="heading mb-3">Arreglos de Viaje</h3>
                        <p>Te ayudamos a organizar tu viaje perfecto, asegurando comodidad y aventura en cada destino.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 d-flex align-items-stretch ftco-animate">
                <div class="services services-1 color-3 img" style="background-image: url(images/services-3.jpg);">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-tour-guide"></span></div>
                    <div class="media-body p-4">
                        <h3 class="heading mb-3">Guía Privado</h3>
                        <p>Viaja con un guía privado que te acompañará en cada paso de tu aventura.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 d-flex align-items-stretch ftco-animate">
                <div class="services services-1 color-4 img" style="background-image: url(images/services-4.jpg);">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-map"></span></div>
                    <div class="media-body p-4">
                        <h3 class="heading mb-3">Gestión de Ubicaciones</h3>
                        <p>Explora destinos exclusivos con itinerarios personalizados para aprovechar al máximo tu viaje.</p>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>


        <?php
        require_once dirname(__DIR__) . '/templates/layouts/footer.php';
        ?>