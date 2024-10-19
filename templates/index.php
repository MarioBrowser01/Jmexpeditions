<?php
// require_once 'layouts/header.php';
include '../app/controller/config.php';
require_once dirname(__DIR__) . '/templates/layouts/header.php';

// Consulta para obtener los itinerarios, paquetes y destinos
$sql = "SELECT i.id_itinerario, i.id_paquete, i.id_destino, p.nombre_paquete, 
               d.nombre_destino, d.imagen1_destino, d.imagen2_destino, d.imagen3_destino
        FROM itinerarios i
        JOIN paquetes p ON i.id_paquete = p.id_paquete
        JOIN destinos d ON i.id_destino = d.id_destino
		WHERE i.tipo_destino = 'Final'";
$stmt = $pdo->query($sql);
$itinerarios_datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Seleccionar un itinerario aleatorio
if (!empty($itinerarios_datos)) {
	$itinerario_aleatorio = $itinerarios_datos[array_rand($itinerarios_datos)];
	$imagenes_destino = [
		$itinerario_aleatorio['imagen1_destino'],
		$itinerario_aleatorio['imagen2_destino'],
		$itinerario_aleatorio['imagen3_destino']
	];

	$imagenes_destino = array_filter($imagenes_destino);

	$imagen_aleatoria = $imagenes_destino[array_rand($imagenes_destino)];
}



?>
<div class="hero-wrap js-fullheight position-relative">
	<div class="overlay"></div>

	<!-- Video de fondo -->
	<video id="background-video" class="w-100 h-100 position-absolute" style="object-fit: cover;" autoplay muted loop playsinline>
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



<!-- <section class="ftco-section ftco-no-pb ftco-no-pt mt-2">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="ftco-search d-flex justify-content-center">
					<div class="row">
						<div class="col-md-12 nav-link-wrap">
							<div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
								<a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Buscar Tour</a>

								<a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Hotel</a>

							</div>
						</div>
						<div class="col-md-12 tab-wrap">
							<div class="tab-content" id="v-pills-tabContent">
								<div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
									<form action="#" class="search-property-1">
										<div class="row no-gutters">
											<div class="col-md d-flex">
												<div class="form-group p-4 border-0">
													<label for="#">Destino</label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-search"></span></div>
														<input type="text" class="form-control" placeholder="Search place">
													</div>
												</div>
											</div>
											<div class="col-md d-flex">
												<div class="form-group p-4">
													<label for="#">Departamento</label>

													<div class="form-field">
														<div class="select-wrap">
															<div class="icon"><span class="fa fa-chevron-down"></span></div>
															<select name="" id="" class="form-control">
																<option value="">Select departament</option>
																<option value="">$10,000</option>

															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md d-flex">
												<div class="form-group p-4">
													<label for="#">Provincia</label>
													<div class="form-field">
														<div class="select-wrap">
															<div class="icon"><span class="fa fa-chevron-down"></span></div>
															<select name="" id="" class="form-control">
																<option value="">Select provincie</option>
																<option value="">$10,000</option>

															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md d-flex">
												<div class="form-group p-4">
													<label for="#">Precio Limite</label>
													<div class="form-field">
														<div class="select-wrap">
															<div class="icon"><span class="fa fa-chevron-down"></span></div>
															<select name="" id="" class="form-control">
																<option value="">$100</option>
																<option value="">$10,000</option>

															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md d-flex">
												<div class="form-group d-flex w-100 border-0">
													<div class="form-field w-100 align-items-center d-flex">
														<i class="fas fa-globe"></i> 
														<button type="submit" class="align-self-stretch form-control btn btn-primary">
															<i class="fas fa-search"></i> &ThinSpace;
															Explorar
														</button>
														<input type="submit" value="Explorar" class="align-self-stretch form-control btn btn-primary"> 
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>

								<div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-performance-tab">
									<form action="#" class="search-property-1">
										<div class="row no-gutters">
											<div class="col-lg d-flex">
												<div class="form-group p-4 border-0">
													<label for="#">Destination</label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-search"></span></div>
														<input type="text" class="form-control" placeholder="Search place">
													</div>
												</div>
											</div>
											<div class="col-lg d-flex">
												<div class="form-group p-4">
													<label for="#">Check-in date</label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-calendar"></span></div>
														<input type="text" class="form-control checkin_date" placeholder="Check In Date">
													</div>
												</div>
											</div>
											<div class="col-lg d-flex">
												<div class="form-group p-4">
													<label for="#">Check-out date</label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-calendar"></span></div>
														<input type="text" class="form-control checkout_date" placeholder="Check Out Date">
													</div>
												</div>
											</div>
											<div class="col-lg d-flex">
												<div class="form-group p-4">
													<label for="#">Price Limit</label>
													<div class="form-field">
														<div class="select-wrap">
															<div class="icon"><span class="fa fa-chevron-down"></span></div>
															<select name="" id="" class="form-control">
																<option value="">$100</option>
																<option value="">$10,000</option>
																<option value="">$50,000</option>
																<option value="">$100,000</option>
																<option value="">$200,000</option>
																<option value="">$300,000</option>
																<option value="">$400,000</option>
																<option value="">$500,000</option>
																<option value="">$600,000</option>
																<option value="">$700,000</option>
																<option value="">$800,000</option>
																<option value="">$900,000</option>
																<option value="">$1,000,000</option>
																<option value="">$2,000,000</option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg d-flex">
												<div class="form-group d-flex w-100 border-0">
													<div class="form-field w-100 align-items-center d-flex">
														<input type="submit" value="Search" class="align-self-stretch form-control btn btn-primary p-0">
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</section> -->

