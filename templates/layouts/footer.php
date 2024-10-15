<footer class="ftco-footer bg-bottom ftco-no-pt" style="background-image: url(images/bg_3.jpg);">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md pt-5">
                <div class="ftco-footer-widget pt-md-5 mb-4">
                    <h2 class="ftco-heading-2">Acerca</h2>
                    <p>Viaja con nosotros y descubre rincones ocultos, aventuras inesperadas y secretos que el mundo aún guarda. ¿Te atreves?</p>
                    <ul class="ftco-footer-social">
                        <li class="text-center">
                            <a href="#" class="text-light d-flex justify-content-center align-items-center"><i class="fa fa-tiktok"></i></a>
                        </li>
                        <li class="text-center">
                            <a href="#" class="text-light d-flex justify-content-center align-items-center"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li class="text-center">
                            <a href="#" class="text-light d-flex justify-content-center align-items-center"><i class="fa fa-instagram"></i></a>
                        </li>
                    </ul>


                </div>
            </div>
            <div class="col-md pt-5 border-left">
                <div class="ftco-footer-widget pt-md-5 mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">Información</h2>
                    <ul class="list-unstyled">
                        <li><a href="#" class="py-2 d-block">Consultas en linea</a></li>
                        <li><a href="#" class="py-2 d-block">Consultas generales</a></li>
                        <li><a href="#" class="py-2 d-block">Condiciones de reservas</a></li>
                        <li><a href="#" class="py-2 d-block">Privacidad y politicas</a></li>
                        <li><a href="#" class="py-2 d-block">Politicas de rembolso</a></li>
                        <li><a href="#" class="py-2 d-block">Llamanos</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md pt-5 border-left">
                <div class="ftco-footer-widget pt-md-5 mb-4">
                    <h2 class="ftco-heading-2">Experiencia</h2>
                    <ul class="list-unstyled">
                        <li><a href="aventuras.php" class="py-2 d-block">Aventuras</a></li>
                        <li><a href="hoteles.php" class="py-2 d-block">Hotel y Restaurantes</a></li>
                        <li><a href="playas.php" class="py-2 d-block">Playas</a></li>
                        <li><a href="naturaleza.php" class="py-2 d-block">Naturaleza</a></li>
                        <li><a href="campamentos.php" class="py-2 d-block">Campamentos</a></li>
                        <li><a href="eventos.php" class="py-2 d-block">Eventos</a></li>
                    </ul>
                </div>
            </div>
            <!-- <div class="col-md pt-5 border-left">
                <div class="ftco-footer-widget pt-md-5 mb-4">
                    <h2 class="ftco-heading-2">¿Tiene preguntas?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon fa fa-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                            <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+51 9</span></a></li>
                            <li><a href="#"><span class="icon fa fa-paper-plane"></span><span class="text"> reservasjmexpeditions@gmail.com</span></a></li>
                        </ul>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="row">
            <div class="col-md-12 text-center">

                <p>
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> Todos los derechos reservados | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> | S
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            </div>
        </div>
    </div>
</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>

<script>
    document.getElementById('boton-cambiar-fondo').addEventListener('click', function(event) {
        event.preventDefault();

        // Aquí pasamos la ruta de la imagen obtenida desde PHP
        var nuevaImagen = '/jmexpeditions/public/uploads/<?php echo $imagen_aleatoria; ?>';

        // Cambiamos el fondo del div con la clase 'bg-img'
        document.getElementById('fondo-carousel').style.backgroundImage = 'url(' + nuevaImagen + ')';
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script src="<?php echo $URL; ?>assets/js/landing/jquery.min.js"></script>
<script src="<?php echo $URL; ?>assets/js/landing/jquery-migrate-3.0.1.min.js"></script>
<script src="<?php echo $URL; ?>assets/js/landing/popper.min.js"></script>
<script src="<?php echo $URL; ?>assets/js/landing/bootstrap.min.js"></script>
<script src="<?php echo $URL; ?>assets/js/landing/jquery.easing.1.3.js"></script>
<script src="<?php echo $URL; ?>assets/js/landing/jquery.waypoints.min.js"></script>
<script src="<?php echo $URL; ?>assets/js/landing/jquery.stellar.min.js"></script>
<script src="<?php echo $URL; ?>assets/js/landing/owl.carousel.min.js"></script>
<script src="<?php echo $URL; ?>assets/js/landing/jquery.magnific-popup.min.js"></script>
<script src="<?php echo $URL; ?>assets/js/landing/jquery.animateNumber.min.js"></script>
<script src="<?php echo $URL; ?>assets/js/landing/bootstrap-datepicker.js"></script>
<script src="<?php echo $URL; ?>assets/js/landing/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="<?php echo $URL; ?>assets/js/landing/google-map.js"></script>
<script src="<?php echo $URL; ?>assets/js/landing/main.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</body>

</html>