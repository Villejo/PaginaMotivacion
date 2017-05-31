<?php $__env->startSection('title'); ?>
Menú Principal
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


<div class="alert alert-success" style="display: none;" id="success-eliminar">	
	<h3><span class="fa fa-thumbs-up fa-2x"></span>
		<strong>Se elimino con éxito el registro del equipo..!!</strong>				
	</h3>					
</div>
<div class="alert alert-success" style="display: none;" id="success-alerta1">	
	<h3><span class="fa fa-thumbs-up fa-2x"></span>
		<strong>Se registro con éxito el nuevo equipo..!!</strong>				
	</h3>					
</div>
<div class="alert alert-success" style="display: none;" id="success-alerta_editar">	
	<h3><span class="fa fa-thumbs-up fa-2x"></span>
		<strong>Se editó exitosamente el registro del equipo..!!</strong>				
	</h3>					
</div>
<div class="alert alert-danger" style="display: none;" id="success-alerta2">	
	<h3><span class="fa fa-thumbs-up fa-2x"></span>
		<strong>Se eliminó con éxito el equipo...!!</strong>				
	</h3>					
</div>
<div class="alert alert-info" style="display: none;" id="success-alerta3">	
	<h3><span class="fa fa-thumbs-up fa-2x"></span>
		<strong>Se modifico con éxito el equipo...!!</strong>				
	</h3>					
</div>
<div class="page-bar col-xs-12 col-sm-12 col-md-12 col-lg-12">	
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-phone-square" aria-hidden="true"></i>
			<a href="<?php echo e(route('Equipos')); ?>">Administrar Equipos</a>
			<i class="fa fa-angle-right"></i>
		</li>		
		<li>
			<i class="fa fa-wrench" aria-hidden="true"></i>
			<a href="<?php echo e(route('Parametros_Equipos_R')); ?>">Parametros</a>

			<i class="fa fa-angle-right"></i>
		</li>				
	</ul>			
</div>
<br><br><br>
<div class="panel panel-primary">
	<div class="panel-heading"></div>
	<div class="panel-body">	
		<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-4" id="Panel_1">
				<div class="panel panel-danger">
					<div class="panel-heading">				
						<h3 class="panel-title"><b><strong>SELECTOR DE EQUIPOS</strong></b></h3>	
					</div>					
					<div class="panel-body" id="id_panel_seleccionar_equipo" name="id_panel_seleccionar_equipo" >			
						<div class="form-group " >
							<input  type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" id="_token">
							<font size ="2", color ="#000000"><?php echo e(Form::label("Seleccione un equipo:")); ?></font>
							<select  class="form-control selectpicker id_select_Equipo" data-live-search="true" id="id_select_Equipo"  name="id_select_Equipo" class="" style="float:left;"  onchange="Mostrar_tabla();  ocultarImagen();  " >
								<option></option>
							</select>

							<p></p>

							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-8 col-lg-4"   id="Panel_4">

									<button type="button" class="btn btn-success RegistrarIngresoEquipos" 
									id="BtnNuevoEquipo" title="Ingresar registro de equipos" style="display: block;" >
									<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Nuevo</span></font></strong>
									<span class="fa fa-plus-square"></span></button>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div class="panel panel-success">
					<div class="panel-heading"></div>
					<div class="panel-body">	
						<div id="Imagen_Inicial" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="display: block;">
							<center>
								<img src="global/images/no_equipo_seleccionado.png" alt="logo" class="img-thumbnail img-responsive">
							</center>
						</div>
						<div id="tabla_Equipo_id" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="display: none">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Registro Equipos-->
