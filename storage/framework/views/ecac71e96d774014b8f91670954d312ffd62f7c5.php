<?php $__env->startSection('title'); ?>
Gana dinero desde Casa
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

	<div class="row">
		<div class="sub-title">
			<h2>Acerca de mi</h2>
			<a href="contact.html"><i class="icon-envelope"></i></a>
		</div>
		<div class="col-md-12 content-page">
			<div class="col-md-12 blog-post">
				<div class="post-title margin-bottom-30">
					<h1>Hola, Soy <span class="main-color">JORGE MUÑOZ</span></h1>

					<ul class="knowledge">
						<li class="bg-color-1">Diseñador web</li>
						<li class="bg-color-4">Desarrollador web</li>
						<li class="bg-color-6">Persona de libre dedicación</li>
						<li class="bg-color-5">Emprendedor</li>
					</ul>
				</div>
				<p>Voy a contarles un pequeño fragmento sobre mí, estoy en el desarrollo y aplicativos web desde el 2012, durante este tiempo he aprendido muchas y con el paso de tiempo he logrado observar que todo no es el diseño y creación de aplicativos, hoy día en la actualidad todo se mueve por el <b><a href="http://www.mundovirtual.biz/como-ganar-dinero-en-internet-27-formas/" data-toggle="tooltip" data-placement="top" title="Si el internet!!">Internet</a></b>.<br><br>
					Quiero enseñarles este video que hice para compartirles. 
				</p>
				<!-- Video Start -->
				<div class="video-box margin-top-40 margin-bottom-80">
					<div class="video-tutorial">
						<a class="video-popup" href="https://www.youtube.com/watch?v=O2Bsw3lrhvs" title="Reprodúceme">
							<img src="images/televisor.png" alt="">
						</a>                           
					</div>
					<p>Tomate tu tiempo y mira este increíble video.</p>
					
				</div>
				<!-- Video End -->
				<br>
				<center>
					<a href="<?php echo e(URL::route('Camino')); ?>">
						<button class="btn btn-success" type="button">						
							>> PRIMER PASO (EL CAMINO)							
						</button>
					</a>
				</center>
				<br><br><br>


				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="display:inline-block;text-align:center;justify-content: center;aling-items: center">
					<div class="panel panel-warning" style="background: #c2c3c4">
						<!-- <div class="panel-heading"></div> -->
						<div class="panel-body">
							<div class="row">
								<div class="fb-comments" data-href="http://temotivo.teloprogramo.net/Principal" data-numposts="10"></div>
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