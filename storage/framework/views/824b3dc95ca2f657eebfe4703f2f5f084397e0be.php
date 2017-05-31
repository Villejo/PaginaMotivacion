<?php $__env->startSection('title'); ?>
Gana dinero desde Casa
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php foreach($Publicaciones as $Publicacion): ?>
<div class="col-md-12 blog-post">
	<div class="post-image">
		<!-- <img src="Estilos/images/blog/1.jpg" alt="">                                        -->
	</div> 
	<div class="post-title">
		<a href="single.html">
			<h1>
				<?php echo e($Publicacion->Titulo_Publicacion); ?>

			</h1>
		</a>
	</div>  
	<div class="post-info">		
		<span><?php echo e(Carbon::parse($Publicacion->Fecha_Publicacion)->toFormattedDateString()); ?>/ por <a href="#" target="_blank"><?php echo e(ucwords($Publicacion->Nombre_Usuario_Publicacion->nombre)); ?> <?php echo e(ucwords($Publicacion->Nombre_Usuario_Publicacion->apellido)); ?></a></span>
	</div>  
	<p>
		<?php echo e($Publicacion->Detalle_Publicacion); ?>

	</p>                          			
	<a href="single.html" class="button button-style button-anim fa fa-long-arrow-right"><span>Leer Más</span></a>
</div>			
<?php endforeach; ?>

<div class="col-md-12 text-center">
	<a href="javascript:void(0)" id="load-more-post" class="load-more-button">Load</a>
	<div id="post-end-message"></div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>