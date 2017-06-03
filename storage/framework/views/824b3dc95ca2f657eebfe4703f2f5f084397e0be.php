<?php $__env->startSection('title'); ?>
Gana dinero desde Casa
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php foreach($Publicaciones as $Publicacion): ?>
<div class="panel panel-info">
	<div class="panel-heading">
		<div class="post-title">
			<a href="single.html">
				<h1>
					<center><?php echo e($Publicacion->Titulo_Publicacion); ?></center>
				</h1>
			</a>			
		</div>		
	</div>
	<div class="panel-body">
		<div class="panel panel-warning">
			<!-- <div class="panel-heading"></div> -->
			<div class="panel-body">
				<div class="col-md-12 blog-post">					
					<div class="post-info">
						<span>Publicado : <?php echo e(Carbon::parse($Publicacion->Fecha_Publicacion)->toFormattedDateString()); ?>/ por <strong><?php echo e($Publicacion->Nombre_Usuario_Publicacion->nombre); ?> <?php echo e($Publicacion->Nombre_Usuario_Publicacion->apellido); ?></strong> <a href="#" target="_blank"></a></span>
					</div>  
					<p>
						<?php echo e($Publicacion->Detalle_Publicacion); ?>

						<br>
						<a href="single.html" class="button button-style button-anim fa fa-long-arrow-right">Leer Más</a>
					</p>
					<div class="post-image">
						<!-- <img src="Estilos/images/blog/1.jpg" alt=""> -->
					</div>
				</div>
				<div class="row">	
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-md-offset-1">	
						<div class="fb-comments" data-href="http://comentario1.net/" data-numposts="10"></div>
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>
<br>

<?php endforeach; ?>




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