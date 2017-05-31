<?php $__env->startSection('title'); ?>
Asignaciones
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-bar col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<ul class="page-breadcrumb">
		<li>			
			<a href="<?php echo e(URL::route('Index')); ?>">Inicio</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Asignaciones</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<i class="fa fa-file-o" aria-hidden="true"></i>
			<a href="#" class="NuevaAsignacion">Nueva Asignación</a>
			<i class="fa fa-angle-right"></i>			
		</li>
		<li class="BuscarAsignacion" style="display: none;">
			<i class="fa fa-search" aria-hidden="true"></i>
			<a href="#">Buscar Asignación</a>			
		</li>
	</ul>
</div>
<br>
<br>
<br>
<div class="alert alert-success" style="display: none;" id="success-alerta1">	
	<h3><span class="fa fa-thumbs-up fa-2x"></span>
		<strong>Se registro con éxito la nueva Asignación..!!</strong>				
	</h3>					
</div>
<div class="alert alert-danger" style="display: none;" id="success-alerta2">	
	<h3><span class="fa fa-thumbs-up fa-2x"></span>
		<strong>Se eliminó con éxito la asignación...!!</strong>				
	</h3>					
</div>
<div class="alert alert-info" style="display: none;" id="success-alerta3">	
	<h3><span class="fa fa-thumbs-up fa-2x"></span>
		<strong>Se modifico con éxito la asignación...!!</strong>				
	</h3>					
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div id="tabla_asignaciones"></div>
</div>

<!-- Modal Registro Asignacion-->
<div class="modal fade" id="Modal_Registro_Asignacion" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#007835" face="Arial Black">
						<i class="fa fa-file-o fa-2x" aria-hidden="true"></i> NUEVA ASIGNACIÓN</font></strong>						
					</b>
				</h4>
			</div>
			<div class="modal-body">
				<table class="table table-user-information">
					<div class="row">						
						<tbody>	
							<div class="panel panel-danger" style="display:none" id="estilo_mensaje">
								<div class="panel-heading" id="id_validacion" style="display:none">
								</div>
							</div>
							<tr>
								<input type="hidden" name="id_maquina_oculta" id="id_maquina_oculta">
								<td>								
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Selecciona el Usuario:</font></strong></b>
								</td>
								<td>
									<select class="form-control selectpicker id_nombre_usuario" data-live-search="true" id="id_nombre_usuario" name="id_nombre_usuario" autofocus>
										<option></option>
									</select>
								</td>
							</tr>								
							<tr>
								<td>								
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Selecciona el Turno:</font></strong></b>
								</td>
								<td>
									<select class="form-control selectpicker id_turno" data-live-search="true" id="id_turno" name="id_turno" autofocus>
										<option></option>
									</select>
								</td>
							</tr>
							<tr>
								<td>								
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Selecciona el Formulario:</font></strong></b>
								</td>
								<td>
									<select class="form-control selectpicker id_formulario" data-live-search="true" id="id_formulario" name="id_formulario" onchange="Cargar_id_Maquina();" autofocus>
										<option></option>
									</select>
								</td>
							</tr>
							<tr>
								<td>								
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Fecha Inicial:</font></strong></b>
								</td>
								<td>								
									<div class="form-group">				
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
											<input type="text" class="form-control form-filter input-sm" name="Fecha_Inicial" id="Fecha_Inicial"   placeholder="Fecha Inicial" value="<?php echo e(Carbon::today()->toDateString()); ?>" readonly>
											<span class="input-group-btn">
												<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
									</div>
								</td>
							</tr>								
							<tr>
								<td>								
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Fecha Final:</font></strong></b>
								</td>
								<td>								
									<div class="form-group">				
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
											<input type="text" class="form-control form-filter input-sm" name="Fecha_Final" id="Fecha_Final"   placeholder="Fecha Final" value="<?php echo e(Carbon::today()->toDateString()); ?>" readonly>
											<span class="input-group-btn">
												<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</div>
				</table>
			</div>			
			<div class="modal-footer">
				<button type="button" onclick="Registrar();"  class="btn btn-circle" style="background-color: #007835" title="Registrar">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>REGISTRAR</span>
						<span class="fa fa-plus-square"></span>
					</font></strong>
				</button>
				<button type="button" class="btn btn-circle" data-dismiss="modal" style="background-color: #fc0019" title="Cancelar">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>CANCELAR</span>
						<span class="fa fa-times"></span>
					</font></strong>
				</button>
			</div>
		</div>
	</div>