<div class="modal fade"  name="Modal_Registro_Equipos" id="Modal_Registro_Equipos"  tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#007835" face="Arial Black">
						<i class="fa fa-file-o fa-2x" aria-hidden="true"></i> NUEVO EQUIPO</font></strong>						
					</b>
					<div class="alert alert-danger" style="display: none;" id="repetido">	
						<h3><span  ></span>
							<strong> ya existe un registro con ese nombre o idendificador...!!</strong>				
						</h3>					
					</div>
				</h4>
			</div>

			<div class="modal-body" id="body_modal_registro_equipos" name="body_modal_registro_equipos">
				<form id="form_modal" name="form_modal">
					<table class="table table-user-information">
						<div class="row">						
							<tbody>	
								<div class="panel panel-danger" style="display:none" id="estilo_mensaje">
									<div class="panel-heading" id="id_validacion" style="display:none">
									</div>
								</div>

								<tr>

									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">Nombre Equipo:</font></strong></b>
									</td>
									<td>
										<input type="text" name="nombre_equipo" id="nombre_equipo" class="form-control">
									</td>
								</tr>	
								<tr>
									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">identificador:</font></strong></b>
									</td>
									<td>
										<input type="text" name="identificador" id="identificador" class="form-control">
									</td>
								</tr>	
								<tr>
									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">Ubicación:</font></strong></b>
									</td>
									<td>
										<input type="text" name="ubicacion" id="ubicacion" class="form-control">
									</td>
								</tr>	
								<tr>
									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">Descripción:</font></strong></b>
									</td>
									<td>
										<input type="text" name="descripcion" id="descripcion" class="form-control">
									</td>
								</tr>	
								<tr>
									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">Marca:</font></strong></b>
									</td>
									<td>
										<input type="text" name="marca" id="marca" class="form-control">
									</td>
								</tr>	
								<tr>
									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">Estado del Equipo:</font></strong></b>
									</td>
									<td>
										<input type="text" name="estado_equipo" id="estado_equipo" class="form-control">
									</td>
								</tr>

								<tr>
									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">Fecha de registro:</font></strong></b>
									</td>

									<td>								
										<div class="form-group">				
											<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
												<input type="text" class="form-control form-filter input-sm" name="Fecha_Registro" id="Fecha_Registro"   placeholder="Fecha Inicial" value="<?php echo e(Carbon::today()->toDateString()); ?>" readonly>
												<span class="input-group-btn">
													<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
										</div>
									</td>
								</tr>														
							</tbody>

							<div class="panel panel-danger" style="display:none" id="estilo_mensaje3">
								<div class="panel-heading" id="id_validacion3" style="display:none">
								</div>
							</div>

						</div>
					</table>
				</form>
			</div>			
			<div class="modal-footer">
				<button type="button" onclick="Validar_Registro_Equipos();"  class="btn btn-circle" style="background-color: #007835" title="Registrar">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>REGISTRAR</span>
						<span class="fa fa-plus-square"></span>
					</font></strong>
				</button>
				<button type="button" class="btn btn-circle" data-dismiss="modal" style="background-color: #fc0019" title="Cancelar" >
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>CANCELAR</span>
						<span class="fa fa-times"></span>
					</font></strong>
				</button>
			</div>
		</div>
	</div>
</div>
<!-- Termina Modal Registro Equipos -->

<!--  Modal Confirmar Equipos -->
<div class="modal fade" id="ModalConfirmar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">					
				<h4 class="modal-title" id="myModalLabel">¿ Esta seguro de Crear el registro del equipo ?</h4>
				<input type="hidden" name="IdNotificacion" id="IdNoti" class="form-control">
			</div>					
			<div class="modal-footer">
				<button type="button" class="btn btn-primary BtnConfirmarRegistroEquipos">Crear</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>					
			</div>
		</div>
	</div>
</div>
<!-- Termina Modal Confirmar Equipos -->




<!-- Modal Editar Equipos -->

