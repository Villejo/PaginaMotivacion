<?php if($Notificacion->total()==0): ?>
<div class="col-xs-12 col-sm-12 col col-md-12 col-lg-12">
	<img src="global/images/sin_notificaciones.png" alt="logo" class="img-thumbnail img-responsive" >
</div>
<?php else: ?>
<?php foreach($Notificacion as $value): ?>
<input type="hidden" value="<?php echo e($Titulo_Mensaje=$value->titulo_mensaje); ?>">
<div class="col-xs-12 col-sm-12 col col-md-6 col-lg-6">
	<div class="panel panel-success">
		<div class="panel-heading">
			<span class="btn-danger badge btn-md" title="<?php echo e($Titulo_Mensaje = strtoupper($Titulo_Mensaje)); ?>"><b><strong> <font size ="2"><?php echo e(strtoupper($Titulo_Mensaje)); ?>

			</font></strong></b></span>
			<strong>(<?php echo e(Carbon::parse($value->hora_notificacion)->diffForHumans()); ?>)</strong>	
			<div class="btn-group pull-right">			
				<?php if($value->estado=='Si'): ?>
				<!-- <input type="checkbox" name="checkbox1" id="checkbox1" checked="true" class="id_mensaje_editar checkbox1"  estado="<?php echo e($value->id); ?>"> -->
				<button class="btn btn-info checkbox_1" estado="<?php echo e($value->id); ?>" estado_mensaje="<?php echo e($value->estado); ?>">
					<i class="fa fa-thumbs-down" aria-hidden="true"></i>
					MENSAJE SIN LEER					
				</button>
				<!-- <input type="checkbox" name="checkbox1" id="checkbox1" class="id_mensaje_editar checkbox1"  estado="<?php echo e($value->id); ?>"> -->
				<?php else: ?>
				<button class="btn btn-warning checkbox_1" estado="<?php echo e($value->id); ?>" estado_mensaje="<?php echo e($value->estado); ?>">
					<i class="fa fa-thumbs-up" aria-hidden="true"></i>
					MENSAJE LEIDO
				</button>
				<?php endif; ?>	
			</div>
		</div>
		<div class="panel-body">			
			<?php if(File::exists($value->imagen_foto)): ?>
			<center><img class="cuadradoFoto FotoGrande" src="<?php echo e($value->imagen_foto); ?>" Imagen="<?php echo e($value->imagen_foto); ?>" width="200px" height="200px"/></center>			
			<?php else: ?>
			<center><img src="global/images/error.png" class="cuadradoFoto" width="200px" height="200px"/></center>	
			<?php endif; ?>
			<h4><p class="text-muted credit"></p></h4>
			<div class="panel panel-success">
				<div class="panel-heading"></div>				
				<table class="table table-user-information">
					<div class="row">
						<tbody>
							<tr>
								<td style="width:150px !important">						
									<i class="fa fa-android" aria-hidden="true"></i>
									EQUIPO:
								</td>
								<td>								
									<?php echo e(ucfirst($value->Nombre_Equipo->nombre_equipo)); ?>					
								</td>
							</tr>
							<tr>
								<td>						
									<i class="fa fa-flag" title="Titulo" aria-hidden="true"></i>
									TITULO:
								</td>
								<td>								
									<?php echo e(ucfirst($value->titulo_mensaje)); ?>					
								</td>
							</tr>
							<tr>
								<td>					
									<!-- <b><strong> <font size ="2", color="#000000" face="Arial Black">Mensaje:</font></strong></b> -->
									<i class="fa fa-comment" title="Mensaje" aria-hidden="true"></i>
									MENSAJE:
								</td>
								<td>
									<?php echo e(ucfirst($value->mensaje)); ?>

								</td>								
							</tr>
							<tr>
								<td>					
									<!-- <b><strong> <font size ="2", color="#000000" face="Arial Black">Notificado por:</font></strong></b> -->
									<i class="fa fa-user" title="Usuario" aria-hidden="true"></i>
									NOTIFICADO POR:
								</td>
								<td>
									<?php echo e(ucfirst($value->Nombre_Usuario->nombre_usuario)); ?> <?php echo e(ucfirst($value->Nombre_Usuario->apellido)); ?>

								</td>								
							</tr>
							<tr>
								<td>					
									<!-- <b><strong> <font size ="2", color="#000000" face="Arial Black">Hora:</font></strong></b> -->
									<i class="fa fa-clock-o" title="Hora" aria-hidden="true"></i>
									HORA:
								</td>
								<td>
									<?php echo e(Carbon::parse($value->hora_notificacion)->toDayDateTimeString()); ?>

								</td>								
							</tr>
							<tr>
								<td>					
									<!-- <b><strong> <font size ="2", color="#000000" face="Arial Black">Fecha:</font></strong></b> -->
									<i class="fa fa-calendar" title="Fecha" aria-hidden="true"></i>
									FECHA:
								</td>
								<td>								
									<?php echo e(Carbon::parse($value->fecha_notificacion)->toDateString()); ?> 					
								</td>								
							</tr>
							<td>
							</td>
							<td>
							</td>											
						</tbody>
					</div>
				</table>
			</div>
			<div class="panel-footer">
				<div class="btn-group pull-right">	
					<?php if(File::exists($value->imagen_foto)): ?>
					<a href="<?php echo e($value->imagen_foto); ?>" download="<?php echo e($value->imagen_foto); ?>" title="Descargar Imagen"><strong> <font size ="3", color="#0eacf9" face="Lucida Sans">
						<span class="fa fa-download fa-2x"></span></font></strong>
						<?php else: ?>
						<a title="Imagen no disponible" <strong> <font size ="3", color="#0eacf9" face="Lucida Sans"><span class="fa fa-download fa-2x"></span></font>
							<?php endif; ?>
						</a>
						<a href="#" data-toggle = 'modal' data-target="#Modal_Confirmacion_Delete" title="Eliminar Mensaje" class="Eliminar_Notificacion" NombreNotificacion="<?php echo e($Titulo_Mensaje = strtoupper($Titulo_Mensaje)); ?>"  IdNotificacion="<?php echo e($value->id); ?>" <strong> <font size ="3", color="#0eacf9" face="Lucida Sans"><span class="fa fa-trash-o fa-2x"></span></font></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach; ?>		
	<center><?php echo e($Notificacion->links()); ?></center>		
	<?php endif; ?>
	<!-- Modal See Imagen-->
	<div class="modal fade" id="Modal_See_Imagen" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">	
				<center><img class="cuadradoFoto" id="id_photo_notificacion" width="100%" height="100%"/></center>			
			</div>
		</div>
	</div>
	<!-- Termina Modal See Imagen-->

	<!-- Modal Confirmar Eliminar Notificacion -->
	<!-- Modal -->
	<div class="modal fade" id="ModalEliminarNotificacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">					
					<h4 class="modal-title" id="myModalLabel">¿ Esta Seguro de eliminar la notificación: <label id="NombreNotificacion"></label> ?</h4>
					<input type="hidden" name="IdNotificacion" id="IdNoti" class="form-control">
				</div>					
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-primary delete_notificacion">Eliminar</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Confirmar Cambiar Estado -->
	<div class="modal fade" id="ModalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Esperando Confirmarcion...</h4>
				</div>
				<div class="modal-body">
					¿ Esta seguro de cambiar el estado del mensaje?
					<input type="hidden" name="id_mensaje" id="id_mensaje" class="form-control">
					<input type="hidden" name="estado_mensaje" id="estado_mensaje" class="form-control">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary CambiarSi">SI</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>					
				</div>
			</div>
		</div>
	</div>
	<!-- Termina Modal Confirmar Eliminar Notificacion -->
	<?php echo e(Form::input("hidden", "_token", csrf_token())); ?>

	<script type="text/javascript">
		$('body').delegate('.FotoGrande','click',function(){
			var ruta_imagen =($(this).attr('Imagen'));	
			$("#id_photo_notificacion").attr("src",ruta_imagen);		
			$('#Modal_See_Imagen').modal('show');

		});


		$('body').delegate('.checkbox_1','click',function(){
			var id_notificacion =($(this).attr('estado'));	
			var estado_mensaje =($(this).attr('estado_mensaje'));

			$('#ModalConfirmacion').modal('show');
			$('#id_mensaje').val(id_notificacion);
			$('#estado_mensaje').val(estado_mensaje);
		});


		$('.CambiarSi').click(function(){
			var id_notificacion=$('#id_mensaje').val();
			var estado_mensaje= $('#estado_mensaje').val();
			var _token=$('#_token').val();

			if(estado_mensaje=='Si'){
				$estado='No';

				var _token=$('#_token').val();
				$.ajax({
					type:'POST',
					data:{
						'id_notificacion'	: id_notificacion,
						'estado'			: $estado,					
						'_token'		 	: _token					
					},
					url:'<?php echo e(url('Cambiar_Estado_Notificacion')); ?>',
					success: function(data){ 		
						if(data=='ok'){	
							$('#ModalConfirmacion').modal('hide');  					
							NotificacionesMensajes();
							Cargar_Notificaciones_Tabla();
						}
					}         
				});
			}else{
				var id_notificacion=$('#id_mensaje').val();
				var estado_mensaje= $('#estado_mensaje').val();
				var _token=$('#_token').val();

				if(estado_mensaje=='No'){
					$estado='Si';

					var _token=$('#_token').val();
					$.ajax({
						type:'POST',
						data:{
							'id_notificacion'	: id_notificacion,
							'estado'			: $estado,					
							'_token'			: _token					
						},
						url:'<?php echo e(url('Cambiar_Estado_Notificacion')); ?>',
						success: function(data){ 					

							if(data=='ok'){	
						$('#ModalConfirmacion').modal('hide');  					// ;
						NotificacionesMensajes();
						Cargar_Notificaciones_Tabla();
					}			

				}         
			});
				}	
			}
		});		

		function Cambiar_Estado_Notificacion($id_notificacion,$estado){
			var _token=$('#_token').val();
			$.ajax({
				type:'POST',
				data:{
					'id_notificacion': $id_notificacion,
					'estado'		: $estado,					
					'_token'		 : _token					
				},
				url:'<?php echo e(url('Cambiar_Estado_Notificacion')); ?>',
				success: function(data){ 					

						if(data=='ok'){						// ;
							// NotificacionesMensajes();
							Cargar_Notificaciones_Tabla();
						}
					// $('#Tabla_Notificaciones').empty().html(data);

				}         
			});
		}

		$('body').delegate('.Eliminar_Notificacion','click',function(){
			var NombreNotificacion =($(this).attr('NombreNotificacion'));	
			var IdNotificacion =($(this).attr('IdNotificacion'));	

			$('#NombreNotificacion').text(NombreNotificacion);
			$('#IdNoti').val(IdNotificacion);				
			$('#ModalEliminarNotificacion').modal('show');		

		});

		$('.delete_notificacion').click(function(){
			var IdNotificacion =$('#IdNoti').val();	
			var _token=$('#_token').val();
			$.ajax({
				type:'POST',
				data:{
					'IdNotificacion'	: IdNotificacion,								
					'_token'		 	: _token					
				},
				url:'<?php echo e(url('Eliminar_Notificacion')); ?>',
				success: function(data){ 
					if(data=='ok'){
						$('#ModalEliminarNotificacion').modal('hide');  
						Cargar_Notificaciones_Tabla();
						NotificacionesMensajes();
					}
				}         
			});
		});

	</script>

