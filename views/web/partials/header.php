<?php
// require_once 'C:\xampp\htdocs\jmexpeditions\app\config.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Meta etiquetas -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo PUBLIC_URL; ?>favicon.ico" type="image/x-icon">

    <!-- Tipografías y Fuentes de Google -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">

    <!-- Iconos y Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Bootstrap y Flag Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons@3.2.0/css/flag-icons.min.css">

    <!-- Animaciones CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>css/landing/app.css">
    <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>css/landing/app.css.map">

    <!-- Estilos para sección de testimonios -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <title>JM Expeditions</title> <!-- Título dinámico -->
</head>



<body>
	<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
		<div class="container">
			<a class="navbar-brand animate__fadeInDown" href="<?php echo $URL; ?>index.php">
				<img src="<?php echo $URL; ?>/public/images/source/Horizontal_jm.png" alt="JM Expeditions" style="max-height: 50px;">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ftco-nav"
				aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fas fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item"><a href="<?php echo $URL; ?>index.php" class="nav-link">Inicio</a></li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="dropdownDestinos" role="button"
							data-bs-toggle="dropdown" aria-expanded="false">Destinos</a>
						<ul class="dropdown-menu animate__fadeIn" aria-labelledby="dropdownDestinos">
							<li><a class="dropdown-item" href="<?php echo $URL; ?>destinos/playas.php">Playas</a></li>
							<li><a class="dropdown-item" href="<?php echo $URL; ?>destinos/montanas.php">Montañas</a></li>
							<li><a class="dropdown-item" href="<?php echo $URL; ?>destinos/ciudades.php">Ciudades</a></li>
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="dropdownPaquetes" role="button"
							data-bs-toggle="dropdown" aria-expanded="false">Paquetes</a>
						<ul class="dropdown-menu animate__fadeIn" aria-labelledby="dropdownPaquetes">
							<li><a class="dropdown-item" href="<?php echo $URL; ?>paquetes/familiares.php">Familiares</a></li>
							<li><a class="dropdown-item" href="<?php echo $URL; ?>paquetes/aventura.php">Aventura</a></li>
							<li><a class="dropdown-item" href="<?php echo $URL; ?>paquetes/lujo.php">De Lujo</a></li>
						</ul>
					</li>
					<li class="nav-item"><a href="<?php echo $URL; ?>servicios.php" class="nav-link">Servicios</a></li>
					<li class="nav-item"><a href="<?php echo $URL; ?>blog.php" class="nav-link">Blog</a></li>
					<li class="nav-item"><a href="<?php echo $URL; ?>contactos.php" class="nav-link">Contacto</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- END nav -->
</body>

</html>