<div class="modal fade"  name="Modal_editar_Equipos" id="Modal_editar_Equipos"  tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#007835" face="Arial Black">
						<i class="fa fa-file-o fa-2x" aria-hidden="true"></i> EDITAR REGISTRO DEL EQUIPO</font></strong>						
					</b>
					<div class="alert alert-danger" style="display: none;" id="repetido">	
						<h3><span  ></span>
							<strong> ya existe un registro con ese nombre o idendificador...!!</strong>				
						</h3>					
					</div>
				</h4>
			</div>

			<div class="modal-body" id="body_modal_editar_equipos" name="body_modal_editar_equipos">

				<div class="panel panel-default" id="estilo_mensaje6" style="display: none;">
					<div class="panel-heading" id="id_validacion6" style="display: none;" >
					</div>
				</div>


				<div class="alert alert-danger" style="display: none;" id="nombre_repetido">	
					<h3><span  ></span>
						<strong> ya existe un registro con ese nombre de equipo...!!</strong>				
					</h3>					
				</div>
				<div class="alert alert-danger" style="display: none;" id="identificador_repetido">	
					<h3><span  ></span>
						<strong> ya existe un registro con ese  idendificador...!!</strong>				
					</h3>					
				</div>	
				<div class="alert alert-danger" style="display: none;" id="no_cambio">	
					<h3><span  ></span>
						<strong> No se encontraron cambios para el registro...!!</strong>				
					</h3>					
				</div>	
				<form id="form_modal" name="form_modal">
					<table class="table table-user-information">
						<div class="row">						
							<tbody>	
								<div class="panel panel-danger" style="display:none" id="estilo_mensaje4">
									<div class="panel-heading" id="id_validacion4" style="display:none">
									</div>
								</div>

								<tr>

									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">Nombre Equipo:</font></strong></b>
									</td>
									<td>
										<input type="text" name="nombre_equipo_editar" id="nombre_equipo_editar" class="form-control">
									</td>
								</tr>	
								<tr>
									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">identificador:</font></strong></b>
									</td>
									<td>
										<input type="text" name="identificador" id="identificador_editar" class="form-control">
									</td>
								</tr>	
								<tr>
									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">Ubicación:</font></strong></b>
									</td>
									<td>
										<input type="text" name="ubicacion" id="ubicacion_editar" class="form-control">
									</td>
								</tr>	
								<tr>
									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">Descripción:</font></strong></b>
									</td>
									<td>
										<input type="text" name="descripcion" id="descripcion_editar" class="form-control">
									</td>
								</tr>	
								<tr>
									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">Marca:</font></strong></b>
									</td>
									<td>
										<input type="text" name="marca" id="marca_editar" class="form-control">
									</td>
								</tr>	
								<tr>
									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">Estado del Equipo:</font></strong></b>
									</td>
									<td>
										<input type="text" name="estado_equipo" id="estado_equipo_editar" class="form-control">
									</td>
								</tr>

								<tr>
									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">Fecha de registro:</font></strong></b>
									</td>

									<td>								
										<div class="form-group">				
											<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
												<input type="text" class="form-control form-filter input-sm" name="fecha_registro_editar" id="Fecha_Registro_editar"   placeholder="Fecha Inicial" value="<?php echo e(Carbon::today()->toDateString()); ?>" readonly>
												<span class="input-group-btn">
													<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
										</div>
									</td>
								</tr>														
							</tbody>
							<input type="hidden" id="id_equipo_editar_oculto" name="id_equipo_editar_oculto" >

							<input type="hidden" id="nombre_antiguo" name="nombre_antiguo" >

							<input type="hidden" id="identificador_antigua" name="identificador_antigua" >

							<div class="panel panel-danger" style="display:none" id="estilo_mensaje3">
								<div class="panel-heading" id="id_validacion3" style="display:none">
								</div>
							</div>
						</div>
					</table>
				</form>
			</div>			
			<div class="modal-footer">
				<button type="button" id="btnConfirmarActualizarEquipos" name="btnConfirmarActualizarEquipos" "  class="btn btn-circle btnConfirmarActualizarEquipos" style="background-color: #007835" title="Actualizar" >
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>ACTUALIZAR</span>
						<span class="fa fa-plus-square"></span>
					</font></strong>
				</button>
				<button  id="btnCancelarActualizarEquipos" type="button" class="btn btn-circle" data-dismiss="modal" style="background-color: #fc0019" title="Cancelar">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>CANCELAR</span>
						<span class="fa fa-times"></span>
					</font></strong>
				</button>
			</div>
		</div>
	</div>
</div>
<!-- Termina Modal editar Equipos -->

