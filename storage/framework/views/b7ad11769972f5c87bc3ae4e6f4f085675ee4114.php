<?php $__env->startSection('title'); ?>
Menú Principal
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
		</li>				
	</ul>			
</div>
<br><br><br>
<div class="panel panel-primary">
	<div class="panel-heading"></div>
	<div class="panel-body">
		<div class="row">
			<div class="panel panel-info EfectoPulso col-xs-12 col-sm-12 col-md-4 col-lg-4" id="EfectoPulso">		 
				<div class="panel-body">		
					<label id="DatoSeleccionado">	
					</label>		
				</div>
			</div>	
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">	
				<div class="panel panel-default">
					<div class="panel-heading">				
						<h3 class="panel-title">
							<b>
								<strong>
									PANEL DE VARIABLES
								</strong>
							</b>
						</h3>	
					</div>					
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">										
								<select  class="form-control selectpicker id_parametro_seleccionado" data-live-search="true" id="id_parametro_seleccionado"  name="id_parametro_seleccionado" onchange="Cambio_Estado_Botones();" >
									<option></option>
								</select>
							</div>
						</div>
						<br>		
						<div class="row">
							<div class="col-lg-12">
								<center>
									<button type="button" class="btn CargarModalNuevaVariable" id="btn_nueva_variable" style="background: #124f0b">
										<strong>
											<font size ="2", color ="#ffffff" face="Lucida Sans">
												<span>Nuevo</span>
											</font>
										</strong>
										<font size ="2", color ="#ffffff">
											<span class="fa fa-plus-square"></span>
										</font>
									</button>
									<button type="button" class="btn " id="btn_modificar_variable" style="background: #0f354f">
										<strong>
											<font size ="2", color ="#ffffff" face="Lucida Sans">
												<span>Modificar</span>
											</font>
										</strong>
										<font size ="2", color ="#ffffff">
											<span class="fa fa-pencil-square-o"></span>
										</font>
									</button>
									<button type="button" class="btn" id="btn_eliminar_variable" style="background: #441207">
										<strong>
											<font size ="2", color ="#ffffff" face="Lucida Sans">
												<span>Eliminar</span>
											</font>
										</strong>
										<font size ="2", color ="#ffffff">
											<span class="fa fa-trash"></span>
										</font>
									</button>
								</center>
							</div>					
						</div>
					</div>
				</div>	
			</div>
		</div>
		<div class="row">			
			<div class="panel panel-default col-xs-12 col-sm-12 col-md-4 col-lg-4" id="Estilo_Mensaje_Principal">
				<div class="panel-heading" id="ID_Validacion_Mensaje_Principal" style="display: none;" >
				</div>
			</div>			
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">	
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							<b>
								<strong>
									PANEL DE UNIDADES
								</strong>
							</b>
						</h3>	
					</div>					
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">										
								<select  class="form-control selectpicker id_select_unidad" data-live-search="true" id="id_select_unidad"  name="id_select_unidad" onchange="Habilitar_Botones_Unidad();" >
									<option></option>
								</select>
							</div>
						</div>
						<br>		
						<div class="row">
							<div class="col-lg-12">
								<center>
									<button type="button" class="btn" id="btn_nueva_unidad" style="background: #124f0b">
										<strong>
											<font size ="2", color ="#ffffff" face="Lucida Sans">
												<span>Nuevo</span>
											</font>
										</strong>
										<font size ="2", color ="#ffffff">
											<span class="fa fa-plus-square"></span>
										</font>
									</button>
									<button type="button" class="btn" id="btn_modificar_unidad" style="background: #0f354f">
										<strong>
											<font size ="2", color ="#ffffff" face="Lucida Sans">
												<span>Modificar</span>
											</font>
										</strong>
										<font size ="2", color ="#ffffff">
											<span class="fa fa-pencil-square-o"></span>
										</font>
									</button>
									<button type="button" class="btn" id="btn_eliminar_unidad" style="background: #441207">
										<strong>
											<font size ="2", color ="#ffffff" face="Lucida Sans">
												<span>Eliminar</span>
											</font>
										</strong>
										<font size ="2", color ="#ffffff">
											<span class="fa fa-trash"></span>
										</font>
									</button>
								</center>
							</div>					
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>
<!-- Modal Nueva Variable-->
<div class="modal fade" id="Modal_Registro_Variable" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#007835" face="Arial Black">
						<i class="fa fa-file-o fa-2x" aria-hidden="true"></i> NUEVA VARIABLE</font></strong>						
					</b>
				</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-danger" style="display:none" id="Estilo_Validacion_Nueva_Variable">
					<div class="panel-heading" id="ID_Validacion_Nueva_Variable" style="display:none">
					</div>
				</div>
				<input type="text" class="form-control btn-circle" name="Nueva_Variable" id="Nueva_Variable" placeholder="INGRESA UNA NUEVA VARIABLE"  style="text-align: center">
			</div>					
			<div class="modal-footer">
				<button type="button" onclick="RegistrarVariable();"  class="btn btn-circle" style="background-color: #007835" title="Registrar">
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
<!-- Termina Modal Nueva Variable -->
<!-- Modal para confirmaciones Registrar Variable -->
<div class="modal fade" id="Confirmar_Modal_Nueva_Variable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">¿ ESTA SEGURO DE REGISTRAR LA NUEVA VARIABLE?</h4>
			</div>
			<div class="modal-footer">
				<button  class="btn btn-primary RegistrarNuevaVariable" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina modal para confirmaciones Registrar Variable -->
