<?php
date_default_timezone_set('America/Bogota');
use Carbon\Carbon;
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Meta Tag -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- SEO -->
	<meta name="description" content="150 words">
	<meta name="author" content="uipasta">
	<meta name="url" content="http://www.yourdomainname.com">
	<meta name="copyright" content="company name">
	<meta name="robots" content="index,follow">


	<title><?php echo $__env->yieldContent('title'); ?></title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="Estilos/images/favicon/favicon.ico">
	<link rel="apple-touch-icon" sizes="144x144" type="image/x-icon" href="Estilos/images/favicon/apple-touch-icon.png">  
	<link rel="stylesheet" type="text/css" href="Estilos/css/plugin.css">  
	<link rel="stylesheet" type="text/css" href="Estilos/css/style.css">  
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700">
</head>
<body>
	<div class="preloader">
		<div class="rounder"></div>
	</div>
	<div id="main">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="about-fixed">
						<div class="my-pic">
							<img src="Estilos/images/blog/author.png" alt="">
							<a href="javascript:void(0)" class="collapsed" data-target="#menu" data-toggle="collapse"><i class="icon-menu menu"></i></a>
							<div id="menu" class="collapse">
								<ul class="menu-link">
									<li><a href="about.html">Acerca</a></li>
									<li><a href="work.html">Trabajo</a></li>
									<li><a href="contact.html">Contacto</a></li>
								</ul>
							</div>
						</div>
						<div class="my-detail">
							<div class="white-spacing">
								<h1>Jorge Muñoz</h1>
								<span>Emprendedor</span>
							</div> 
							<ul class="social-icon">
								<li><a href="#" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#" target="_blank" class="github"><i class="fa fa-github"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="col-md-12 page-body">
						<div class="row">
							<div class="sub-title">
								<h2>Bienvenido a mi BLOG</h2>
								<a href="contact.html"><i class="icon-envelope"></i></a>
							</div>
							<div class="col-md-12 content-page">
								<?php echo $__env->yieldContent('content'); ?>	
								<div class="col-md-12 text-center">
									<a href="javascript:void(0)" id="load-more-post" class="load-more-button" title="Cargar Mensajes Anteriores">Cargar</a>
									<div id="post-end-message"></div>
								</div>							
							</div>							
						</div>
					</div>
				</div>
				<!-- Footer Start -->
				<div class="col-md-12 page-body margin-top-50 footer">
					<footer>
						<ul class="menu-link">
							<li><a href="index.html">Home</a></li>
							<li><a href="about.html">About</a></li>
							<li><a href="work.html">Work</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
						<p>© Copyright 2016 DevBlog. All rights reserved</p>
						<div class="uipasta-credit">Design By <a href="http://www.uipasta.com" target="_blank">UiPasta</a></div>
					</footer>
				</div>					
				
			</div>
		</div>
	</div>



	<!-- Back to Top Start -->
	<a href="#" class="scroll-to-top"><i class="fa fa-long-arrow-up"></i></a>
	<!-- Back to Top End -->


	<!-- All Javascript Plugins  -->
	<script type="text/javascript" src="Estilos/js/jquery.min.js"></script>
	<script type="text/javascript" src="Estilos/js/plugin.js"></script>

	<!-- Main Javascript File  -->
	<script type="text/javascript" src="Estilos/js/scripts.js"></script>


</body>
</html>






