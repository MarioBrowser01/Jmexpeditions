<?php
// require_once 'layouts/header.php';
include '../app/controller/config.php';
require_once dirname(__DIR__) . '/templates/layouts/header.php';
?>


<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center pb-4">
			<div class="col-md-12 heading-section text-center ftco-animate">
				<span class="subheading">Our Blog</span>
				<h2 class="mb-4">Recent Post</h2>
			</div>
		</div>
		<div class="row d-flex">
			<div class="col-md-4 d-flex ftco-animate">
				<div class="blog-entry justify-content-end">
					<a href="blog-single.html" class="block-20" style="background-image: url('images/image_1.jpg');">
					</a>
					<div class="text">
						<div class="d-flex align-items-center mb-4 topp">
							<div class="one">
								<span class="day">11</span>
							</div>
							<div class="two">
								<span class="yr">2020</span>
								<span class="mos">September</span>
							</div>
						</div>
						<h3 class="heading"><a href="#">Most Popular Place In This World</a></h3>
						<!-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p> -->
						<p><a href="#" class="btn btn-primary">Read more</a></p>
					</div>
				</div>
			</div>
			<div class="col-md-4 d-flex ftco-animate">
				<div class="blog-entry justify-content-end">
					<a href="blog-single.html" class="block-20" style="background-image: url('images/image_2.jpg');">
					</a>
					<div class="text">
						<div class="d-flex align-items-center mb-4 topp">
							<div class="one">
								<span class="day">11</span>
							</div>
							<div class="two">
								<span class="yr">2020</span>
								<span class="mos">September</span>
							</div>
						</div>
						<h3 class="heading"><a href="#">Most Popular Place In This World</a></h3>
						<!-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p> -->
						<p><a href="#" class="btn btn-primary">Read more</a></p>
					</div>
				</div>
			</div>
			<div class="col-md-4 d-flex ftco-animate">
				<div class="blog-entry">
					<a href="blog-single.html" class="block-20" style="background-image: url('images/image_3.jpg');">
					</a>
					<div class="text">
						<div class="d-flex align-items-center mb-4 topp">
							<div class="one">
								<span class="day">11</span>
							</div>
							<div class="two">
								<span class="yr">2020</span>
								<span class="mos">September</span>
							</div>
						</div>
						<h3 class="heading"><a href="#">Most Popular Place In This World</a></h3>
						<!-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p> -->
						<p><a href="#" class="btn btn-primary">Read more</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>







<?php
require_once dirname(__DIR__) . '/templates/layouts/footer.php';
?>