<!-- Modal Modificar Variable-->
<div class="modal fade" id="Modal_Actualizar_Variable" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#007835" face="Arial Black">
						<i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i> ACTUALIZAR VARIABLE</font></strong>						
					</b>
				</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-danger" style="display:none" id="Estilo_Mensaje_Editar_Variable">
					<div class="panel-heading" id="ID_Validacion_Editar_Variable" style="display:none">
					</div>
				</div>
				<input type="hidden" name="id_variable_actualizar" id="id_variable_actualizar">
				<input type="hidden" name="NombreVariableEditar_Oculto" id="NombreVariableEditar_Oculto">
				<input type="text" class="form-control btn-circle" name="Actualizar_Variable" id="Actualizar_Variable" placeholder="INGRESA UNA NUEVA VARIABLE"  style="text-align: center">
			</div>					
			<div class="modal-footer">
				<button type="button" onclick="ModificarVariable();"  class="btn btn-circle" style="background-color: #007835" title="Registrar">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>ACTUALIZAR</span>
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
<!-- Termina Modal Modificar Variable -->
<!-- Modal para confirmaciones Editar Variable -->
<div class="modal fade" id="Confirmar_Modal_Actualizar_Variable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i> ¿ ESTA SEGURO DE ACTUALIZAR LA VARIABLE ?</h4>
			</div>
			<div class="modal-footer">
				<button  class="btn btn-primary ActualizarVariable" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina modal para confirmaciones Editar Variable -->

<!-- Modal para confirmaciones Eliminar Variable -->
<div class="modal fade" id="Confirmar_Modal_Eliminar_Variable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash fa-2x" aria-hidden="true"></i> ¿ ESTA SEGURO DE ELIMINAR LA VARIABLE ?</h4>
				<br><br><br>
				<label id="NombreVariableEliminar"></label>
				<input type="hidden" name="id_variable_eliminar" id="id_variable_eliminar">
			</div>
			<div class="modal-footer">
				<button  class="btn btn-primary EliminarVariable" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina modal para confirmaciones ELIMINAR Variable -->

<!-- Modal Nueva UNIDAD-->
<div class="modal fade" id="Modal_Registro_Unidad" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#007835" face="Arial Black">
						<i class="fa fa-file-o fa-2x" aria-hidden="true"></i> NUEVA UNIDAD</font></strong>						
					</b>
				</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-danger" style="display:none" id="Estilo_Validacion_Nueva_Unidad">
					<div class="panel-heading" id="ID_Validacion_Nueva_Unidad" style="display:none">
					</div>
				</div>
				<input type="text" class="form-control btn-circle" name="Nueva_Unidad" id="Nueva_Unidad" placeholder="INGRESA UNA NUEVA UNIDAD"  style="text-align: center">
			</div>					
			<div class="modal-footer">
				<button type="button" onclick="RegistrarUnidad();"  class="btn btn-circle" style="background-color: #007835" title="Registrar">
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
<!-- Termina Modal Nueva UNIDAD-->
<!-- Modal para confirmaciones Registrar UNIDAD-->
<div class="modal fade" id="Confirmar_Modal_Nueva_Unidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-o fa-2x" aria-hidden="true"></i> ¿ ESTA SEGURO DE REGISTRAR LA NUEVA UNIDAD ?</h4>
			</div>
			<div class="modal-footer">
				<button  class="btn btn-primary RegistrarNuevaUnidad" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina modal para confirmaciones Registrar UNIDAD -->
<!-- Modal Modificar Variable-->
<div class="modal fade" id="Modal_Actualizar_Unidad" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#007835" face="Arial Black">
						<i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i> ACTUALIZAR UNIDAD</font></strong>						
					</b>
				</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-danger" style="display:none" id="Estilo_Mensaje_Editar_Unidad">
					<div class="panel-heading" id="ID_Validacion_Editar_Unidad" style="display:none">
					</div>
				</div>
				<input type="hidden" name="id_unidad_actualizar" id="id_unidad_actualizar">
				<input type="hidden" name="NombreUnidadEditar_Oculto" id="NombreUnidadEditar_Oculto">
				<input type="text" class="form-control btn-circle" name="Actualizar_Unidad" id="Actualizar_Unidad" placeholder="INGRESA UNA NUEVA UNIDAD"  style="text-align: center">
			</div>					
			<div class="modal-footer">
				<button type="button" onclick="ModificarUnidad();"  class="btn btn-circle" style="background-color: #007835" title="Registrar">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>ACTUALIZAR</span>
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
<!-- Termina Modal Modificar Unidad -->
<!-- Modal para confirmaciones Editar Unidad -->
<div class="modal fade" id="Confirmar_Modal_Actualizar_Unidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i> ¿ ESTA SEGURO DE ACTUALIZAR LA UNIDAD ?</h4>
			</div>
			<div class="modal-footer">
				<button  class="btn btn-primary ActualizarUnidad" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina modal para confirmaciones Editar Unidad -->
<!-- Modal para confirmaciones Eliminar Unidad -->
<div class="modal fade" id="Confirmar_Modal_Eliminar_Unidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash fa-2x" aria-hidden="true"></i> ¿ ESTA SEGURO DE ELIMINAR LA UNIDAD ?</h4>
				<br><br><br>
				<label id="NombreUnidadEliminar"></label>
				<input type="hidden" name="id_unidad_eliminar" id="id_unidad_eliminar">
			</div>
			<div class="modal-footer">
				<button  class="btn btn-primary EliminarUnidad" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina modal para confirmaciones ELIMINAR Unidad -->


<script src="global/scripts/Pulso.js"></script>

