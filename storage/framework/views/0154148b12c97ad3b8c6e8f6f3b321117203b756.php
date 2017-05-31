<ul class="nav navbar-nav pull-right">

	<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
		<?php if(Auth::user()->fk_rol==1): ?> 
		<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
			<i class="icon-envelope-open"></i>
			<?php if($Notificacion==0): ?>			
			<?php else: ?>
			<span class="badge badge-default">
				<?php echo e($Notificacion); ?>

			</span>
			<?php endif; ?>
		</a>
		<ul class="dropdown-menu">
			<li class="external">
				<?php if($Notificacion==1): ?>
				<h3>Tienes <span class="bold"><?php echo e($Notificacion); ?> Nuevo</span> Mensaje</h3>
				<a href="<?php echo e(URL::route('Notificaciones')); ?>">Ver todos</a>
				<?php elseif($Notificacion>=1): ?>
				<h3>Tienes <span class="bold"><?php echo e($Notificacion); ?> Nuevos</span> Mensajes</h3>
				<a href="<?php echo e(URL::route('Notificaciones')); ?>">Ver todos</a>
				<?php else: ?>
				<h3>No tienes<span class="bold"> Nuevos</span> Mensajes</h3>
				<?php endif; ?>				
			</li>

			<?php if($Mensaje): ?>
			<li>
				<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
					<?php foreach($Mensaje as $key => $value): ?> 				
					<li>
						<a href="<?php echo e(URL::route('Notificaciones')); ?>">
							<span class="photo">
								<?php if(File::exists($value->Nombre_Usuario->ruta_photo_profile)): ?>
								<img src="<?php echo e($value->Nombre_Usuario->ruta_photo_profile); ?>" class="img-rounded" alt="">
								<?php else: ?>
								<img src="global/images/no_photo_profile.png" class="img-rounded" alt="">
								<?php endif; ?>
							</span>
							<span class="subject">
								<span class="from">
									<?php echo e($value->Nombre_Usuario->nombre_usuario); ?> <?php echo e($value->Nombre_Usuario->apellido); ?></span>
									<span class="time">
										<i class="fa fa-clock-o" aria-hidden="true"></i><?php echo e($hora_notificacion=Carbon::parse($value->hora_notificacion)->diffForHumans()); ?></span>
									</span>
									<span class="message">
										<?php echo e($titulo_mensaje=$value->titulo_mensaje); ?>

									</span>	
									<span class="message">
										<?php echo e($value->Nombre_Equipo->nombre_equipo); ?>	
									</span>	
								</span>
							</a>
						</li>
						<?php endforeach; ?>	
					</ul>
				</li>
			</ul>
			<?php endif; ?>

			<?php else: ?>								
			<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
				<li>
				</li>
			</ul>
			<?php endif; ?>						
			<li class="dropdown dropdown-user">
				<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<!-- <img alt="" class="img-circle PhotoPequenaPerfil" src="global/images/img.jpg"/> -->
					<?php if(Auth::user()->ruta_photo_profile==null): ?>
					<img src="global/images/no_photo_profile.png"  title="Usuario Sin Foto" class="img-circle PhotoPequenaPerfil"/>
					<?php elseif(File::exists(Auth::user()->ruta_photo_profile)): ?>
					<img src="<?php echo e(Auth::user()->ruta_photo_profile); ?>" Imagen="<?php echo e(Auth::user()->ruta_photo_profile); ?>"  class="img-circle PhotoPequenaPerfil"/>	
					<?php else: ?>		
					<img src="global/images/no_photo_profile.png"  title="Usuario Sin Foto" class="img-circle PhotoPequenaPerfil" />
					<?php endif; ?>
					<span class="username username-hide-on-mobile">
						<?php echo e(Auth::user()->nombre_usuario); ?> <?php echo e(Auth::user()->apellido); ?></span>
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<?php if(Auth::user()->fk_rol!='1'): ?>
						<li>
							<a href="<?php echo e(URL::route('MyProfile')); ?>">
								<i class="icon-user"></i> Mi Perfil </a>
							</li>
							<li class="divider">
							</li>
							<?php endif; ?>							
							<li>
								<a href="<?php echo e(URL::route('Salir')); ?>">
									<i class="icon-key"></i> Cerrar Sesión </a>
								</li>
							</ul>
						</li>
					</li>
				</ul>										

				<script>
					jQuery(document).ready(function() {
						Metronic.init();  																
					});
				</script>