</div>
<!-- Termina Modal Registro Asignacion -->
<div class="modal fade" id="ModalConfirmar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">					
				<h4 class="modal-title" id="myModalLabel">¿ Esta seguro de Crear la Asignación ?</h4>
				<input type="hidden" name="IdNotificacion" id="IdNoti" class="form-control">
			</div>					
			<div class="modal-footer">
				<button type="button" class="btn btn-primary RegistrarAsignacion">SI</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>					
			</div>
		</div>
	</div>
</div>
<!-- Modal Buscar Asignacion-->
<div class="modal fade" id="Modal_Buscar_Asignacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#007835" face="Arial Black">
						<i class="fa fa-search fa-2x" aria-hidden="true"></i> BUSCAR ASIGNACIÓN</font></strong>						
					</b>
				</h4>
			</div>
			<div class="modal-body">
				<table class="table table-user-information">
					<div class="row">						
						<tbody>
							<tr>
								<div class="panel panel-danger" style="display:none" id="estilo_mensaje2">
									<div class="panel-heading" id="id_validacion2" style="display:none">
									</div>
								</div>
								<td>								
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Selecciona el Usuario:</font></strong></b>
								</td>
								<td>
									<select class="form-control selectpicker nombreUsuarios" data-live-search="true" id="NombreUsuarioBuscar" name="NombreUsuarioBuscar" onchange="LimpiarEnBuscar();" autofocus>
										<option></option>
									</select>
								</td>
							</tr>
						</tbody>
					</div>
				</table>
			</div>			
			<div class="modal-footer">
				<button type="button" onclick="BuscarUsuario();"  class="btn btn-circle" style="background-color: #007835" title="Buscar">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>BUSCAR</span>
						<span class="fa fa-search"></span>
					</font></strong>
				</button>
				<button type="button" class="btn btn-circle" data-dismiss="modal" style="background-color: #fc0019" title="Cancelar">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>CANCELAR</span>
						<span class="fa fa-times"></span>
					</font></strong>
				</button>
			</div>
		</div>
	</div>
</div>
<!-- Termina Modal Buscar Asignacion -->
<!-- Modal Editar Asignacion-->
<div class="modal fade" id="Modal_Editar_Asignacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#007835" face="Arial Black">
						<i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i> EDITAR ASIGNACIÓN</font></strong>						
					</b>
				</h4>
			</div>
			<div class="modal-body">
				<table class="table table-user-information">
					<div class="row">
						<input type="hidden" name="id_nombre_usuario_editar_oculto" id="id_nombre_usuario_editar_oculto">	
						<input type="hidden" name="id_turno_editar_oculto" id="id_turno_editar_oculto">	
						<input type="hidden" name="id_formulario_editar_oculto" id="id_formulario_editar_oculto">					
						<tbody>					
							<div class="panel panel-danger" style="display:none" id="estilo_mensaje3">
								<div class="panel-heading" id="id_validacion3" style="display:none">
								</div>
							</div>
							<tr>
								<input type="hidden" name="id_oculto_editar" id="id_oculto_editar">
								<input type="hidden" name="id_maquina_oculta_editar" id="id_maquina_oculta_editar">
								<td>								
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Selecciona el Usuario:</font></strong></b>
								</td>
								<td>
									<select class="form-control selectpicker" data-live-search="true" id="id_nombre_usuario_editar" name="id_nombre_usuario_editar" autofocus>
										<option></option>
									</select>
								</td>
							</tr>								
							<tr>
								<td>								
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Selecciona el Turno:</font></strong></b>
								</td>
								<td>
									<select class="form-control selectpicker id_turno_editar" data-live-search="true" id="id_turno_editar" name="id_turno_editar" autofocus>
										<option></option>
									</select>
								</td>
							</tr>
							<tr>
								<td>								
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Selecciona el Formulario:</font></strong></b>
								</td>
								<td>
									<select class="form-control selectpicker id_formulario_editar" data-live-search="true" id="id_formulario_editar" name="id_formulario_editar" onchange="Consultar_Id_Maquina_Editar();" autofocus>
										<option></option>
									</select>
								</td>
							</tr>
							<tr>
								<td>								
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Fecha Inicial:</font></strong></b>
								</td>
								<td>								
									<div class="form-group">				
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
											<input type="text" class="form-control form-filter input-sm" name="Fecha_Inicial_editar" id="Fecha_Inicial_editar"   placeholder="Fecha Inicial" value="<?php echo e(Carbon::today()->toDateString()); ?>" readonly>
											<span class="input-group-btn">
												<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
									</div>
								</td>
							</tr>								
							<tr>
								<td>								
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Fecha Final:</font></strong></b>
								</td>
								<td>								
									<div class="form-group">				
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
											<input type="text" class="form-control form-filter input-sm" name="Fecha_Final_editar" id="Fecha_Final_editar"   placeholder="Fecha Final" value="<?php echo e(Carbon::today()->toDateString()); ?>" readonly>
											<span class="input-group-btn">
												<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</div>
				</table>
			</div>			
			<div class="modal-footer">
				<button type="button" onclick="Editar_Asignacion();"  class="btn btn-circle" style="background-color: #007835" title="Modificar">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>MODIFICAR</span>
						<span class="fa fa-pencil-square-o"></span>
					</font></strong>
				</button>
				<button type="button" class="btn btn-circle" data-dismiss="modal" style="background-color: #fc0019" title="Cancelar">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>CANCELAR</span>
						<span class="fa fa-times"></span>
					</font></strong>
				</button>
			</div>
		</div>
	</div>