<script type="text/javascript">


	CargarMensaje();
	function CargarMensaje(){
		$('#DatoSeleccionado').html("<center><strong><font size ='3', color='#ff0019', face='Tahoma'>¡¡ No has seleccionado ninguna variable !!</font></strong></center>");
		$("#EfectoPulso").pulsate({color:"#ee000c"});	
	}

	Cargar_Parametros();
	function Cargar_Parametros(){
		$el =$('#id_parametro_seleccionado');	

		$.ajax({
			url   : "<?= URL::to('Listar_Parametros_Vista_Parametros') ?>",
			type  : "GET",
			async : false,			
			success:function(re){
				var option = $('<option />');
				$.each(re, function(key,value) {
					$el.append($("<option></option>")
						.attr("value", key).text(value));
				});							

				var options = $('.id_parametro_seleccionado option');
				var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});
			}
		});
	}
	function Cargar_Unidades(){
		$el =$('#id_select_unidad');
		var id_parametro_seleccionado= document.getElementById("id_parametro_seleccionado").value;	
		var NombreVariable =$("#id_parametro_seleccionado option:selected").text();

		$.ajax({
			url   : "<?= URL::to('Listar_Unidad_Vista_Parametros') ?>",
			type  : "GET",
			async : false,
			data:{
				'id_parametro_seleccionado' : id_parametro_seleccionado,
				'NombreVariable' 			: NombreVariable				
			},		
			success:function(resultado){
				var option = $('<option />');
				$.each(resultado, function(key,value) {
					$el.append($("<option></option>")
						.attr("value", key).text(value));
				});							

				var options = $('.id_select_unidad option');
				var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});
			}
		});
	}
	Cambio_Estado_Botones();

	function Cambio_Estado_Botones(){
		var id_parametro_seleccionado= document.getElementById("id_parametro_seleccionado").value;
		var NombreVariable =$("#id_parametro_seleccionado option:selected").text();
		if(id_parametro_seleccionado==0){
			document.getElementById('btn_nueva_variable').disabled=false;
			document.getElementById('btn_modificar_variable').disabled=true;			
			document.getElementById('btn_eliminar_variable').disabled=true;
			document.getElementById('id_select_unidad').disabled=true;	
			document.getElementById('btn_nueva_unidad').disabled=true;
			document.getElementById('btn_modificar_unidad').disabled=true;	
			document.getElementById('btn_eliminar_unidad').disabled=true;			
			window.setTimeout(function(){$('#id_select_unidad').val('').selectpicker('refresh');},100);	
			CargarMensaje();
			$.getScript('global/scripts/Pulso.js', function( data, textStatus, jqxhr ) {
				// $('.EfectoPulso').pulsate('destroy');
				$("#EfectoPulso").pulsate({color:"#ee000c"});
			});					
		}else{
			RemoverDataCombobox(document.getElementById("id_select_unidad"));
			Cargar_Unidades();			
			document.getElementById('btn_nueva_variable').disabled=true;
			document.getElementById('btn_modificar_variable').disabled=false;
			document.getElementById('btn_eliminar_variable').disabled=false;
			document.getElementById('id_select_unidad').disabled=false;	
			document.getElementById('btn_nueva_unidad').disabled=false;			
			$('#id_select_unidad').val('').selectpicker('refresh');				
			$('#DatoSeleccionado').html("Has seleccionado la Variable: <br><strong><font size ='5', color='#0a91cc', face='Tahoma'> <i class='fa fa-check' aria-hidden='true'></i> "+ NombreVariable +"</font></strong>");	
			$('#DatoSeleccionado').css("fontSize", 20);						
			$('#DatoSeleccionado').css("font-weight","Bold");
			
			$.getScript('global/scripts/Pulso.js', function( data, textStatus, jqxhr ) {
				// $('.EfectoPulso').pulsate('destroy');
				$(".EfectoPulso").pulsate({color:"#19cc06"});
			});		

		}		
	}