<!--  Modal Confirmar Equipos -->
<div class="modal fade" id="ModalConfirmar_editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">					
				<h4 class="modal-title" id="myModalLabel">¿ Esta seguro de Editar el registro del equipo ?</h4>
				<input type="hidden" name="IdNotificacion" id="IdNoti" class="form-control">
			</div>	

			<div class="modal-footer">
				<button type="button" class="btn btn-primary BtnModificarEquipos">SI</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>					
			</div>
		</div>
	</div>
</div>
<!-- Termina Modal Confirmar Equipos -->



<!-- modal eliminar -->
<div class="modal fade" id="ModalConfirmar_eliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">					
				<h4 class="modal-title" id="myModalLabel">¿ Esta seguro de eliminar el registro del equipo ?</h4>
				<input type="hidden" name="IdRegistroEliminar" id="IdRegistroEliminar" class="form-control">
			</div>	

			<div class="modal-footer">
				<button type="button" title="Confirmacion de eliminacion del registro" class="btn btn-primary BtnEliminarEquipos">SI</button>
				<button type="button" title="cancelacion de eliminacion del registro" class="btn btn-default" data-dismiss="modal">NO</button>					
			</div>
		</div>
	</div>
</div>


<div class="alert alert-success" style="display: none;" id="success-eliminar">	
	<h3><span class="fa fa-thumbs-up fa-2x"></span>
		<strong>probando..!!</strong>				
	</h3>					
</div>

<!-- fin modal eliminar -->




<script type="text/javascript">

	function Mostrar_tabla(){
		var id_select_Equipo= document.getElementById("id_select_Equipo").value;
		if(id_select_Equipo!=0){
			$('#tabla_Equipo_id').show();
			Cargar_Tabla_equipos();
		}else{
			$('#tabla_Equipo_id').hide();
		}
	}


	function ocultarImagen(){


		var id_select_Equipo= document.getElementById("id_select_Equipo").value;
		if(id_select_Equipo==0){
			$('#Imagen_Inicial').show();
		}else{
			$('#Imagen_Inicial').hide();
		}
	}

</script>


<script type="text/javascript">



	Cargar_Nombres_Equipos();
// Llama el combox para los equipos
function Cargar_Nombres_Equipos(){	

	RemoverDataCombobox(document.getElementById("id_select_Equipo"));	

	$el =$('#id_select_Equipo');


	var _token=$('#_token').val();
	$.ajax({
		url   : "<?= URL::to('Listar_Nombres_Equipos') ?>",
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

			var options = $('id_select_Equipo option');
			var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
			arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
			options.each(function(i, o) {
				o.value = arr[i].v;
				$(o).text(arr[i].t);
			});					
		}

	});

}


function RemoverDataCombobox(selectbox)
{
	var i;
	for(i = selectbox.options.length - 1 ; i >= 1 ; i--)
	{
		selectbox.remove(i);
	}
}	



function Cargar_Tabla_equipos(){
	var _token=$('#_token').val();
	var id_select_Equipo= document.getElementById("id_select_Equipo").value;

	$.ajax({
		type:'POST',
		data: {
			'_token' : _token,
			'id_select_Equipo' : id_select_Equipo
		},
		url:'<?php echo e(url('Tabla_Equipos_R')); ?>',
		success: function(data){      
			$('#tabla_Equipo_id').empty().html(data);
		}
	});

	$(document).on("click",".pagination li a",function(e) {
		e.preventDefault();		
		var url = $(this).attr("href");
		$.ajax({
			type:'get',
			url:url,			
			success: function(data){
				$('#tabla_Equipo_id').empty().html(data);				
			}
		});
	});		
}





