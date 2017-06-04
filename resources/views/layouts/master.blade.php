<?php
date_default_timezone_set('America/Bogota');
use Carbon\Carbon;

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


	<title>@yield('title')</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="Estilos/images/favicon/favicon.ico">
	<link rel="apple-touch-icon" sizes="144x144" type="image/x-icon" href="Estilos/images/favicon/apple-touch-icon.png">  
	<link rel="stylesheet" type="text/css" href="Estilos/css/plugin.css">  
	<link rel="stylesheet" type="text/css" href="Estilos/css/style.css">  
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700">
	<script src="jquery/jquery-3.1.0.min.js"></script>	
	<input type="hidden" name="_token" id="_token"  value="{{ csrf_token() }}">
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
									<?php
									$vista = Route::currentRouteName();
									$current = array
									(
										'Principal' => ''
										);
									if ($vista == '' || $vista == 'Principal'){
										$current['Principal'] = 'active';
									}								
									?>
									
									<li class="{{$current['Principal']}}">
										<a href="{{URL::route('Principal')}}">Introducción</a>
									</li>
									<li><a href="about.html">Camino</a></li>
									<li><a href="work.html">Seguridad</a></li>
									<li><a href="contact.html">Herramientas</a></li>
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
					@yield('content')
					<div class="col-md-12 page-body margin-top-50 footer">
						<footer>

							<ul class="menu-link">

								
								<li class="{{$current['Principal']}}">
									<a href="{{URL::route('Principal')}}">Introducción</a>
								</li>
								<li><a href="about.html">Camino</a></li>
								<li><a href="work.html">Seguridad</a></li>
								<li><a href="contact.html">Herramientas</a></li>
							</ul>
							<p>© Copyright 2017 Villejo. Todos los derechos Reservados</p>
							<div class="uipasta-credit">Diseñado por <a href="https://www.facebook.com/Jorgeleoanardo18" target="_blank">@Villejo</a></div>
						</footer>
					</div>		
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