</div>
<!-- Termina Modal Registro Asignacion -->
<!-- Modal Confirmacion Editar Asignacion -->
<div class="modal fade" id="Modal_Confirmar_Editar_Asignacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">					
				<h4 class="modal-title" id="myModalLabel">¿ Esta seguro de Modificar la Asignación ?</h4>
				<input type="hidden" name="IdNotificacion" id="IdNoti" class="form-control">
			</div>					
			<div class="modal-footer">
				<button type="button" class="btn btn-primary ModificarAsignacion">SI</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>					
			</div>
		</div>
	</div>
</div>
<!--  Termina Modal Confirmacion Editar Asignacion -->


<?php echo e(Form::input("hidden", "_token", csrf_token())); ?>


<script type="text/javascript">
	Cargar_Tabla();
	Cargar_Usuarios();
	Cargar_Turnos();
	Cargar_Formularios();

	function Cargar_id_Maquina(){
		var id_formulario= document.getElementById("id_formulario").value;


		$.ajax({
			url   : "<?= URL::to('Consultar_Id_Maquina') ?>",
			type  : "GET",
			async : false,
			data  :{
				'id_formulario'       	  : id_formulario
			},
			success:function(respuesta){
				$('#id_maquina_oculta').val(respuesta);				
			}
		});
	}
	function Consultar_Id_Maquina_Editar(){
		var id_formulario_editar= document.getElementById("id_formulario_editar").value;


		$.ajax({
			url   : "<?= URL::to('Consultar_Id_Maquina') ?>",
			type  : "GET",
			async : false,
			data  :{
				'id_formulario_editar'       	  : id_formulario_editar
			},
			success:function(respuesta){
				$('#id_maquina_oculta_editar').val(respuesta);				
			}
		});
	}

	function Editar_Asignacion(){
		var id_nombre_usuario_editar= document.getElementById("id_nombre_usuario_editar").value;
		var id_turno_editar= document.getElementById("id_turno_editar").value;
		var id_formulario_editar= document.getElementById("id_formulario_editar").value;

		var Fecha_Inicial_editar=$('#Fecha_Inicial_editar').val();
		var Fecha_Final_editar=$('#Fecha_Final_editar').val();

		if(id_nombre_usuario_editar==0){			
			$("#estilo_mensaje3").attr("class", "panel panel-danger");
			$("#id_validacion3").css("fontSize" ,15);						
			$("#id_validacion3").css("font-weight","Bold"); 
			$('#estilo_mensaje3').show();			
			$('#id_validacion3').html('Debes seleccionar un Usuario.');	
			$('#id_validacion3').show();
			$('#id_nombre_usuario_editar').selectpicker('toggle');
			return true;
		}else{
			if(id_turno_editar==0){
				$("#estilo_mensaje3").attr("class", "panel panel-danger");
				$("#id_validacion3").css("fontSize" ,15);						
				$("#id_validacion3").css("font-weight","Bold"); 
				$('#estilo_mensaje3').show();			
				$('#id_validacion3').html('Debes seleccionar un Turno.');	
				$('#id_validacion3').show();	
				$('#id_turno_editar').selectpicker('toggle');			
				return true;
			}else{
				if(id_formulario_editar==0){
					$("#estilo_mensaje3").attr("class", "panel panel-danger");
					$("#id_validacion3").css("fontSize" ,15);						
					$("#id_validacion3").css("font-weight","Bold"); 
					$('#estilo_mensaje3').show();			
					$('#id_validacion3').html('Debes seleccionar un Formulario.');	
					$('#id_validacion3').show();	
					$('#id_formulario_editar').selectpicker('toggle');
					$('#estilo_mensaje3').show();			
					return true;
				}else{
					if(Fecha_Inicial_editar==""){
						$("#estilo_mensaje3").attr("class", "panel panel-danger");
						$("#id_validacion3").css("fontSize" ,15);						
						$("#id_validacion3").css("font-weight","Bold"); 
						$('#estilo_mensaje3').show();			
						$('#id_validacion3').html('Debes seleccionar una Fecha inicial.');	
						$('#id_validacion3').show();						
						$('#estilo_mensaje3').show();					
						return true;
					}else{
						if(Fecha_Final_editar==""){
							$("#estilo_mensaje3").attr("class", "panel panel-danger");
							$("#id_validacion3").css("fontSize" ,15);						
							$("#id_validacion3").css("font-weight","Bold"); 
							$('#estilo_mensaje3').show();			
							$('#id_validacion3').html('Debes seleccionar una Fecha final.');	
							$('#id_validacion3').show();
							return true;
						}else{
							inicio= new Date(Fecha_Inicial_editar);
							final= new Date(Fecha_Final_editar);
							if(inicio>final){
								$("#estilo_mensaje3").attr("class", "panel panel-danger");
								$("#id_validacion3").css("fontSize" ,15);						
								$("#id_validacion3").css("font-weight","Bold"); 
								$('#estilo_mensaje3').show();			
								$('#id_validacion3').html('La fecha inicial no puede ser mayor a la fecha final.');	
								$('#id_validacion3').show();							
								return true;
							}else{
								$('#estilo_mensaje3').hide();
								$('#Modal_Confirmar_Editar_Asignacion').modal('show');
								return false;									
							}
						}
					}
				}	
			}
		}
	}





	$('.NuevaAsignacion').click(function(){
		$('#Modal_Registro_Asignacion').modal('show');
	});
	$('.BuscarAsignacion').click(function(){
		LimpiarEnBuscar();
		$('#Modal_Buscar_Asignacion').modal('show');
	});

	$('body').delegate('.Editar_Asignacion','click',function(){
		$('#Modal_Editar_Asignacion').modal('show');
	});


	function LimpiarEnBuscar(){

		$('#estilo_mensaje2').hide();						
		document.getElementById("id_validacion2").innerText = "";
		document.getElementById("id_validacion2").style.display = "block";
		// $('#NombreUsuarioBuscar').selectpicker('refresh');		
		$('#NombreUsuarioBuscar').selectpicker('toggle');
	}


	function BuscarUsuario(){		
		var NombreUsuarioBuscar= document.getElementById("NombreUsuarioBuscar").value;
		if(NombreUsuarioBuscar==0){			
			$('#estilo_mensaje2').show();			
			$('#id_validacion2').html('Debes seleccionar un Usuario.');	
			$('#id_validacion2').show();
			$('#NombreUsuarioBuscar').selectpicker('toggle');
		}else{
			$.ajax({
				url   : "<?= URL::to('ConsultarAsignacionUsuario') ?>",
				type  : "GET",
				async : false,
				data  :{
					'NombreUsuarioBuscar'   : NombreUsuarioBuscar        			
				},
				success:function(respuesta){
					if(respuesta==0){ 
						$('#estilo_mensaje2').show();	
						$('#id_validacion2').html('<i class="fa fa-frown-o fa-2x" aria-hidden="true"></i> No se encontró ningún registro a mostrar.');
					}else{
						$('#Modal_Buscar_Asignacion').modal('hide');						
						$('#tabla_asignaciones').empty().html(respuesta);
					}				
				}
			});
		}
	}



	function Cargar_Tabla(){
		var _token=$('#_token').val();
		$.ajax({
			type:'POST',
			data: {
				'_token' : _token
			},
			url:'<?php echo e(url('Tabla_Asignaciones')); ?>',
			success: function(data){      
				$('#tabla_asignaciones').empty().html(data);
			}
		});

		$(document).on("click",".pagination li a",function(e) {
			e.preventDefault();		
			var url = $(this).attr("href");
			$.ajax({
				type:'get',
				url:url,			
				success: function(data){
					$('#tabla_asignaciones').empty().html(data);				
				}
			});
		});		
	}

	function Cargar_Usuarios(){
		$el =$('#id_nombre_usuario');
		$el2 =$('#NombreUsuarioBuscar');		
		$el3 =$('#id_nombre_usuario_editar');

		var _token=$('#_token').val();
		$.ajax({
			url   : "<?= URL::to('Listar_Usuarios') ?>",
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

				var options = $('id_nombre_usuario option');
				var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});
				
				$.each(re, function(key,value) {
					$el2.append($("<option></option>")
						.attr("value", key).text(value));
				});							

				var options2 = $('id_nombre_usuario option');
				var arr = options2.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options2.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});

				$.each(re, function(key,value) {
					$el3.append($("<option></option>")
						.attr("value", key).text(value));
				});							

				var options3 = $('id_nombre_usuario_editar option');
				var arr = options3.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options3.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});	

			}

		});
	}		

	function Cargar_Turnos(){
		$el =$('#id_turno');
		$el2 =$('#id_turno_editar');		
		
		$.ajax({
			url   : "<?= URL::to('Listar_Turnos') ?>",
			type  : "GET",
			async : false,			
			success:function(re){
				var option = $('<option />');
				$.each(re, function(key,value) {
					$el.append($("<option></option>")
						.attr("value", key).text(value));
				});							

				var options = $('.id_turno option');
				var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});


				$.each(re, function(key,value) {
					$el2.append($("<option></option>")
						.attr("value", key).text(value));
				});							

				var options2 = $('.id_turno_editar option');
				var arr2 = options2.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr2.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options2.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});
			}
		});
	}

	function Cargar_Formularios(){
		$el =$('#id_formulario');
		$el2 =$('#id_formulario_editar');
		
		$.ajax({
			url   : "<?= URL::to('Listar_Formularios') ?>",
			type  : "GET",
			async : false,			
			success:function(re){
				var option = $('<option />');
				$.each(re, function(key,value) {
					$el.append($("<option></option>")
						.attr("value", key).text(value));
				});							

				var options = $('.id_formulario option');
				var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});

				$.each(re, function(key,value) {
					$el2.append($("<option></option>")
						.attr("value", key).text(value));
				});							

				var options2 = $('.id_formulario_editar option');
				var arr2 = options2.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr2.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options2.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});
			}
		});
	}

	function Validar_Asignacion(){
		var id_nombre_usuario= document.getElementById("id_nombre_usuario").value;
		var id_turno= document.getElementById("id_turno").value;
		var id_formulario= document.getElementById("id_formulario").value;

		var FechaInicial=$('#Fecha_Inicial').val();
		var FechaFinal=$('#Fecha_Final').val();

		if(id_nombre_usuario==0){
			$('#estilo_mensaje').show();			
			$('#id_validacion').html('Debes seleccionar un Usuario.');	
			$('#id_validacion').show();	
			$('#id_nombre_usuario').selectpicker('toggle');			
			return true;
		}else{
			if(id_turno==0){
				$('#estilo_mensaje').show();				
				$('#id_validacion').html('Debes seleccionar un Turno.');				
				$('#id_validacion').show();
				$('#id_turno').selectpicker('toggle');
				return true;
			}else{
				if(id_formulario==0){
					$('#estilo_mensaje').show();				
					$('#id_validacion').html('Debes seleccionar un Formulario.');		
					$('#id_validacion').show();	
					$('#id_formulario').selectpicker('toggle');
					return true;
				}else{
					if(FechaInicial==""){
						$('#estilo_mensaje').show();				
						$('#id_validacion').html('Debes seleccionar una Fecha inicial');
						$('#id_validacion').show();
						return true;
					}else{
						if(FechaFinal==""){
							$('#estilo_mensaje').show();				
							$('#id_validacion').html('Debes seleccionar una Fecha final.');
							$('#id_validacion').show();						
							return true;
						}else{
							inicio= new Date(FechaInicial);
							final= new Date(FechaFinal);

							if(inicio>final){
								$('#estilo_mensaje').show();				
								$('#id_validacion').html('La fecha inicial no puede ser mayor a la fecha final.');
								$('#id_validacion').show();							
								return true;
							}else{
								$('#estilo_mensaje').hide();
								return false;									
							}
						}
					}
				}	
			}
		}
	}

	function validate_fechaMayorQue(fechaInicial,fechaFinal){
		valuesStart=fechaInicial.split("/");
		valuesEnd=fechaFinal.split("/");

            // Verificamos que la fecha no sea posterior a la actual
            var dateStart=new Date(valuesStart[2],(valuesStart[1]-1),valuesStart[0]);
            var dateEnd=new Date(valuesEnd[2],(valuesEnd[1]-1),valuesEnd[0]);
            if(dateStart>=dateEnd)
            {
            	return 0;
            }
            return 1;
        }

        function Registrar(){
        	if(Validar_Asignacion()!==true){
        		$('#ModalConfirmar').modal('show');      		

        	}
        }
        $('.RegistrarAsignacion').click(function(){
        	var id_nombre_usuario= document.getElementById("id_nombre_usuario").value;
        	var id_turno= document.getElementById("id_turno").value;
        	var id_formulario= document.getElementById("id_formulario").value;
        	var id_maquina_oculta= document.getElementById("id_maquina_oculta").value;


        	var FechaInicial=$('#Fecha_Inicial').val();
        	var FechaFinal=$('#Fecha_Final').val();
        	var _token=$('#_token').val();
        	$.ajax({
        		url   : "<?= URL::to('RegistrarNewAsignacion') ?>",
        		type  : "POST",
        		async : false,
        		data  :{
        			'id_nombre_usuario'   : id_nombre_usuario,
        			'id_turno'       	  : id_turno,
        			'id_formulario'       : id_formulario,
        			'FechaInicial'        : FechaInicial,
        			'FechaFinal'       	  : FechaFinal,
        			'id_maquina_oculta'   : id_maquina_oculta,
        			'_token'       	  	  : _token
        		},
        		success:function(respuesta){
        			if(respuesta==0){ 
        				$('#ModalConfirmar').modal('hide');
        				$('#Modal_Registro_Asignacion').modal('hide');       			
        				Cargar_Tabla();    
        				subir();   
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
        				$('#ModalConfirmar').modal('hide');
        				$('#id_validacion').html('');
        				$.each(respuesta.errors,function(index, error){ 
        					$('#estilo_mensaje').show();
        					$('#id_validacion').append('<p><strong>'+error+'</strong></p>');    
        					document.getElementById("id_validacion").style.display = "block";
        				}); 
        			}
        			if(respuesta==3){
        				$('#ModalConfirmar').modal('hide');
        				$('#id_validacion').html('');        				
        				$('#estilo_mensaje').show();
        				$('#id_validacion').append('<p><strong>Error: Se encontró una asignación ingresada con el mismo turno y formulario.</strong></p>');    
        				document.getElementById("id_validacion").style.display = "block";
        				$("#estilo_mensaje").fadeTo(5000, 500).slideUp(500, function(){
        					$("#estilo_mensaje").hide();
        				});
        			}
        		}
        	});
        });

        function LimpiarFormulario(){	
        	$('#FechaInicial').datepicker('setDate', null);
        	$('#FechaFinal').datepicker('setDate', null);			
        	$('#id_nombre_usuario').val('').selectpicker('refresh');
        	$('#id_turno').val('').selectpicker('refresh');
        	$('#id_formulario').val('').selectpicker('refresh');
        }

        function subir() {
        	$("html, body").animate({ scrollTop: 0 }, "slow");
        	return false;
        }

        // function Modificar(){
        // 	if(Validar_Asignacion()!==true){        		  		
        // 		$('#Modal_Confirmar_Editar_Asignacion').modal('show');
        // 	}
        // }

        $('.ModificarAsignacion').click(function(){
        	var id_nombre_usuario_editar = $('#id_nombre_usuario_editar').find('option:selected').val();        
        	var id_turno_editar= document.getElementById("id_turno_editar").value;
        	var id_formulario_editar= document.getElementById("id_formulario_editar").value;

        	var id_nombre_usuario_editar_oculto=$('#id_nombre_usuario_editar_oculto').val();
        	var id_turno_editar_oculto=$('#id_turno_editar_oculto').val();
        	var id_formulario_editar_oculto=$('#id_formulario_editar_oculto').val();

        	var Fecha_Inicial_editar=$('#Fecha_Inicial_editar').val();
        	var Fecha_Final_editar=$('#Fecha_Final_editar').val();
        	var id_oculto_editar=$('#id_oculto_editar').val();

        	var id_maquina_oculta_editar= $('#id_maquina_oculta_editar').val();	
        	
        	$.ajax({
        		url   : "<?= URL::to('ModificarAsignacion') ?>",
        		type  : "GET",
        		async : false,
        		data  :{
        			'id_nombre_usuario_editar'   		: id_nombre_usuario_editar,
        			'id_turno_editar'       	 		: id_turno_editar,
        			'id_formulario_editar'       		: id_formulario_editar,
        			'id_nombre_usuario_editar_oculto'   : id_nombre_usuario_editar_oculto,
        			'id_turno_editar_oculto'       	 	: id_turno_editar_oculto,
        			'id_formulario_editar_oculto'       : id_formulario_editar_oculto,
        			'Fecha_Inicial_editar'       		: Fecha_Inicial_editar,
        			'Fecha_Final_editar'       	 		: Fecha_Final_editar,
        			'id_oculto_editar'       	 		: id_oculto_editar,
        			'id_maquina_oculta_editar'       	: id_maquina_oculta_editar        			      			
        		},
        		success:function(respuesta){
        			if(respuesta==0){ 
        				Cargar_Tabla();    
        				subir();   
        				$('#success-alerta3').show();       
        				$(document).ready (function(){  
        					$('#Modal_Confirmar_Editar_Asignacion').modal('hide');
        					$('#Modal_Editar_Asignacion').modal('hide');
        					$("#success-alerta3").hide(); 
        					$("#success-alerta3").alert();     
        					$("#success-alerta3").fadeTo(4500, 500).slideUp(500, function(){
        						$("#success-alerta3").hide();
        					});  
        				});
        				LimpiarFormulario();        				
        				Cargar_Usuarios(); 
        			}
        			if(respuesta==1){ 
        				$('#Modal_Confirmar_Editar_Asignacion').modal('hide');
        				$('#id_validacion3').html('');        				
        				$('#estilo_mensaje3').show();
        				$('#id_validacion3').append('<p><strong>No se encontró cambios a modificar.</strong></p>');    
        				document.getElementById("id_validacion3").style.display = "block";
        			}
        			if(respuesta.error==false){ 
        				$('#Modal_Confirmar_Editar_Asignacion').modal('hide');
        				$('#id_validacion3').html('');
        				$.each(respuesta.errors,function(index, error){ 
        					$('#estilo_mensaje3').show();
        					$('#id_validacion3').append('<p><strong>'+error+'</strong></p>');    
        					document.getElementById("id_validacion3").style.display = "block";
        				}); 
        			}

        			if(respuesta==3){
        				$('#Modal_Confirmar_Editar_Asignacion').modal('hide');
        				$('#id_validacion3').html('');        				
        				$('#estilo_mensaje3').show();
        				$('#id_validacion3').append('<p><strong>Error: Se encontró una asignación ingresada con el mismo turno y formulario.</strong></p>');    
        				document.getElementById("id_validacion3").style.display = "block";
        				$("#estilo_mensaje3").fadeTo(5000, 500).slideUp(500, function(){
        					$("#estilo_mensaje3").hide();
        				});
        			}

        		}
        	});
        });


    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>