function Validar_Registro_Equipos(){
	var nombre_equipo= document.getElementById("nombre_equipo").value;
	var identificador= document.getElementById("identificador").value;
	var ubicacion= document.getElementById("ubicacion").value;
	var descripcion= document.getElementById("descripcion").value;
	var marca= document.getElementById("marca").value;
	// var id_tipo_equipo= document.getElementById("id_tipo_equipo").value;
	var estado_equipo= document.getElementById("estado_equipo").value;
	
	if(nombre_equipo==0){
		$('#estilo_mensaje').show();			
		$('#id_validacion').html('Debes ingresar el nombre del equipo.');
		$('#nombre_equipo').focus();	
		$('#id_validacion').show();			
		return true;
	} else if(identificador==0){
		$('#estilo_mensaje').show();				
		$('#id_validacion').html('Debes ingresar un identificador para el equipo.');				
		$('#id_validacion').show();
		$('#identificador').focus();
		return true;
	} else if(ubicacion==0){

		$('#estilo_mensaje').show();				
		$('#id_validacion').html('Debes ingresar el lugar de ubicacion del equipo.');		
		$('#id_validacion').show();	
		$('#ubicacion').focus();
		return true;
	} else if(descripcion==0){

		$('#estilo_mensaje').show();				
		$('#id_validacion').html('Debes ingresar una descripcion del equipo');
		$('#id_validacion').show();
		$('#descripcion').focus();
		return true;

	} else if(marca==0){

		$('#estilo_mensaje').show();				
		$('#id_validacion').html('Debes ingresar la marca del equipo');
		$('#id_validacion').show();
		$('#marca').focus();
		return true;

	} else if(estado_equipo==0){

		$('#estilo_mensaje').show();				
		$('#id_validacion').html('Debes regisrar el estado del equipo');
		$('#id_validacion').show();
		$('#estado_equipo').focus();
		return true;

	}else{

		$('#estilo_mensaje').hide();

		$('#ModalConfirmar').modal('show');
		return false;									
	}
}

function Validar_Editar_Equipos(){
	var nombre_equipo= document.getElementById("nombre_equipo_editar").value;
	var identificador= document.getElementById("identificador_editar").value;
	var ubicacion= document.getElementById("ubicacion_editar").value;
	var descripcion= document.getElementById("descripcion_editar").value;
	var marca= document.getElementById("marca_editar").value;
	// var id_tipo_equipo= document.getElementById("id_tipo_equipo").value;
	var estado_equipo= document.getElementById("estado_equipo_editar").value;
	
	if(nombre_equipo==0){
		$('#estilo_mensaje4').show();			
		$('#id_validacion4').html('Debes ingresar el nombre del equipo.');
		$('#nombre_equipo_editar').focus();	
		$('#id_validacion4').show();			
		return true;
	} else if(identificador==0){
		$('#estilo_mensaje4').show();				
		$('#id_validacion4').html('Debes ingresar un identificador para el equipo.');				
		$('#id_validacion4').show();
		$('#identificador_editar').focus();
		return true;
	} else if(ubicacion==0){

		$('#estilo_mensaje4').show();				
		$('#id_validacion4').html('Debes ingresar el lugar de ubicacion del equipo.');		
		$('#id_validacion4').show();	
		$('#ubicacion_editar').focus();
		return true;
	} else if(descripcion==0){

		$('#estilo_mensaje4').show();				
		$('#id_validacion4').html('Debes ingresar una descripcion del equipo');
		$('#id_validacion4').show();
		$('#descripcion_editar').focus();
		return true;

	} else if(marca==0){

		$('#estilo_mensaje4').show();				
		$('#id_validacion4').html('Debes ingresar la marca del equipo');
		$('#id_validacion4').show();
		$('#marca_editar').focus();
		return true;

	} else if(estado_equipo==0){

		$('#estilo_mensaje4').show();				
		$('#id_validacion4').html('Debes regisrar el estado del equipo');
		$('#id_validacion4').show();
		$('#estado_equipo_editar').focus();
		return true;	
	}else{
		$('#estilo_mensaje4').hide();
		$('#ModalConfirmar_editar').modal('show');
		return false;									
	}
}



