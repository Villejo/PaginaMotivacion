<?php $__env->startSection('title'); ?>
Menú Usuarios
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if(Auth::user()->cambiar_password=='Si'): ?>
<center>
	<div class="panel panel-default" id="estilo_mensaje" style="width: 400px; height: 30px; display: none;">
		<div class="panel-heading" id="id_validacion" style="display: none;" >
		</div>
	</div>
</center>
<br><br>
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-refresh fa-2x" aria-hidden="true"></i> <strong>CAMBIAR PASSWORD</strong>
	</div>
	<div class="panel-body">
		<div class="row col-md-offset-3">					
			<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">			
				<table class="table table-user-information">									
					<tbody>							
						<tr>
							<td>
								<center>
									<b>
										<strong>									
											<font color="#0a80cc" face="Arial">
												<center><h2>Por seguridad debes cambiar tu contraseña</h2>
													<label>Ingresea una contraseña</label><br>
													<input type="password" name="contrasena1" id="contrasena1" class="form-control btn-circle"><br><br>
													<label>Confirmar contraseña</label><br>
													<input type="password" name="contrasena2" id="contrasena2" class="form-control btn-circle"><br><br>
													<button type="button" class="btn btn-circle ModificarPassword" style="background-color: #0578bf" title="Modificar Password">
														<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Actualizar Password</span>
															<span class="fa fa-refresh"></span>
														</font></strong>
													</button>
												</center>
											</font>
										</strong>
									</b>
								</center>
							</td>
						</tr>
						<tr>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php else: ?>
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-user fa-2x" aria-hidden="true"></i> <strong><label id="TextoUsuario"></label></strong>
	</div>
	<div class="panel-body">
		<form class="form-horizontal" enctype="multipart/form-data" id="Formulario_Perfil" role="form" method="POST" action="" >
			<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
			<div class="row col-md-offset-3">					
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">			
					<table class="table table-user-information">									
						<tbody>							
							<tr>
								<td>
									<center>
										<b>
											<strong>									
												<font color="#0a80cc" face="Arial">
													<label id="NombrePerfil"></label>
												</font>
											</strong>
										</b>							
									</center>						
									<center>							
										<img id="FotoUsuarioPerfil" width="200" height="200" border="5"/>
										<br>

										<input type="file" name="ImagenPerfil" class="form-control" id="ImagenPerfil" accept="image/jpeg, image/jpg,image/png" placeholder="Ingresa logo de la empresa" style="background-color: #32045e; color:#ffffff; " />
										<span class="help-block">Solo se permiten formatos:</span>
											<span class="help-block">JPG,JPEG y PNG.</span>
											<br>
										</center>
										<center>
											<b>
												<font size ="2", color="#562502" face="Tahoma">
													Tu rol actual es:</font></b> <br>
													<span class="badge btn-md btn-success" style="background: #299ee8;">
														<b>
															<strong>
																<font size ="2">
																	<label id="RangoPerfil"></label>
																</font>
															</strong>
														</b>
													</span>
												</center>
											</td>	
										</tr>
										<tr>
											<td></td>
										</tr>
									</tbody>	
								</table>
							</div>					
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<table class="table table-user-information">								
									<tbody>							
										<tr>
											<td>																	
												<b>
													<font size ="2", color="#562502" face="Tahoma">
														<i class="fa fa-briefcase fa-2x" aria-hidden="true" title="Codigo"></i>
													</font>												
													<strong>
														<font color="#0a80cc" face="Arial">
															<label id="CodigoPerfil"></label>
														</font>
													</strong>
												</b>
											</td>								
										</tr>
										<tr>								
											<td>								
												<b>
													<font size ="2", color="#562502" face="Tahoma">
														<i class="fa fa-phone-square fa-2x" aria-hidden="true" title="Telefono Usuario"></i>
													</font>
													<strong>
														<font color="#0a80cc" face="Arial">
															<label id="TelefonoPerfil"></label>
														</font>
													</strong>
												</b>
											</td>								
										</tr>
										<tr>								
											<td>								
												<b>
													<font size ="2", color="#562502" face="Tahoma">
														<i class="fa fa-address-card fa-2x" aria-hidden="true" title="Direccion Usuario"></i>
													</font>
													<strong>
														<font color="#0a80cc" face="Arial">
															<label id="DireccionPerfil"></label>
														</font>
													</strong>
												</b>
											</td>								
										</tr>
										<tr>								
											<td>								
												<b>
													<font size ="2", color="#562502" face="Tahoma">
														<i class="fa fa-envelope fa-2x" aria-hidden="true" title="Correo Usuario"></i>
													</font>
													<strong>
														<font color="#0a80cc" face="Arial">
															<label id="DireccionEmailPerfil"></label>
														</font>
													</strong>
												</b>
											</td>								
										</tr>						
										<tr>								
											<td>								
												<b>
													<font size ="2", color="#562502" face="Tahoma">
														<i class="fa fa-refresh fa-2x" aria-hidden="true" title="Restablecer Password"></i> 
													</font>
													<a href="#" class="RestablecerPassword2"><label id="TextoRestablecer"></label></a>						
												</b>
											</td>
										</tr>
										<tr>
											<td>
												<div class="panel panel-danger" style="display:none" id="estilo_mensaje5">
													<div class="panel-heading" id="id_validacion5" style="display:none">
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>	
						</div>
					</form>
				</div>
			</div>
			<?php endif; ?>
			<!-- Modal Confirmacion Restablecer Password Usuario-->
			<div class="modal fade" id="Modal_Confirmar_Restablecer_Password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">					
							<h4 class="modal-title" id="myModalLabel">¿ Esta seguro que todo esta correcto?	
							</h4>
						</div>					
						<div class="modal-footer">
							<button type="button" class="btn btn-circle RestablecerPassword" style="background-color: #562502" title="Si">
								<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>SI</span>
									<span class="fa fa-check"></span>
								</font></strong>
							</button>
							<button type="button" class="btn btn-circle" data-dismiss="modal" style="background-color: #fc0019" title="No">
								<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>NO</span>
									<span class="fa fa-times"></span>
								</font></strong>
							</button>					
						</div>
					</div>
				</div>
			</div>
			<!--  Termina Modal Confirmacion Restablecer Password Usuario-->

			<!-- Modal Restablecer Password Usuario Manual-->
			<div class="modal fade" id="Modal_Restablecer_Password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">					
							<h4 class="modal-title" id="myModalLabel">
								<b><strong> <font size ="2", color="#562502" face="Arial Black">
									<i class="fa fa-refresh fa-2x" aria-hidden="true"></i> MODIFICAR PASSWORD</font></strong>	
								</h4>
							</div>
							<div class="modal-body">
								<div class="panel panel-danger" style="display:none" id="estilo_mensaje2">
									<div class="panel-heading" id="id_validacion2" style="display:none">
									</div>
								</div>					
								<input type="password" name="PasswordModificar1" id="PasswordModificar1" class="form-control" placeholder="Ingresa un nuevo Password">
								<br>
								<input type="password" name="PasswordModificar2" id="PasswordModificar2" class="form-control" placeholder="Confirmar Password">
							</div>			
							<div class="modal-footer">
								<button type="button" class="btn btn-circle" onclick="Validar_Modificar_Password();" style="background-color: #562502" title="Si">
									<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>MODIFICAR</span>
										<span class="fa fa-check"></span>
									</font></strong>
								</button>
								<button type="button" class="btn btn-circle" data-dismiss="modal" style="background-color: #fc0019" title="No">
									<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>NO</span>
										<span class="fa fa-times"></span>
									</font></strong>
								</button>					
							</div>
						</div>
					</div>
				</div>
				<!--  Termina Confirmacion Restablecer Password Usuario Manual-->

				<!-- Modal Confirmacion Restablecer Password Usuario-->
				<div class="modal fade" id="Modal_Confirmar_Cambiar_Password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">					
								<h4 class="modal-title" id="myModalLabel">¿ Esta seguro que todo esta correcto?	
								</h4>
							</div>					
							<div class="modal-footer">
								<button type="button" class="btn btn-circle ModificarPassworUsuario" style="background-color: #562502" title="Si">
									<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>SI</span>
										<span class="fa fa-check"></span>
									</font></strong>
								</button>
								<button type="button" class="btn btn-circle" data-dismiss="modal" style="background-color: #fc0019" title="No">
									<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>NO</span>
										<span class="fa fa-times"></span>
									</font></strong>
								</button>					
							</div>
						</div>
					</div>
				</div>
				<!--  Termina Modal Confirmacion Restablecer Password Usuario-->

				<script type="text/javascript">

					$("#ImagenPerfil").change(function(){
					// $('#div_photo_producto').show();
					// $('#div_peso_imagen').show();
					Obtener_Imagen(this);
				});

					function Obtener_Imagen(input) {
						var size=2097152;
						if (input.files && input.files[0]) {
							var reader = new FileReader();
							var file_size=document.getElementById('ImagenPerfil').files[0].size;
							if(file_size>=size){
								$('#estilo_mensaje5').show();
								$("#id_validacion5").css("fontSize", 15);						
								$("#id_validacion5").css("font-weight","Bold"); 	
								$("#estilo_mensaje5").attr("class", "panel panel-success");
								$('#id_validacion5').show();			
								$('#id_validacion5').html('<i class="fa fa-exclamation" aria-hidden="true"></i> ERROR: La imagen que intentas subir es muy pesada.');
								$("#estilo_mensaje5").fadeTo(5500, 500).slideUp(500, function(){
									$("#estilo_mensaje5").hide();									
								});
								$('#ImagenPerfil').val('');	
							// $('#div_photo_producto').hide();
							// $('#div_peso_imagen').hide();				
							return false;
						}						
						$('#estilo_mensaje').hide();
						$('#id_validacion5').hide();			
						$('#id_validacion5').html('');			
						reader.onload = function (e) {
							$('#FotoUsuarioPerfil').attr('src', e.target.result);
							$('.PhotoPequenaPerfil').attr('src', e.target.result);
							// $('#totalPeso').text(Math.round(e.loaded/1024/1024) + "MB");
						}
						reader.readAsDataURL(input.files[0]);
						Subir_Imagen();
						document.getElementById("ImagenPerfil").disabled = true;
					}else{
						var Foto="global/images/no_photo_profile.png";
						$('#FotoUsuarioPerfil').attr('src', Foto);						
						// $('#div_photo_producto').hide();
						// $('#div_peso_imagen').hide();
					}
				}

				function Subir_Imagen(){
					$.ajax({
						url:'ActualizarFotoPerfil',
						data:new FormData($("#Formulario_Perfil")[0]),
						dataType:'json',
						async:false,
						type:'post',
						processData: false,
						contentType: false,
						success:function(respuesta){
							if(respuesta==0){  
								$('#ImagenPerfil').val('');	      
								$('#estilo_mensaje5').show();
								$("#id_validacion5").css("fontSize", 15);						
								$("#id_validacion5").css("font-weight","Bold"); 	
								$("#estilo_mensaje5").attr("class", "panel panel-success");
								$('#id_validacion5').show();			
								$('#id_validacion5').html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> Se actualizo correctamente la imagen de perfil.');
								$("#estilo_mensaje5").fadeTo(5500, 500).slideUp(500, function(){
									$("#estilo_mensaje5").hide();	
									document.getElementById("ImagenPerfil").disabled = false;													
								});	

							}
						}
					});
				}


				$('.ModificarPassword').click(function(){
					var patron =/[a-z/0-9]/;
					var contrasena1=$('#contrasena1').val();
					var contrasena2=$('#contrasena2').val();
					var PasswordModificar11 =parseInt($('#contrasena1').val().length);
					var PasswordModificar22 =parseInt($('#contrasena2').val().length);

					if(!patron.test(contrasena1)){
						$('#estilo_mensaje').show();
						$("#id_validacion").css("fontSize", 15);						
						$("#id_validacion").css("font-weight","Bold"); 	
						$("#estilo_mensaje").attr("class", "panel panel-danger");
						$('#estilo_mensaje').show();			
						$('#id_validacion').html('La contraseña no puede estar vacia, solo se permiten letras y numeros.');
						$('#contrasena1').val('');
						document.getElementById("contrasena1").focus();
						$('#id_validacion').show();				
					}else{
						if(!patron.test(contrasena2)){
							$('#estilo_mensaje').show();
							$("#id_validacion").css("fontSize", 15);						
							$("#id_validacion").css("font-weight","Bold"); 	
							$("#estilo_mensaje").attr("class", "panel panel-danger");
							$('#estilo_mensaje').show();			
							$('#id_validacion').html('Debes confirmar la contraseña.');
							$('#contrasena2').val('');
							document.getElementById("contrasena2").focus();
							$('#id_validacion').show();				
						}else{
							if(PasswordModificar11<7){
								$('#estilo_mensaje').show();
								$("#id_validacion").css("fontSize", 15);						
								$("#id_validacion").css("font-weight","Bold"); 	
								$("#estilo_mensaje").attr("class", "panel panel-danger");
								$('#estilo_mensaje').show();			
								$('#id_validacion').html('Las contraseñas debe ser mayor a 7 Caracteres.');								
								document.getElementById("contrasena1").focus();
								$('#id_validacion').show();
							}else{
								if(PasswordModificar22<7){
									$('#estilo_mensaje').show();
									$("#id_validacion").css("fontSize", 15);						
									$("#id_validacion").css("font-weight","Bold"); 	
									$("#estilo_mensaje").attr("class", "panel panel-danger");
									$('#estilo_mensaje').show();			
									$('#id_validacion').html('Las contraseñas debe ser mayor a 7 Caracteres.');								
									document.getElementById("contrasena2").focus();
									$('#id_validacion').show();
								}else{
									if(contrasena1!=contrasena2){
										$('#estilo_mensaje').show();
										$("#id_validacion").css("fontSize", 15);						
										$("#id_validacion").css("font-weight","Bold"); 	
										$("#estilo_mensaje").attr("class", "panel panel-danger");
										$('#estilo_mensaje').show();			
										$('#id_validacion').html('Las contraseñas no coinciden.');
										$('#contrasena2').val('');
										document.getElementById("contrasena2").focus();
										$('#id_validacion').show();				
									}else{
										$('#id_validacion').hide();	
										$('#estilo_mensaje').hide();
										$('#Modal_Confirmar_Restablecer_Password').modal('show');
									}
								}
							}
						}
					}
				});

				$('.RestablecerPassword').click(function(){
					var contrasena2=$('#contrasena2').val();
					$.ajax({
						type:'GET',
						data: {
							'contrasena2' 		: contrasena2				
						},
						url:'<?php echo e(url('ModificarPasswordUsuario')); ?>',
						success: function(respuesta){      
							if(respuesta==0){ 
								$('#Modal_Confirmar_Restablecer_Password').modal('hide');  
								$('#estilo_mensaje').show();
								$("#id_validacion").css("fontSize", 15);						
								$("#id_validacion").css("font-weight","Bold"); 	
								$("#estilo_mensaje").attr("class", "panel panel-success");
								$('#id_validacion').show();			
								$('#id_validacion').html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> Se realizó el cambio satisfactoriamente.');
								$("#estilo_mensaje").fadeTo(5500, 500).slideUp(500, function(){
									$("#estilo_mensaje").hide();
									location.reload(); 
								});
							}
						}
					});
				});

				Cargar_Datos_Perfil();

				function Cargar_Datos_Perfil(){				

					$.ajax({
						type:'GET',					
						url:'<?php echo e(url('Cargar_Datos_Perfil_Usuario')); ?>',
						success: function(respuesta){
							$('#NombrePerfil').text(respuesta.NombrePerfil);
							$("#NombrePerfil").css("fontSize", 18);						
							$("#NombrePerfil").css("font-weight","Bold");					
							$('#RangoPerfil').text(respuesta.RangoPerfil);
							$("#NombrePerfil").css("fontSize", 18);						
							$("#NombrePerfil").css("font-weight","Bold");	
							$('#CodigoPerfil').text(respuesta.CodigoPerfil);					
							$("#CodigoPerfil").css("fontSize", 18);						
							$("#CodigoPerfil").css("font-weight","Bold");	
							$('#TelefonoPerfil').text(respuesta.TelefonoPerfil);				
							$("#TelefonoPerfil").css("fontSize", 18);						
							$("#TelefonoPerfil").css("font-weight","Bold");					
							$('#DireccionPerfil').text(respuesta.DireccionPerfil);
							$("#DireccionPerfil").css("fontSize", 18);						
							$("#DireccionPerfil").css("font-weight","Bold");
							$('#DireccionEmailPerfil').text(respuesta.DireccionEmailPerfil);			
							$("#DireccionEmailPerfil").css("fontSize", 18);						
							$("#DireccionEmailPerfil").css("font-weight","Bold");	
							$('#TextoRestablecer').text('Cambiar Passoword');	
							$("#TextoRestablecer").css("fontSize", 18);						
							$("#TextoRestablecer").css("font-weight","Bold");	
							$('#TextoUsuario').text('Perfil Usuario');	
							$("#TextoUsuario").css("fontSize", 18);						
							$("#TextoUsuario").css("font-weight","Bold");								
							$("#FotoUsuarioPerfil").attr("src",respuesta.FotoUsuarioPerfil);			
						}
					});
				}

				$('.RestablecerPassword2').click(function(){
					LimpiarDatos();
					$('#Modal_Restablecer_Password').modal('show');
				});

				function Validar_Modificar_Password(){
					var PasswordModificar1= $('#PasswordModificar1').val();
					var PasswordModificar2= $('#PasswordModificar2').val();
					var PasswordModificar11 =parseInt($('#PasswordModificar1').val().length);
					var PasswordModificar22 =parseInt($('#PasswordModificar2').val().length);

					var patron =/[a-z/0-9]/;
					if(!patron.test(PasswordModificar1)){
						$('#estilo_mensaje2').show();
						$("#id_validacion2").css("fontSize", 15);						
						$("#id_validacion2").css("font-weight","Bold"); 	
						$("#estilo_mensaje2").attr("class", "panel panel-danger");
						$('#estilo_mensaje2').show();			
						$('#id_validacion2').html('La contraseña no puede estar vacia, solo se permiten letras y numeros.');
						$('#PasswordModificar1').val('');
						document.getElementById("PasswordModificar1").focus();
						$('#id_validacion2').show();					
					}else{
						if(!patron.test(PasswordModificar2)){
							$('#estilo_mensaje2').show();
							$("#id_validacion2").css("fontSize", 15);						
							$("#id_validacion2").css("font-weight","Bold"); 	
							$("#estilo_mensaje2").attr("class", "panel panel-danger");
							$('#estilo_mensaje2').show();			
							$('#id_validacion2').html('Debes confirmar la contraseña.');
							$('#PasswordModificar2').val('');
							document.getElementById("PasswordModificar2").focus();
							$('#id_validacion2').show();				
						}else{
							if(PasswordModificar11<7){
								$('#estilo_mensaje2').show();
								$("#id_validacion2").css("fontSize", 15);						
								$("#id_validacion2").css("font-weight","Bold"); 	
								$("#estilo_mensaje2").attr("class", "panel panel-danger");
								$('#estilo_mensaje2').show();			
								$('#id_validacion2').html('Las contraseñas debe ser mayor a 7 Caracteres.');								
								document.getElementById("PasswordModificar1").focus();
								$('#id_validacion2').show();
							}else{
								if(PasswordModificar22<7){
									$('#estilo_mensaje2').show();
									$("#id_validacion2").css("fontSize", 15);						
									$("#id_validacion2").css("font-weight","Bold"); 	
									$("#estilo_mensaje2").attr("class", "panel panel-danger");
									$('#estilo_mensaje2').show();			
									$('#id_validacion2').html('Las contraseñas debe ser mayor a 7 Caracteres.');								
									document.getElementById("PasswordModificar2").focus();
									$('#id_validacion2').show();
								}else{
									if(PasswordModificar1!=PasswordModificar2){
										$('#estilo_mensaje2').show();
										$("#id_validacion2").css("fontSize", 15);						
										$("#id_validacion2").css("font-weight","Bold"); 	
										$("#estilo_mensaje2").attr("class", "panel panel-danger");
										$('#estilo_mensaje2').show();			
										$('#id_validacion2').html('Las contraseñas no coinciden.');
										$('#PasswordModificar2').val('');
										document.getElementById("PasswordModificar2").focus();
										$('#id_validacion2').show();
									}else{
										$('#id_validacion2').hide();	
										$('#estilo_mensaje2').hide();
										$('#Modal_Confirmar_Cambiar_Password').modal('show');
									}
								}
							}
						}
					}
				}

				$('.ModificarPasswordUsuario').click(function(){
					$('#Modal_Confirmar_Cambiar_Password').modal('show');
				});

				$('.ModificarPassworUsuario').click(function(){
					var PasswordModificar1= $('#PasswordModificar1').val();
					var PasswordModificar2= $('#PasswordModificar2').val();
					$.ajax({
						type:'GET',
						data: {
							'PasswordModificar1' 		: PasswordModificar1,	
							'PasswordModificar2' 		: PasswordModificar2			
						},
						url:'<?php echo e(url('ModificarPasswordUsuario_Manual')); ?>',
						success: function(respuesta){      
							if(respuesta==0){
								$('#Modal_Confirmar_Cambiar_Password').modal('hide');
								$('#Modal_Restablecer_Password').modal('hide');			
								$('#estilo_mensaje5').show();
								$("#id_validacion5").css("fontSize", 15);						
								$("#id_validacion5").css("font-weight","Bold"); 	
								$("#estilo_mensaje5").attr("class", "panel panel-success");
								$('#id_validacion5').show();			
								$('#id_validacion5').html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> Se realizó el cambio de password satisfactoriamente.');
								$("#estilo_mensaje5").fadeTo(5500, 500).slideUp(500, function(){
									$("#estilo_mensaje5").hide();									
								});
								LimpiarDatos();
							}
						}
					});

				});
				function LimpiarDatos(){
					$('#PasswordModificar1').val('');
					$('#PasswordModificar2').val('');
					$('#id_validacion2').hide();	
					$('#estilo_mensaje2').hide();
				}
			</script>
			<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>