// Pra cargar un script Nuevo despues de cargar la pagina
// $( '#ButtonPrueba' ).on( 'click', function() {
	// 	$.getScript( 'global/scripts/Pulso.js', function( data, textStatus, jqxhr ) {

	// 		$('.EfectoPulso').pulsate('destroy');
	// 		$(".EfectoPulso").pulsate({color:"#19cc06"});
	// 	} );
	// } );

	

	function Habilitar_Botones_Unidad(){
		var id_select_unidad= document.getElementById("id_select_unidad").value;
		var NombreVariable =$("#id_parametro_seleccionado option:selected").text();
		var NombreUnidad =$("#id_select_unidad option:selected").text();

		if(id_select_unidad!=0){
			document.getElementById('btn_modificar_unidad').disabled=false;	
			document.getElementById('btn_eliminar_unidad').disabled=false;
			document.getElementById('btn_nueva_unidad').disabled=true;
			$('#DatoSeleccionado').html("Has seleccionado la Variable <br><strong><font size ='5', color='#0a91cc', face='Tahoma'> <i class='fa fa-check' aria-hidden='true'></i> "+ NombreVariable +"</font></strong><br><br> Has seleccionado la Unidad: <br><strong><font size ='5', color='#0a91cc', face='Tahoma'> <i class='fa fa-check' aria-hidden='true'></i> "+ NombreUnidad +"</font></strong>");
			$('#DatoSeleccionado').css("fontSize", 20);						
			$('#DatoSeleccionado').css("font-weight","Bold");				
		}else{
			document.getElementById('btn_modificar_unidad').disabled=true;	
			document.getElementById('btn_eliminar_unidad').disabled=true;
			document.getElementById('btn_nueva_unidad').disabled=false;		
			$('#id_select_unidad').val('').selectpicker('refresh');
			$('#DatoSeleccionado').html("Has seleccionado la Variable: <br><strong><font size ='5', color='#0a91cc', face='Tahoma'> <i class='fa fa-check' aria-hidden='true'></i> "+ NombreVariable +"</font></strong>");	
		}
	}

	function RemoverDataCombobox(selectbox){
		var i;
		for(i = selectbox.options.length - 1 ; i >= 1 ; i--)
		{
			selectbox.remove(i);
		}
	}
	$('.CargarModalNuevaVariable').click(function(){
		$('#Nueva_Variable').val('');
		$('#Actualizar_Variable').val('');
		$('#Nueva_Unidad').val('');	
		$('#Modal_Registro_Variable').modal('show');
	});

	function RegistrarVariable(){
		var Nueva_Variable=$('#Nueva_Variable').val();
		var patron =/[a-z,A-Z]/;

		if(!patron.test(Nueva_Variable)){
			$("#Estilo_Validacion_Nueva_Variable").attr("class", "panel panel-danger");
			$("#ID_Validacion_Nueva_Variable").css("fontSize", 15);						
			$("#ID_Validacion_Nueva_Variable").css("font-weight","Bold"); 	
			$('#Estilo_Validacion_Nueva_Variable').show();			
			$('#ID_Validacion_Nueva_Variable').html('<center> El campo no puede estar vacio.</center>');	
			$('#ID_Validacion_Nueva_Variable').show();
			document.getElementById("Nueva_Variable").focus();

		}else{
			if(Nueva_Variable==""){
				$("#Estilo_Validacion_Nueva_Variable").attr("class", "panel panel-danger");
				$("#ID_Validacion_Nueva_Variable").css("fontSize", 15);						
				$("#ID_Validacion_Nueva_Variable").css("font-weight","Bold"); 	
				$('#Estilo_Validacion_Nueva_Variable').show();			
				$('#ID_Validacion_Nueva_Variable').html('<center> El campo no puede estar vacio.</center>');	
				$('#ID_Validacion_Nueva_Variable').show();
				document.getElementById("Nueva_Variable").focus();
			}else{
				$('#Confirmar_Modal_Nueva_Variable').modal('show');
				$('#Estilo_Validacion_Nueva_Variable').hide();
				$('#ID_Validacion_Nueva_Variable').hide();
				return false;
			}
		}
		$("#Estilo_Validacion_Nueva_Variable").fadeTo(4500, 500).slideUp(500, function(){
			$("#Estilo_Validacion_Nueva_Variable").hide();
		}); 
	}

	$('.RegistrarNuevaVariable').click(function(){
		var Nueva_Variable=$('#Nueva_Variable').val();		
		Nueva_Variable = Nueva_Variable.toLowerCase();

		$.ajax({
			url   : "<?= URL::to('Registrar_Nueva_Variable') ?>",
			type  : "GET",
			async : false,
			data:{
				'Nueva_Variable' : Nueva_Variable
			},		
			success:function(respuesta){
				if(respuesta==0){
					$('#Confirmar_Modal_Nueva_Variable').modal('hide');
					$('#Modal_Registro_Variable').modal('hide');					
					$("#ID_Validacion_Mensaje_Principal").css("fontSize", 15);				
					// $("#ID_Validacion_Mensaje_Principal").css("font-weight","Bold"); 	
					$("#Estilo_Mensaje_Principal").attr("class", "panel panel-success col-xs-12 col-sm-12 col-md-4 col-lg-4");
					$('#Estilo_Mensaje_Principal').show();		
					$('#ID_Validacion_Mensaje_Principal').html('<center><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Se ha <strong>Registrado</strong> correctamente la variable.</center>');	
					$('#ID_Validacion_Mensaje_Principal').show();
					RemoverDataCombobox(document.getElementById("id_parametro_seleccionado"));			
					Cargar_Parametros();
					RemoverDataCombobox(document.getElementById("id_select_unidad"));
					Cargar_Unidades();
					$('#Nueva_Variable').val('');
					$('#id_parametro_seleccionado').val('').selectpicker('refresh');
					$('#id_select_unidad').val('').selectpicker('refresh');
					$("#ID_Validacion_Mensaje_Principal").fadeTo(5000, 500).slideUp(500, function(){
						$("#ID_Validacion_Mensaje_Principal").css("display", "none");		
					}); 
				}
				if(respuesta==2){					
					$('#Confirmar_Modal_Nueva_Variable').modal('hide');
					$('#ID_Validacion_Nueva_Variable').html('');					
					$('#Estilo_Validacion_Nueva_Variable').show();
					$("#Estilo_Validacion_Nueva_Variable").attr("class", "panel panel-danger");				
					$("#ID_Validacion_Nueva_Variable").css("fontSize", 15);				
					// $("#ID_Validacion_Nueva_Variable").css("font-weight","Bold");		
					$('#ID_Validacion_Nueva_Variable').html('<strong>ERROR: Se ha encontrado un registro parecido. Por favor Ingresa otro nombre.</strong>');
					$('#ID_Validacion_Nueva_Variable').show();	
					$("#ID_Validacion_Nueva_Variable").fadeTo(5000, 500).slideUp(500, function(){
						$("#ID_Validacion_Nueva_Variable").css("display", "none");			
					});				
				}
				if(respuesta.error==false){					
					$('#Confirmar_Modal_Nueva_Variable').modal('hide');
					$('#ID_Validacion_Nueva_Variable').html('');
					$.each(respuesta.errors,function(index, error){ 
						$('#Estilo_Validacion_Nueva_Variable').show();
						$("#ID_Validacion_Nueva_Variable").css("fontSize", 15);				
						// $("#ID_Validacion_Nueva_Variable").css("font-weight","Bold");	
						$('#ID_Validacion_Nueva_Variable').html('<strong>ERROR:</strong>'+error);
						$('#id_validacion').show();
					}); 
				}				
			}
		});
	});

	$('#btn_modificar_variable').click(function(){
		var id_parametro_seleccionado= document.getElementById("id_parametro_seleccionado").value;		
		var NombreVariable =$("#id_parametro_seleccionado option:selected").text();

		$('#id_variable_actualizar').val(id_parametro_seleccionado);
		$('#Actualizar_Variable').val(NombreVariable);
		$('#NombreVariableEditar_Oculto').val(NombreVariable);			
		$('#Modal_Actualizar_Variable').modal('show');		
	});

	function ModificarVariable(){
		var Actualizar_Variable=$('#Actualizar_Variable').val();
		var patron =/[a-z,A-Z]/;

		if(!patron.test(Actualizar_Variable)){
			$("#Estilo_Mensaje_Editar_Variable").attr("class", "panel panel-danger");
			$("#ID_Validacion_Editar_Variable").css("fontSize", 15);						
			$("#ID_Validacion_Editar_Variable").css("font-weight","Bold"); 	
			$('#Estilo_Mensaje_Editar_Variable').show();			
			$('#ID_Validacion_Editar_Variable').html('<center> El campo no puede estar vacio.</center>');	
			$('#ID_Validacion_Editar_Variable').show();
			document.getElementById("Actualizar_Variable").focus();

		}else{
			if(Actualizar_Variable==""){
				$("#Estilo_Mensaje_Editar_Variable").attr("class", "panel panel-danger");
				$("#ID_Validacion_Editar_Variable").css("fontSize", 15);					
				$("#ID_Validacion_Editar_Variable").css("font-weight","Bold"); 	
				$('#Estilo_Mensaje_Editar_Variable').show();			
				$('#ID_Validacion_Editar_Variable').html('<center> El campo no puede estar vacio.</center>');	
				$('#ID_Validacion_Editar_Variable').show();
				document.getElementById("Actualizar_Variable").focus();
			}else{
				$('#Confirmar_Modal_Actualizar_Variable').modal('show');
				$('#Estilo_Mensaje_Editar_Variable').hide();
				$('#ID_Validacion_Editar_Variable').hide();
				return false;
			}
		}
		$("#Estilo_Mensaje_Editar_Variable").fadeTo(4500, 500).slideUp(500, function(){
			$("#Estilo_Mensaje_Editar_Variable").hide();
		}); 
	}

	$('.ActualizarVariable').click(function(){
		var NombreVariableEditar_Oculto=$('#NombreVariableEditar_Oculto').val();
		var Actualizar_Variable=$('#Actualizar_Variable').val();
		var id_variable_actualizar=$('#id_variable_actualizar').val();
		Actualizar_Variable =  Actualizar_Variable.toLowerCase();
		
		$.ajax({
			url   : "<?= URL::to('Actualizar_Variable') ?>",
			type  : "GET",
			async : false,
			data:{
				'NombreVariableEditar_Oculto' 	 : NombreVariableEditar_Oculto,
				'Actualizar_Variable' 	 		 : Actualizar_Variable,
				'id_variable_actualizar' 		 : id_variable_actualizar
			},		
			success:function(respuesta){
				if(respuesta==0){
					$('#Confirmar_Modal_Actualizar_Variable').modal('hide');
					$('#Modal_Actualizar_Variable').modal('hide');					
					$("#ID_Validacion_Mensaje_Principal").css("fontSize", 15);				
					// $("#ID_Validacion_Mensaje_Principal").css("font-weight","Bold"); 	
					$("#Estilo_Mensaje_Principal").attr("class", "panel panel-success col-xs-12 col-sm-12 col-md-4 col-lg-4");
					$('#Estilo_Mensaje_Principal').show();		
					$('#ID_Validacion_Mensaje_Principal').html('<center> <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Se ha <strong>Actualizado</strong> correctamente una nueva variable.</center>');	
					$('#ID_Validacion_Mensaje_Principal').show();
					RemoverDataCombobox(document.getElementById("id_parametro_seleccionado"));			
					RemoverDataCombobox(document.getElementById("id_select_unidad"));
					Cargar_Parametros();
					Cargar_Unidades();
					$('#Nueva_Variable').val('');
					$('#Actualizar_Variable').val('');
					$('#Nueva_Unidad').val('');					
					$('#id_parametro_seleccionado').val('').selectpicker('refresh');
					$('#id_select_unidad').val('').selectpicker('refresh');
					$("#ID_Validacion_Mensaje_Principal").fadeTo(5000, 500).slideUp(500, function(){
						$("#ID_Validacion_Mensaje_Principal").css("display", "none");		
					});
					$('select[name=id_parametro_seleccionado]').val(id_variable_actualizar);
					$('select[name=id_parametro_seleccionado]').change(); 					var NombreVariable =$("#id_parametro_seleccionado option:selected").text();					
					$('#DatoSeleccionado').html("Has seleccionado la Variable: <br><strong><font size ='5', color='#0a91cc', face='Tahoma'> <i class='fa fa-check' aria-hidden='true'></i> "+ NombreVariable +"</font></strong>");	
					$('#DatoSeleccionado').css("fontSize", 20);						
					$('#DatoSeleccionado').css("font-weight","Bold");					
				}
				if(respuesta==2){					
					$('#Confirmar_Modal_Actualizar_Variable').modal('hide');
					$('#ID_Validacion_Editar_Variable').html('');					
					$('#Estilo_Mensaje_Editar_Variable').show();
					$("#Estilo_Mensaje_Editar_Variable").attr("class", "panel panel-danger");
					$("#ID_Validacion_Editar_Variable").css("fontSize", 15);				
					// $("#ID_Validacion_Editar_Variable").css("font-weight","Bold");		
					$('#ID_Validacion_Editar_Variable').html('<strong>ERROR:</strong> No se ha encontrado ningún cambio a modificar.');
					$('#ID_Validacion_Editar_Variable').show();	
					$("#ID_Validacion_Editar_Variable").fadeTo(5000, 500).slideUp(500, function(){
						$("#ID_Validacion_Editar_Variable").css("display", "none");			
					});				
				}
				if(respuesta==3){					
					$('#Confirmar_Modal_Actualizar_Variable').modal('hide');
					$('#ID_Validacion_Editar_Variable').html('');					
					$('#Estilo_Mensaje_Editar_Variable').show();
					$("#Estilo_Mensaje_Editar_Variable").attr("class", "panel panel-danger");
					$("#ID_Validacion_Editar_Variable").css("fontSize", 15);				
					// $("#ID_Validacion_Editar_Variable").css("font-weight","Bold");		
					$('#ID_Validacion_Editar_Variable').html('<strong>ERROR:</strong> Se ha encontrado un registro parecido. Por favor Ingresa otro nombre.');
					$('#ID_Validacion_Editar_Variable').show();	
					$("#ID_Validacion_Editar_Variable").fadeTo(5000, 500).slideUp(500, function(){
						$("#ID_Validacion_Editar_Variable").css("display", "none");			
					});				
				}		
			}
		});
	});