$('body').delegate('.btnEditar_Equipo','click',function(){	
	$('#no_cambio').hide();	
	$('#identificador_repetido').hide();
	$('#nombre_repetido').hide();			
	var nombre_equipo =($(this).attr('nombre_equipo'));
	var identificador =($(this).attr('identificador'));
	var ubicacion =($(this).attr('ubicacion'));
	var descripcion =($(this).attr('descripcion'));
	var marca =($(this).attr('marca'));
	// var id_tipo_equipo =($(this).attr('id_tipo_equipo'));
	var estado_equipo =($(this).attr('estado_equipo'));
	var fecha_registro =($(this).attr('fecha_registro'));	

	var id_equipo_editar =($(this).attr('id_equipo_editar'));


	console.log('Identificador'+identificador);
	$('#nombre_antiguo').val(nombre_equipo);
	$('#identificador_antigua').val(identificador);


	$('#nombre_equipo_editar').val(nombre_equipo);
	$('#identificador_editar').val(identificador);
	$('#ubicacion_editar').val(ubicacion);
	$('#descripcion_editar').val(descripcion);
	$('#marca_editar').val(marca);	  
	$('#estado_equipo_editar').val(estado_equipo);

	$('#id_equipo_editar_oculto').val(id_equipo_editar);

	$('#Modal_editar_Equipos').modal('show');
});	



$('.BtnConfirmarRegistroEquipos').click(function(){
	
	var nombre_equipo= document.getElementById("nombre_equipo").value;
	var identificador= document.getElementById("identificador").value;
	var ubicacion= document.getElementById("ubicacion").value;
	var descripcion= document.getElementById("descripcion").value;
	var marca= document.getElementById("marca").value;
	// var id_tipo_equipo= document.getElementById("id_tipo_equipo").value;
	var estado_equipo= document.getElementById("estado_equipo").value;
	var estado_equipo= document.getElementById("estado_equipo").value;
	var Fecha_Registro= $('#Fecha_Registro').val();

	var _token=$('#_token').val();

	

	$.ajax({
		url   : "<?= URL::to('Registrar_equipos_R') ?>",
		type  : "POST",
		async : false,
		data  :{
			'nombre_equipo'    :  nombre_equipo,
			'identificador'       	   : identificador,
			'ubicacion'        : ubicacion,
			'descripcion'      : descripcion,
			'marca'       	   : marca,
			// 'id_tipo_equipo'   :id_tipo_equipo,
			'estado_equipo'    : estado_equipo,
			'Fecha_Registro'   :Fecha_Registro,
			'_token'       	   : _token

		},

		success:function(respuesta){

			if(respuesta.repetido == "si"){	
				// $('#repetido').show(); 
				$('#repetido').show();
				$('#ModalConfirmar').modal('hide');
				//$('#Modal_Registro_Equipos').modal('hide'); 
				

			}else{		
				if(respuesta.resultado==0){ 

				// Cargar_Tabla_ultimoEquipoRegistrado();
				$('#repetido').hide(); 
				$('#ModalConfirmar').modal('hide');
				$('#Modal_Registro_Equipos').modal('hide');       			
				// Cargar_Tabla();    
				//subir();   
				//$('#success-alerta1').show();       
				$(document).ready (function(){  
					$('#ModalConfirmar').modal('hide');
					$("#success-alerta1").hide(); 
					//$("#success-alerta1").alert();
					$("#success-alerta1").fadeTo(4500, 500).slideUp(500, function(){
					});

					RemoverDataCombobox(document.getElementById("id_select_Equipo"));
					Cargar_Nombres_Equipos();					
					// Cargar_Tabla_ultimoEquipoRegistrado();
					$('#id_select_Equipo').val('').selectpicker('refresh');					
					$('select[name=id_select_Equipo]').val(respuesta.ultimo_id);						
					$('select[name=id_select_Equipo]').change();
					Cargar_Tabla_equipos();
					
					$('#tabla_Equipo_id').show();

				});	
			}	
		}
	}
});
});



function subir() {
	$("html, body").animate({ scrollTop: 0 }, "slow");
	return false;
}

$('.RegistrarIngresoEquipos').click(function(){

	$('#tabla_Equipo_id').hide();  
	
	$('#id_select_Equipo').selectpicker('val', [0]); 
	document.getElementById("form_modal").reset();
	$('#Modal_Registro_Equipos').modal('show');

	

});





$('#btnCancelarActualizarEquipos').click(function(){	
	$('#estilo_mensaje').hide();
	
	$('#identificador_repetido').hide();
});

$('.btnConfirmarActualizarEquipos').click(function(){
	if(Validar_Editar_Equipos()!=true){
		$('#ModalConfirmar_editar').modal('show');
	}
});