<section class="ftco-section services-section">
	<div class="container">
		<div class="row d-flex">
			<!-- Columna de texto -->
			<div class="col-md-6 d-flex align-items-center">
				<div class="heading-section mb-5">
					<span class="subheading">Bienvenido a JM Expeditions</span>
					<h2 class="mb-4">¡Es hora de comenzar tu aventura!</h2>
					<p>
						Somos una empresa especializada en el sector de viajes, ofreciendo experiencias únicas con guías certificados en alta montaña 🏔️. Explora destinos increíbles con nosotros y empieza tu próxima gran aventura.
					</p>
					<a href="#" class="btn btn-primary py-3 px-4 btn-text">Buscar Destinos</a>
				</div>
			</div>
			<!-- Columna de imagen y servicio -->
			<div class="col-md-6 d-flex align-items-center">
				<div class="services services-1 d-block img" style="background-image: url(images/services-1.jpg); background-size: cover; background-position: center; width: 100%; min-height: 100%;">
					<div class="media-body">
						<h3 class="heading mb-3 b-0">Tour Operator</h3>
						<!-- <p>A small river named Duden flows by their place and supplies it with the necessary</p> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>





<!-- <section class="ftco-section img ftco-select-destination" style="background-image: url(images/bg_3.jpg);">
	<div class="container">
		<div class="row justify-content-center pb-4">
			<div class="col-md-12 heading-section text-center ftco-animate">
				<span class="subheading">Pacific Provide Places</span>
				<h2 class="mb-4">Select Your Destination</h2>
			</div>
		</div>
	</div>
	<div class="container container-2">
		<div class="row">
			<div class="col-md-12">

				<div class="carousel-destination owl-carousel ftco-animate">
					<div class="item">
						<div class="project-destination">
							<a href="#" class="img" style="background-image: url(images/place-1.jpg);">
								<div class="text">
									<h3>Philippines</h3>
									<span>8 Tours</span>
								</div>
							</a>
						</div>
					</div>
					<div class="item">
						<div class="project-destination">
							<a href="#" class="img" style="background-image: url(images/place-2.jpg);">
								<div class="text">
									<h3>Madre de Dios - Canada</h3>
									<span>2 Tours</span>
								</div>
							</a>
						</div>
					</div>
					<div class="item">
						<div class="project-destination">
							<a href="#" class="img" style="background-image: url(images/place-3.jpg);">
								<div class="text">
									<h3>Thailand</h3>
									<span>5 Tours</span>
								</div>
							</a>
						</div>
					</div>
					<div class="item">
						<div class="project-destination">
							<a href="#" class="img" style="background-image: url(images/place-4.jpg);">
								<div class="text">
									<h3>Autralia</h3>
									<span>5 Tours</span>
								</div>
							</a>
						</div>
					</div>
					<div class="item">
						<div class="project-destination">
							<a href="#" class="img" style="background-image: url(images/place-5.jpg);">
								<div class="text">
									<h3>Greece</h3>
									<span>7 Tours</span>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section> -->

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center pb-4">
			<div class="col-md-12 heading-section text-center ftco-animate">
				<span class="subheading">Destination</span>
				<h2 class="mb-4">Tour Destination</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 ftco-animate">
				<div class="project-wrap">
					<a href="#" class="img" style="background-image: url(images/destination-1.jpg);">
						<span class="price">$550/person</span>
					</a>
					<div class="text p-4">
						<span class="days">8 Days Tour</span>
						<h3><a href="#">Banaue Rice Terraces</a></h3>
						<p class="location"><span class="fa fa-map-marker"></span> Banaue, Ifugao, Philippines</p>
						<ul>
							<li><span class="flaticon-shower"></span>2</li>
							<li><span class="flaticon-king-size"></span>3</li>
							<li><span class="flaticon-mountains"></span>Near Mountain</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-4 ftco-animate">
				<div class="project-wrap">
					<a href="#" class="img" style="background-image: url(images/destination-2.jpg);">
						<span class="price">$550/person</span>
					</a>
					<div class="text p-4">
						<span class="days">10 Days Tour</span>
						<h3><a href="#">Banaue Rice Terraces</a></h3>
						<p class="location"><span class="fa fa-map-marker"></span> Banaue, Ifugao, Philippines</p>
						<ul>
							<li><span class="flaticon-shower"></span>2</li>
							<li><span class="flaticon-king-size"></span>3</li>
							<li><span class="flaticon-sun-umbrella"></span>Near Beach</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-4 ftco-animate">
				<div class="project-wrap">
					<a href="#" class="img" style="background-image: url(images/destination-3.jpg);">
						<span class="price">$550/person</span>
					</a>
					<div class="text p-4">
						<span class="days">7 Days Tour</span>
						<h3><a href="#">Banaue Rice Terraces</a></h3>
						<p class="location"><span class="fa fa-map-marker"></span> Banaue, Ifugao, Philippines</p>
						<ul>
							<li><span class="flaticon-shower"></span>2</li>
							<li><span class="flaticon-king-size"></span>3</li>
							<li><span class="flaticon-sun-umbrella"></span>Near Beach</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-md-4 ftco-animate">
				<div class="project-wrap">
					<a href="#" class="img" style="background-image: url(images/destination-4.jpg);">
						<span class="price">$550/person</span>
					</a>
					<div class="text p-4">
						<span class="days">8 Days Tour</span>
						<h3><a href="#">Banaue Rice Terraces</a></h3>
						<p class="location"><span class="fa fa-map-marker"></span> Banaue, Ifugao, Philippines</p>
						<ul>
							<li><span class="flaticon-shower"></span>2</li>
							<li><span class="flaticon-king-size"></span>3</li>
							<li><span class="flaticon-sun-umbrella"></span>Near Beach</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-4 ftco-animate">
				<div class="project-wrap">
					<a href="#" class="img" style="background-image: url(images/destination-5.jpg);">
						<span class="price">$550/person</span>
					</a>
					<div class="text p-4">
						<span class="days">10 Days Tour</span>
						<h3><a href="#">Banaue Rice Terraces</a></h3>
						<p class="location"><span class="fa fa-map-marker"></span> Banaue, Ifugao, Philippines</p>
						<ul>
							<li><span class="flaticon-shower"></span>2</li>
							<li><span class="flaticon-king-size"></span>3</li>
							<li><span class="flaticon-sun-umbrella"></span>Near Beach</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-4 ftco-animate">
				<div class="project-wrap">
					<a href="#" class="img" style="background-image: url(images/destination-6.jpg);">
						<span class="price">$550/person</span>
					</a>
					<div class="text p-4">
						<span class="days">7 Days Tour</span>
						<h3><a href="#">Banaue Rice Terraces</a></h3>
						<p class="location"><span class="fa fa-map-marker"></span> Banaue, Ifugao, Philippines</p>
						<ul>
							<li><span class="flaticon-shower"></span>2</li>
							<li><span class="flaticon-king-size"></span>3</li>
							<li><span class="flaticon-sun-umbrella"></span>Near Beach</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