$('#btn_eliminar_variable').click(function(){
	var NombreVariable =$("#id_parametro_seleccionado option:selected").text();
	var id_parametro_seleccionado= document.getElementById("id_parametro_seleccionado").value;		
	$('#NombreVariableEliminar').html('Se va a eliminar la variable: '+ NombreVariable +', y también se eliminara todas las unidades asociadas.');
	$('#id_variable_eliminar').val(id_parametro_seleccionado);
	$('#Confirmar_Modal_Eliminar_Variable').modal('show');
});	
$('.EliminarVariable').click(function(){
	var id_variable_eliminar =$('#id_variable_eliminar').val();
	var NombreVariable =$("#id_parametro_seleccionado option:selected").text();
	NombreVariable  = NombreVariable .toUpperCase();
	
	$.ajax({
		url   : "<?= URL::to('Eliminar_Variable') ?>",
		type  : "GET",
		async : false,
		data:{
			'id_variable_eliminar' 	 : id_variable_eliminar				
		},		
		success:function(respuesta){
			if(respuesta==0){
				$('#Confirmar_Modal_Eliminar_Variable').modal('hide');
				$("#ID_Validacion_Mensaje_Principal").css("fontSize", 15);				
					// $("#ID_Validacion_Mensaje_Principal").css("font-weight","Bold"); 	
					$("#Estilo_Mensaje_Principal").attr("class", "panel panel-success col-xs-12 col-sm-12 col-md-4 col-lg-4");
					$('#Estilo_Mensaje_Principal').show();		
					$('#ID_Validacion_Mensaje_Principal').html('<center> <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Se ha <strong>Eliminado</strong> correctamente la variable.</center>');	
					$('#ID_Validacion_Mensaje_Principal').show();
					RemoverDataCombobox(document.getElementById("id_parametro_seleccionado"));					
					Cargar_Parametros();
					RemoverDataCombobox(document.getElementById("id_select_unidad"));
					Cargar_Unidades();
					$('#Nueva_Variable').val('');
					$('#Actualizar_Variable').val('');
					$('#Nueva_Unidad').val('');	
					$('#id_parametro_seleccionado').val('').selectpicker('refresh');
					$('#id_select_unidad').val('').selectpicker('refresh');
					$("#ID_Validacion_Mensaje_Principal").fadeTo(3200, 500).slideUp(500, function(){
						$("#ID_Validacion_Mensaje_Principal").css("display", "none");		
					});
					CargarMensaje();
					Cambio_Estado_Botones();					
				}
				if(respuesta==2){
					$('#Confirmar_Modal_Eliminar_Variable').modal('hide');
					$("#ID_Validacion_Mensaje_Principal").css("fontSize", 15);				
					// $("#ID_Validacion_Mensaje_Principal").css("font-weight","Bold"); 	
					$("#Estilo_Mensaje_Principal").attr("class", "panel panel-danger col-xs-12 col-sm-12 col-md-4 col-lg-4");
					$('#Estilo_Mensaje_Principal').show();		
					$('#ID_Validacion_Mensaje_Principal').html('<center> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <strong>ERROR AL ELIMINAR: <br></strong>Se encontró la variable "<strong>'+NombreVariable+'</strong>"  asociada a un formulario.  Desvincúlela y vuelve a intentarlo.</center>');	
					$('#ID_Validacion_Mensaje_Principal').show();
					
					$("#ID_Validacion_Mensaje_Principal").fadeTo(10000, 500).slideUp(500, function(){
						$("#ID_Validacion_Mensaje_Principal").css("display", "none");		
					});
					CargarMensaje();
					Cambio_Estado_Botones();					
				}
			}
		});
});
	// AQUI TERMINA TODO DE VARIABLE
	// AQUI EMPIENZA UNIDAD
	$('#btn_nueva_unidad').click(function(){
		$('#Modal_Registro_Unidad').modal('show');
	});

	function RegistrarUnidad(){
		var Nueva_Unidad=$('#Nueva_Unidad').val();
		var patron =/[a-z,A-Z]/;

		if(!patron.test(Nueva_Unidad)){
			$("#Estilo_Validacion_Nueva_Unidad").attr("class", "panel panel-danger");
			$("#ID_Validacion_Nueva_Unidad").css("fontSize", 15);						
			$("#ID_Validacion_Nueva_Unidad").css("font-weight","Bold"); 	
			$('#Estilo_Validacion_Nueva_Unidad').show();			
			$('#ID_Validacion_Nueva_Unidad').html('<center> El campo no puede estar vacio.</center>');	
			$('#ID_Validacion_Nueva_Unidad').show();
			document.getElementById("Nueva_Unidad").focus();

		}else{
			if(Nueva_Unidad==""){
				$("#Estilo_Validacion_Nueva_Unidad").attr("class", "panel panel-danger");
				$("#ID_Validacion_Nueva_Unidad").css("fontSize", 15);						
				$("#ID_Validacion_Nueva_Unidad").css("font-weight","Bold"); 	
				$('#Estilo_Validacion_Nueva_Unidad').show();			
				$('#ID_Validacion_Nueva_Unidad').html('<center> El campo no puede estar vacio.</center>');	
				$('#ID_Validacion_Nueva_Unidad').show();
				document.getElementById("Nueva_Unidad").focus();
			}else{
				$('#Confirmar_Modal_Nueva_Unidad').modal('show');
				$('#Estilo_Validacion_Nueva_Unidad').hide();
				$('#ID_Validacion_Nueva_Unidad').hide();
				return false;
			}
		}
		$("#Estilo_Validacion_Nueva_Unidad").fadeTo(4500, 500).slideUp(500, function(){
			$("#Estilo_Validacion_Nueva_Unidad").hide();
		}); 
	}

	$('.RegistrarNuevaUnidad').click(function(){
		
		var id_parametro_seleccionado= document.getElementById("id_parametro_seleccionado").value;
		var Nueva_Unidad=$('#Nueva_Unidad').val();
		Nueva_Unidad =  Nueva_Unidad.toLowerCase();
		$.ajax({
			url   : "<?= URL::to('Registrar_Nueva_Unidad') ?>",
			type  : "GET",
			async : false,
			data:{
				'Nueva_Unidad' 	 				 : Nueva_Unidad,
				'id_parametro_seleccionado' 	 : id_parametro_seleccionado							
			},		
			success:function(respuesta){
				if(respuesta.resultado==0){
					$('#Confirmar_Modal_Nueva_Unidad').modal('hide');
					$('#Modal_Registro_Unidad').modal('hide');					
					$("#ID_Validacion_Mensaje_Principal").css("fontSize", 15);				
					// $("#ID_Validacion_Mensaje_Principal").css("font-weight","Bold"); 	
					$("#Estilo_Mensaje_Principal").attr("class", "panel panel-success col-xs-12 col-sm-12 col-md-4 col-lg-4");
					$('#Estilo_Mensaje_Principal').show();		
					$('#ID_Validacion_Mensaje_Principal').html('<center> <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Se ha <strong>Registrado</strong> correctamente la unidad.</center>');	
					$('#ID_Validacion_Mensaje_Principal').show();
					// RemoverDataCombobox(document.getElementById("id_parametro_seleccionado"));			
					// Cargar_Parametros();
					RemoverDataCombobox(document.getElementById("id_select_unidad"));
					Cargar_Unidades();
					$('#Nueva_Variable').val('');
					$('#Actualizar_Variable').val('');
					$('#Nueva_Unidad').val('');	
					$('#id_select_unidad').val('').selectpicker('refresh');					
					$("#ID_Validacion_Mensaje_Principal").fadeTo(6000, 500).slideUp(500, function(){
						$("#ID_Validacion_Mensaje_Principal").css("display", "none");		
					});					
					// $('select[name=id_select_unidad]').val(respuesta.ultimo_id);
					// $('select[name=id_select_unidad]').change(); 					
					
					// var NombreVariable =$("#id_parametro_seleccionado option:selected").text();
					// var NombreUnidad =$("#id_select_unidad option:selected").text();				
					// console.log(NombreVariable+'  '+NombreUnidad +' '+ respuesta.ultimo_id);

					// $('#DatoSeleccionado').html("Has seleccionado la Variable <br><strong><font size ='5', color='#0a91cc', face='Tahoma'> <i class='fa fa-check' aria-hidden='true'></i> "+ NombreVariable +"</font></strong><br><br> Has seleccionado la Unidad: <br><strong><font size ='5', color='#0a91cc', face='Tahoma'> <i class='fa fa-check' aria-hidden='true'></i> "+ NombreUnidad +"</font></strong>");
					// $('#DatoSeleccionado').css("fontSize", 20);						
					// $('#DatoSeleccionado').css("font-weight","Bold");			
				}

				if(respuesta.error==false){	
					$('#Confirmar_Modal_Nueva_Unidad').modal('hide');
					$('#ID_Validacion_Nueva_Variable').html('');
					$.each(respuesta.errors,function(index, error){ 
						$('#Estilo_Validacion_Nueva_Unidad').show();
						$("#ID_Validacion_Nueva_Unidad").css("fontSize", 15);				
						// $("#ID_Validacion_Nueva_Unidad").css("font-weight","Bold");	
						$('#ID_Validacion_Nueva_Unidad').html('<strong>ERROR:</strong>'+error);
						$('#ID_Validacion_Nueva_Unidad').show();
					}); 
				}
			}
		});		
	});

	$('#btn_modificar_unidad').click(function(){
		var id_select_unidad= document.getElementById("id_select_unidad").value;		
		var NombreUnidad =$("#id_select_unidad option:selected").text();
		
		$('#id_unidad_actualizar').val(id_select_unidad);
		$('#Actualizar_Unidad').val(NombreUnidad);
		$('#NombreUnidadEditar_Oculto').val(NombreUnidad);			
		$('#Modal_Actualizar_Unidad').modal('show');
		
	});

	function ModificarUnidad(){
		var Actualizar_Unidad=$('#Actualizar_Unidad').val();
		var patron =/[a-z,A-Z]/;

		if(!patron.test(Actualizar_Unidad)){
			$("#Estilo_Mensaje_Editar_Unidad").attr("class", "panel panel-danger");
			$("#ID_Validacion_Editar_Unidad").css("fontSize", 15);						
			$("#ID_Validacion_Editar_Unidad").css("font-weight","Bold"); 	
			$('#Estilo_Mensaje_Editar_Unidad').show();			
			$('#ID_Validacion_Editar_Unidad').html('<center> El campo no puede estar vacio.</center>');	
			$('#ID_Validacion_Editar_Unidad').show();
			document.getElementById("Actualizar_Unidad").focus();

		}else{
			if(Actualizar_Unidad==""){
				$("#Estilo_Mensaje_Editar_Unidad").attr("class", "panel panel-danger");
				$("#ID_Validacion_Editar_Unidad").css("fontSize", 15);					
				$("#ID_Validacion_Editar_Unidad").css("font-weight","Bold"); 	
				$('#Estilo_Mensaje_Editar_Unidad').show();			
				$('#ID_Validacion_Editar_Unidad').html('<center> El campo no puede estar vacio.</center>');	
				$('#ID_Validacion_Editar_Unidad').show();
				document.getElementById("Actualizar_Unidad").focus();
			}else{
				$('#Confirmar_Modal_Actualizar_Unidad').modal('show');
				$('#Estilo_Mensaje_Editar_Unidad').hide();
				$('#ID_Validacion_Editar_Unidad').hide();
				return false;
			}
		}
		$("#Estilo_Mensaje_Editar_Unidad").fadeTo(4500, 500).slideUp(500, function(){
			$("#Estilo_Mensaje_Editar_Unidad").hide();
		}); 
	}

	$('.ActualizarUnidad').click(function(){
		var NombreUnidadEditar_Oculto=$('#NombreUnidadEditar_Oculto').val();
		var Actualizar_Unidad=$('#Actualizar_Unidad').val();
		var id_unidad_actualizar=$('#id_unidad_actualizar').val();
		Actualizar_Unidad =  Actualizar_Unidad.toLowerCase();
		$.ajax({
			url   : "<?= URL::to('Actualizar_Unidad') ?>",
			type  : "GET",
			async : false,
			data:{
				'NombreUnidadEditar_Oculto'  : NombreUnidadEditar_Oculto,
				'Actualizar_Unidad' 	 	 : Actualizar_Unidad,
				'id_unidad_actualizar' 		 : id_unidad_actualizar
			},		
			success:function(respuesta){
				if(respuesta==0){
					$('#Confirmar_Modal_Actualizar_Unidad').modal('hide');
					$('#Modal_Actualizar_Unidad').modal('hide');					
					$("#ID_Validacion_Mensaje_Principal").css("fontSize", 15);				
					// $("#ID_Validacion_Mensaje_Principal").css("font-weight","Bold"); 	
					$("#Estilo_Mensaje_Principal").attr("class", "panel panel-success col-xs-12 col-sm-12 col-md-4 col-lg-4");
					$('#Estilo_Mensaje_Principal').show();		
					$('#ID_Validacion_Mensaje_Principal').html('<center> <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Se ha <strong>Actualizado</strong> correctamente una nueva Unidad.</center>');	
					$('#ID_Validacion_Mensaje_Principal').show();

					RemoverDataCombobox(document.getElementById("id_select_unidad"));			
					Cargar_Unidades();
					$('#Nueva_Variable').val('');
					$('#Actualizar_Variable').val('');
					$('#Nueva_Unidad').val('');	
					$('#Actualizar_Unidad').val('');				
					
					$('#id_select_unidad').val('').selectpicker('refresh');
					$("#ID_Validacion_Mensaje_Principal").fadeTo(5000, 500).slideUp(500, function(){
						$("#ID_Validacion_Mensaje_Principal").css("display", "none");		
					});
					$('select[name=id_select_unidad]').val(id_unidad_actualizar);
					$('select[name=id_select_unidad]').change(); 					
					var NombreVariable =$("#id_parametro_seleccionado option:selected").text();
					var NombreUnidad =$("#id_select_unidad option:selected").text();		
					
					$('#DatoSeleccionado').html("Has seleccionado la Variable <br><strong><font size ='5', color='#0a91cc', face='Tahoma'> <i class='fa fa-check' aria-hidden='true'></i> "+ NombreVariable +"</font></strong><br><br> Has seleccionado la Unidad: <br><strong><font size ='5', color='#0a91cc', face='Tahoma'> <i class='fa fa-check' aria-hidden='true'></i> "+ NombreUnidad +"</font></strong>");
					$('#DatoSeleccionado').css("fontSize", 20);						
					$('#DatoSeleccionado').css("font-weight","Bold");				
				}
				if(respuesta==2){					
					$('#Confirmar_Modal_Actualizar_Unidad').modal('hide');
					$('#ID_Validacion_Editar_Unidad').html('');					
					$('#Estilo_Mensaje_Editar_Unidad').show();
					$("#Estilo_Mensaje_Editar_Unidad").attr("class", "panel panel-danger");
					$("#ID_Validacion_Editar_Unidad").css("fontSize", 15);				
					// $("#ID_Validacion_Editar_Unidad").css("font-weight","Bold");		
					$('#ID_Validacion_Editar_Unidad').html('<strong>ERROR:</strong> No se ha encontrado ningún cambio a modificar.');
					$('#ID_Validacion_Editar_Unidad').show();	
					$("#ID_Validacion_Editar_Unidad").fadeTo(5000, 500).slideUp(500, function(){
						$("#ID_Validacion_Editar_Unidad").css("display", "none");			
					});				
				}
				if(respuesta==3){					
					$('#Confirmar_Modal_Actualizar_Unidad').modal('hide');
					$('#ID_Validacion_Editar_Unidad').html('');					
					$('#Estilo_Mensaje_Editar_Unidad').show();
					$("#Estilo_Mensaje_Editar_Unidad").attr("class", "panel panel-danger");
					$("#ID_Validacion_Editar_Unidad").css("fontSize", 15);				
					// $("#ID_Validacion_Editar_Unidad").css("font-weight","Bold");		
					$('#ID_Validacion_Editar_Unidad').html('<strong>ERROR:</strong> Se ha encontrado un registro parecido. Por favor Ingresa otro nombre.');
					$('#ID_Validacion_Editar_Unidad').show();	
					$("#ID_Validacion_Editar_Unidad").fadeTo(5000, 500).slideUp(500, function(){
						$("#ID_Validacion_Editar_Unidad").css("display", "none");			
					});				
				}		
			}
		});
	});
	$('#btn_eliminar_unidad').click(function(){

		var id_select_unidad= document.getElementById("id_select_unidad").value;		
		var NombreUnidad =$("#id_select_unidad option:selected").text();	
		
		$('#NombreUnidadEliminar').html('Se va a eliminar la unidad: '+ NombreUnidad);
		$('#id_unidad_eliminar').val(id_select_unidad);
		$('#Confirmar_Modal_Eliminar_Unidad').modal('show');
	});	
	$('.EliminarUnidad').click(function(){
		var id_unidad_eliminar =$('#id_unidad_eliminar').val();
		var NombreUnidad =$("#id_select_unidad option:selected").text();
		NombreUnidad  = NombreUnidad .toUpperCase();

		$.ajax({
			url   : "<?= URL::to('Eliminar_Unidad') ?>",
			type  : "GET",
			async : false,
			data:{
				'id_unidad_eliminar' 	 : id_unidad_eliminar				
			},		
			success:function(respuesta){
				if(respuesta==0){
					$('#Confirmar_Modal_Eliminar_Unidad').modal('hide');
					$("#ID_Validacion_Mensaje_Principal").css("fontSize", 15);				
					// $("#ID_Validacion_Mensaje_Principal").css("font-weight","Bold"); 	
					$("#Estilo_Mensaje_Principal").attr("class", "panel panel-success col-xs-12 col-sm-12 col-md-4 col-lg-4");
					$('#Estilo_Mensaje_Principal').show();		
					$('#ID_Validacion_Mensaje_Principal').html('<center> <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Se ha <strong>Eliminado</strong> correctamente la Unidad.</center>');	
					$('#ID_Validacion_Mensaje_Principal').show();					
					RemoverDataCombobox(document.getElementById("id_select_unidad"));
					Cargar_Unidades();
					$('#Nueva_Variable').val('');
					$('#Actualizar_Variable').val('');
					$('#Nueva_Unidad').val('');
					$('#id_select_unidad').val('').selectpicker('refresh');
					$("#ID_Validacion_Mensaje_Principal").fadeTo(3200, 500).slideUp(500, function(){
						$("#ID_Validacion_Mensaje_Principal").css("display", "none");		
					});					
					Habilitar_Botones_Unidad();			
				}
				if(respuesta==2){
					$('#Confirmar_Modal_Eliminar_Unidad').modal('hide');
					$("#ID_Validacion_Mensaje_Principal").css("fontSize", 15);				
					// $("#ID_Validacion_Mensaje_Principal").css("font-weight","Bold"); 	
					$("#Estilo_Mensaje_Principal").attr("class", "panel panel-danger col-xs-12 col-sm-12 col-md-4 col-lg-4");
					$('#Estilo_Mensaje_Principal').show();		
					$('#ID_Validacion_Mensaje_Principal').html('<center> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <strong>ERROR AL ELIMINAR: <br></strong>Se encontró la Unidad "<strong>'+NombreUnidad+'</strong>"  asociada a un formulario.  Desvincúlela y vuelve a intentarlo.</center>');	
					$('#ID_Validacion_Mensaje_Principal').show();
					
					$("#ID_Validacion_Mensaje_Principal").fadeTo(10000, 500).slideUp(500, function(){
						$("#ID_Validacion_Mensaje_Principal").css("display", "none");		
					});	

				}
			}
		});
	});

	// AQUI TERMINA TODO DE UNIDAD
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>