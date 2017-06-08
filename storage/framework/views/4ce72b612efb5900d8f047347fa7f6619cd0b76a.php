<?php $__env->startSection('title'); ?>
Gana dinero desde Casa -CAMINO
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="sub-title">
		<h2>Me alegra que estés en esta parte :)</h2>
		<a href="contact.html"><i class="icon-envelope"></i></a>
	</div>
	<div class="col-md-12 content-page">
		<div class="col-md-12 blog-post">
			<div class="post-title margin-bottom-30">
				<h1>Conoce el <span class="main-color">CAMINO</span></h1>
					<!-- <ul class="knowledge">
						<li class="bg-color-1">Diseñador web</li>
						<li class="bg-color-4">Desarrollador web</li>
						<li class="bg-color-6">Persona de libre dedicación</li>
						<li class="bg-color-5">Emprendedor</li>
					</ul> -->
				</div>				
				<p align="justify">
					No debes preocuparte por vender productos o con cumplir con un volumen de ventas mensuales. En esta empresa solo te piden trabajar 5 minutos en el dia para garantizar tu permanencia.
					Puedes desarrollar este negocio desde tu celular o PC.
					Comparte la oportunidad y recibe increibles ganacias.
					Puedes hacerlo de forma gratuita. 
				</p>
				<!-- <div class="col-md-12 blog-post"> -->
				<div class="post-image">
					<img src="images/FreseMotiva.jpg" alt="">					
				</div>					
				<!-- </div> -->
				


				<!-- Video Start -->
				<div class="video-box margin-top-200 margin-bottom-80">
					<div class="video-tutorial">

						<a class="video-popup" href="https://www.youtube.com/watch?v=O2Bsw3lrhvs" title="Reprodúceme">
							<img src="images/televisor.png" alt="">
						</a>                           
					</div>
					<p align="justify">Tomate tu tiempo y mira este increíble video.</p>
					
				</div>
				<!-- Video End -->
				<br>
				<center>
					<a href="<?php echo e(URL::route('Seguridad')); ?>">
						<button class="btn btn-success" type="button">						
							>> SEGUNDO PASO (SEGURIDAD)						
						</button>
					</a>
				</center>
				<br><br><br>


				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="display:inline-block;text-align:center;justify-content: center;aling-items: center">
					<div class="panel panel-warning" style="background: #c2c3c4">
						<!-- <div class="panel-heading"></div> -->
						<div class="panel-body">
							<div class="row">
								<div class="fb-comments" data-href="http://temotivo.teloprogramo.net/Camino" data-numposts="10"></div>
							</div>					
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>











	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.9";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>



	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>