$('.BtnModificarEquipos').click(function(){
	var id_equipo_editar= document.getElementById("id_equipo_editar_oculto").value;
	var _nombre_antiguo= document.getElementById("nombre_antiguo").value;
	var _identificador_antigua= document.getElementById("identificador_antigua").value;
	var nombre_equipo_editar= document.getElementById("nombre_equipo_editar").value;
	var identificador_editar= document.getElementById("identificador_editar").value;
	var ubicacion_editar= document.getElementById("ubicacion_editar").value;
	var descripcion_editar= document.getElementById("descripcion_editar").value;
	var marca_editar= document.getElementById("marca_editar").value;
	var estado_equipo_editar= document.getElementById("estado_equipo_editar").value;
	var Fecha_Registro_editar= $('#Fecha_Registro_editar').val();

	$.ajax({
		url   : "<?= URL::to('ConfirmarEdicionEquipos_R') ?>",
		type  : "GET",
		async : false,
		data  :{
			'id'               :  id_equipo_editar,
			'nombre_equipo'    :  nombre_equipo_editar,
			'identificador'       	   : identificador_editar,
			'ubicacion'        : ubicacion_editar,
			'descripcion'      : descripcion_editar,
			'marca'       	   : marca_editar,
			'estado_equipo'    : estado_equipo_editar,
			'Fecha_Registro'   :Fecha_Registro_editar,
			// '_token'       	   : _token
		},

		success:function(respuesta){
			// $uno=0;$dos=0;


			if(respuesta==2){
				$('#ModalConfirmar_editar').modal('hide');
				$('#no_cambio').show();
			}



			if(_nombre_antiguo!=nombre_equipo_editar){
				if(respuesta.cont_nombre >0){	
					$('#no_cambio').hide();
					$('#identificador_repetido').hide();
					$('#nombre_repetido').show();
					
					
					$('#ModalConfirmar_editar').modal('hide');
					$('#nombre_equipo_editar').focus();					
				}
			}

			

			if(_identificador_antigua!=identificador_editar){
				if(respuesta.cont_Ced >0){	
					$('#no_cambio').hide();
					$('#nombre_repetido').hide();
					$('#identificador_repetido').show();
					$('#ModalConfirmar_editar').modal('hide');
					$('#identificador_editar').focus();
					
				}
			}

// alert(respuesta.cont_Ced);
if(respuesta.cont_Ced ==0 && respuesta.cont_nombre==0){
	$('#identificador_repetido').hide();
	$('#ModalConfirmar_editar').modal('hide');
	$('#Modal_editar_Equipos').modal('hide');
	$("#success-alerta_editar").fadeTo(2500, 500).slideUp(500, function(){
	});
	RemoverDataCombobox(document.getElementById("id_select_Equipo"));
	Cargar_Nombres_Equipos();					
					// Cargar_Tabla_ultimoEquipoRegistrado();
					$('#id_select_Equipo').val('').selectpicker('refresh');					
					$('select[name=id_select_Equipo]').val(id_equipo_editar);						
					$('select[name=id_select_Equipo]').change();
					Cargar_Tabla_equipos();

					$('#tabla_Equipo_id').show();


				}


			}


		});
});



$('body').delegate('.Eliminar_Equipo','click',function(){	
	var id_equipo_eliminar =($(this).attr('id_Eliminar_Equipo'));
	
	$('#IdRegistroEliminar').val(id_equipo_eliminar);
	$('#ModalConfirmar_eliminar').modal('show');


});

$('.BtnEliminarEquipos').click(function(){
	var id_equipo_eliminar =$('#IdRegistroEliminar').val();

	$.ajax({
		url   : "<?= URL::to('Eliminar_Equipo_R') ?>",
		type  : "GET",
		async : false,
		data  :{		
			'id_equipo_eliminar'    :  id_equipo_eliminar			
		},
		success:function(respuesta){

			$('#ModalConfirmar_eliminar').modal('hide');
			$("#success-eliminar").fadeTo(4500, 500).slideUp(500, function(){

			});	
			subir();
			
			setTimeout (" location.reload();", 3000); 
			
		}
	});
});

function recargar_pagina(){
	location.reload();
}

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>