<!-- <section class="ftco-section ftco-about img">
	<div class="overlay"></div>
	<div class="container py-md-5">
		<div class="row py-md-5">
			<div class="col-md d-flex align-items-center justify-content-center">
				<video src="../public/uploads/movie/Jahuacocha_3_twiter.mp4" autoplay loop></video>
				
					<span class="fa fa-play"></span>
				</a>
			</div>
		</div>
	</div>
</section> -->

<!-- <section class="ftco-section ftco-about ftco-no-pt img">
	<div class="container">
		<div class="row d-flex">
			<div class="col-md-12 about-intro">
				<div class="row">
					<div class="col-md-6 d-flex align-items-stretch">
						<div class="img d-flex w-100 align-items-center justify-content-center" style="background-image:url(images/about-1.jpg);">
						</div>
					</div>
					<div class="col-md-6 pl-md-5 py-5">
						<div class="row justify-content-start pb-3">
							<div class="col-md-12 heading-section ftco-animate">
								<span class="subheading">About Us</span>
								<h2 class="mb-4">Make Your Tour Memorable and Safe With Us</h2>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
								<p><a href="#" class="btn btn-primary">Book Your Destination</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section> -->

<section class="ftco-section testimony-section bg-bottom" style="background-image: url(images/bg_1.jpg);">
	<div class="overlay"></div>
	<div class="container">
		<div class="row justify-content-center pb-4">
			<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
				<span class="subheading">Testimonios</span>
				<h2 class="mb-4">Comentarios Turísticos</h2>
			</div>
		</div>
		<div class="row ftco-animate">
			<div class="col-md-12">
				<div class="carousel-testimony owl-carousel">
					<div class="item">
						<div class="testimony-wrap py-4">
							<div class="text">
								<p class="star">
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
								</p>
								<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
								<div class="d-flex align-items-center">
									<div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
									<div class="pl-3">
										<p class="name">Roger Scott</p>
										<span class="position">Marketing Manager</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap py-4">
							<div class="text">
								<p class="star">
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
								</p>
								<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
								<div class="d-flex align-items-center">
									<div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
									<div class="pl-3">
										<p class="name">Roger Scott</p>
										<span class="position">Marketing Manager</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap py-4">
							<div class="text">
								<p class="star">
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
								</p>
								<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
								<div class="d-flex align-items-center">
									<div class="user-img" style="background-image: url(images/person_3.jpg)"></div>
									<div class="pl-3">
										<p class="name">Roger Scott</p>
										<span class="position">Marketing Manager</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap py-4">
							<div class="text">
								<p class="star">
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
								</p>
								<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
								<div class="d-flex align-items-center">
									<div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
									<div class="pl-3">
										<p class="name">Roger Scott</p>
										<span class="position">Marketing Manager</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap py-4">
							<div class="text">
								<p class="star">
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
								</p>
								<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
								<div class="d-flex align-items-center">
									<div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
									<div class="pl-3">
										<p class="name">Roger Scott</p>
										<span class="position">Marketing Manager</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>




<!-- <section class="ftco-intro ftco-section ftco-no-pt">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12 text-center">
				<div class="img" style="background-image: url(images/bg_2.jpg);">
					<div class="overlay"></div>
					<h2>We Are JM Expeditions A Travel Agency</h2>
					<p>We can manage your dream building A small river named Duden flows by their place</p>
					<p class="mb-0"><a href="#" class="btn btn-primary px-4 py-3">Ask For A Quote</a></p>
				</div>
			</div>
		</div>
	</div>
</section> -->

<?php
include 'layouts/footer.php'
?>