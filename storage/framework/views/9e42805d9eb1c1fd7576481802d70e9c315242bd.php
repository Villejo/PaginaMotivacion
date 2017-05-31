<?php $__env->startSection('title'); ?>
Reportar Daño
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background: #d6d9db;">
	<form class="form-horizontal" enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="" >
		<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">  	
		<h2><i class="fa fa-book fa-2x" aria-hidden="true"></i>Reportar daño de máquina</h2>
		<br>
		<div class="form-group">
			<div class="alert alert-success" style="display: none;" id="success-alerta1">	<h3><span class="fa fa-thumbs-up fa-2x"></span> <strong>El mensaje se envió con éxito..!!</strong></h3>					
			</div>
			<label class="col-sm-3 control-label"></label>			
			<div class="panel panel-danger" style="display:none" id="estilo_mensaje">
				<div class="panel-heading" id="id_validacion" style="display:none">					
				</div>
			</div>			
		</div>
		<br>
		<div class="form-group">
			<label class="col-sm-2 control-label"><i class="fa fa-flag" title="Titulo" aria-hidden="true"></i>
				Equipo:</label>
				<div class="col-sm-9">					
					<select class="form-control selectpicker" data-live-search="true" id="id_nombre_equipo" name="id_nombre_equipo" autofocus>
						<option></option>
					</select>			
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"><i class="fa fa-flag" title="Titulo" aria-hidden="true"></i>
					Titulo</label>
					<div class="col-sm-9">
						<input type="text" id="titulo_mensaje" name="titulo_mensaje" placeholder="Titulo Mensaje" class="form-control">					
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><i class="fa fa-comment" title="Mensaje" aria-hidden="true"></i>
						Mensaje:</label>
						<div class="col-sm-9">
							<textarea id="mensaje_notificacion" name="mensaje_notificacion" placeholder="Mensaje" class="form-control">						
							</textarea>						
						</div>
					</div> 				

					<div class="form-group">    
						<label class="col-sm-2 control-label"><i class="fa fa-picture-o" aria-hidden="true"></i>
							Imagen:</label>  
							<div class="col-sm-9">   
								<input type="file" name="ImagenMensaje" class="form-control btn btn-primary" id="catagry_logo" accept="image/jpeg, image/jpg,image/png" />
								<span class="help-block">Solo se permiten formatos: JPG,JPEG y PNG.</span>        
							</div>
						</div>

						<div class="form-group" id="div_photo_notificacion" style="display: none">    
							<label class="col-sm-2 control-label"><i class="fa fa-picture-o" aria-hidden="true"></i>Vista Previa:</label> 
							<div class="col-sm-9">  
								<img id="img_destino" name="img_destino" height="200" width="300"> 
								<span class="help-block">Capacidad Máxima 1 MB.</span>    
							</div>
						</div>
						<div class="form-group" id="div_peso_imagen" style="display: none">    
							<label class="col-sm-2 control-label">Tamaño:</label> 
							<label class="col-sm control-label" id="totalPeso"></label></div>
						</form>
						<div class="form-group">   							
							<div class="col-sm-9">   
								<button type="button" class="btn btn-circle blue BtnEnviar">
									<strong> <font size ="2", color ="#f9f9f9"> <span class= "fa fa-paper-plane"></span></font></strong>
									<strong> <font size ="2", color ="#f9f9f9" face="Lucida Sans"><span>Enviar</span></font></strong>
								</button>	      
							</div>
							<br>
							<br>
						</div>

					</div>			
					<?php echo e(Form::input("hidden", "_token", csrf_token())); ?>




					<div class="modal fade" id="ModalConfirmar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">					
									<h4 class="modal-title" id="myModalLabel">¿ Esta seguro de enviar el mensaje ?</h4>
									<input type="hidden" name="IdNotificacion" id="IdNoti" class="form-control">
								</div>					
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
									<button type="button" class="btn btn-primary EnviarNotificacion">Enviar</button>
								</div>
							</div>
						</div>
					</div>

					<script type="text/javascript">
						cargar_nombres_equipos();
						$('#mensaje_notificacion').val('');
						function Obtener_Imagen_Registro(input) {
							var size=2097152;
							if (input.files && input.files[0]) {
								var reader = new FileReader();
								var file_size=document.getElementById('catagry_logo').files[0].size;
								if(file_size>=size){
									$('#estilo_mensaje').show();
									document.getElementById("id_validacion").innerText = "La imagen que intentas subir es muy pesada.";
									document.getElementById("id_validacion").style.display = "block";
							// $('#Modal_Registro_Productos').scrollTop(0);					
							// document.getElementById('btn_registrar_producto').disabled=true;
							$('#catagry_logo').val('');	
							$('#div_photo_notificacion').hide();
							$('#div_peso_imagen').hide();				
							return false;
						}
						// document.getElementById('btn_registrar_producto').disabled=false;
						$('#estilo_mensaje').hide();
						document.getElementById("id_validacion").innerText = "";			reader.onload = function (e) {
							$('#img_destino').attr('src', e.target.result);
							$('#totalPeso').text(Math.round(e.loaded/1024/1024) + "MB");
						}
						reader.readAsDataURL(input.files[0]);
					}else{
						$('#div_photo_notificacion').hide();
						$('#div_peso_imagen').hide();
					}
				}

				$("#catagry_logo").change(function(){
					$('#div_photo_notificacion').show();
					$('#div_peso_imagen').show();
					Obtener_Imagen_Registro(this);
				});


				function cargar_nombres_equipos(){
					$el =$('#id_nombre_equipo');
					var _token=$('#_token').val();
					$.ajax({
						url   : "<?= URL::to('cargar_nombres_equipos') ?>",
						type  : "POST",
						async : false,
						data  :{
							'_token'       	  : _token
						},
						success:function(re){
							var option = $('<option />');
							$.each(re, function(key,value) {
								$el.append($("<option></option>")
									.attr("value", key).text(value));
							});							

							var options = $('.selectpicker option');
							var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
							arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
							options.each(function(i, o) {
								o.value = arr[i].v;
								$(o).text(arr[i].t);
							});
						}
					});
				} 

				function Valida_Datos(){
					var espacio_blanco    = /[a-z,0-9]/i;  //Expresión regular
					var id_nombre_equipo = document.getElementById("id_nombre_equipo").value;
					var  titulo_mensaje = $('#titulo_mensaje').val();
					var  mensaje_notificacion = $('#mensaje_notificacion').val();
					var ImagenMensajee =document.getElementById("catagry_logo");

					
					if(id_nombre_equipo==0){
						$('#estilo_mensaje').show();						
						document.getElementById("id_validacion").innerText = "Debes seleccionar un Equipo";
						document.getElementById("id_validacion").style.display = "block";
						$('#id_nombre_equipo').focus();
						return true;
					}else{
						if(titulo_mensaje==""  || !espacio_blanco.test(titulo_mensaje)) {
							$('#estilo_mensaje').show();						
							document.getElementById("id_validacion").innerText = "Debes ingresar el titulo de mensaje";
							document.getElementById("id_validacion").style.display = "block";
							$('#titulo_mensaje').focus();							
							return true;
						}else{
							if(mensaje_notificacion==""  || !espacio_blanco.test(mensaje_notificacion)) {
								$('#estilo_mensaje').show();						
								document.getElementById("id_validacion").innerText = "Debes ingresar el mensaje.";
								document.getElementById("id_validacion").style.display = "block";
								$('#mensaje_notificacion').focus();
								return true;
							}else{
								if(ImagenMensajee.value==""){
									$('#estilo_mensaje').show();
									document.getElementById("id_validacion").innerText = "Toma o selecciona una imagen del daño.";
									document.getElementById("id_validacion").style.display = "block";
									return true;
								}else{
									$('#estilo_mensaje').hide();
									return false;
								}								
							}
						}						

					}
				}

				var arriba;
				function subir() {
					if (document.body.scrollTop != 0 || document.documentElement.scrollTop != 0) {
						window.scrollBy(0, -2000);
						arriba = setTimeout('subir()', 10);
					}
					else clearTimeout(arriba);
				}



				$('.BtnEnviar').click(function(){
					if(Valida_Datos()!=true){
						$('#ModalConfirmar').modal('show');
					}else{
						subir();
					}
				});

				$('.EnviarNotificacion').click(function(){
					$.ajax({
						url:'RegistrarNotificacion',
						data:new FormData($("#upload_form")[0]),
						dataType:'json',
						async:false,
						type:'post',
						processData: false,
						contentType: false,
						success:function(respuesta){
							if(respuesta==0){        
								$('#success-alerta1').show();       
								$(document).ready (function(){  
									$('#ModalConfirmar').modal('hide');
									$("#success-alerta1").hide(); 
									$("#success-alerta1").alert();     
									$("#success-alerta1").fadeTo(4500, 500).slideUp(500, function(){
										$("#success-alerta1").hide();
									});  
								});
								LimpiarFormulario();
							}							

							if(respuesta.error==false){
								$.each(respuesta.errors,function(index, error){  
									$('#estilo_mensaje').show();
									document.getElementById("id_validacion").innerText = 'ERROR: '+error;
									document.getElementById("id_validacion").style.display = "block";   
								}); 								
							}							
						},
						error:function(respuesta){
							// console.log(respuesta);
						}
					});
				}); 

				function LimpiarFormulario(){	
					$('#titulo_mensaje').val('');
					$('#mensaje_notificacion').val('');					
					$('#catagry_logo').val('');	
					$('#div_photo_notificacion').hide('');
					$('#id_nombre_equipo').val('').selectpicker('refresh');
					// $('#id_nombre_equipo').selectpicker('toggle');
				}

			</script>
			<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>