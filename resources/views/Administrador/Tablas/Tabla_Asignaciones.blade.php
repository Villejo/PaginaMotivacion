@if($Asignaciones->total()==0)
<script type="text/javascript">	
	$('.id_tabla_mostrar').hide();	
</script>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<img src="global/images/No_Found_Asignacion.png" alt="logo" class="img-thumbnail img-responsive" >	
</div>
@else
<script type="text/javascript">	
	$('.id_tabla_mostrar').show();	
</script>
<div class="panel panel-info">	
	<div class="panel-heading" style="background-color: #1c6a9e">
		<h3 class="panel-title">
			<strong>Listado de Asignaciones</strong>
			<div class="pull-right">
				<strong>Total Asignaciones:</strong>
				<label><font size ="3", color="#db8308" face="Tahoma"><strong>{{$Asignaciones->total()}}</strong></font></label>
			</div>
		</h3>
	</div>	
	<div class="panel-body">		
		@foreach ($Asignaciones as $value)	
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="panel panel-primary">
				<div class="panel-heading" style="background-color: #321a7c">		<h3 class="panel-title">
					<b>
						<strong>
							<font color ="#fff200">MÁQUINA</font>
						</strong>						
						<font size ="3", color="#16d6fc" face="Tahoma"><strong>{{$value->Nombre_Equipo->nombre_equipo}}</strong></font>
					</b>
				</h3>
			</div>
			<div class="panel-body">
				<table class="table table-user-information">
					<div class="row">
						<tbody>
							<tr>
								<td>
									<i class="fa fa-user" aria-hidden="true"></i>
									<b><strong><font size ="2", color="#000000" face="Tahoma">Nombre Usuario:</font></strong></b>
								</td>
								<td>								
									<span class="badge btn-md btn-success" style="background: #067bad;">
										<b>
											<strong>
												<font size ="2">
													{{$value->Nombre_Usuario->nombre_usuario}} {{$value->Nombre_Usuario->apellido}}		
												</font>
											</strong>
										</b>
									</span>
								</td>								
							</tr>
							<tr>
								<td>
									<i class="fa fa-clock-o" aria-hidden="true"></i>
									<b><strong><font size ="2", color="#000000" face="Tahoma">Turno:</font></strong></b>
								</td>
								<td>								
									<span class="badge btn-md btn-success" style="background: #067bad;">
										<b>
											<strong>
												<font size ="2">
													{{$value->Nombre_Turno->nombre_turno}}		
												</font>
											</strong>
										</b>
									</span>
								</td>
							</tr>
							<tr>
								<td>
									<i class="fa fa-cog" aria-hidden="true"></i>
									<b><strong><font size ="2", color="#000000" face="Tahoma">Nombre Formulario:</font></strong></b>
								</td>
								<td>								
									<span class="badge btn-md btn-success" style="background: #067bad;">
										<b>
											<strong>
												<font size ="2">
													{{$value->Nombre_Formulario->nombre_formulario}}	
												</font>
											</strong>
										</b>
									</span>
								</td>
							</tr>
							<tr>
								<td>
									<i class="fa fa-calendar" aria-hidden="true"></i>
									<b><strong><font size ="2", color="#000000" face="Tahoma">Fecha Inicio:</font></strong></b>
								</td>
								<td>								
									<span class="badge btn-md btn-success" style="background: #067bad;">
										<b>
											<strong>
												<font size ="2">
													{{Carbon::parse($value->fecha_inicio)->toDateString()}}		
												</font>
											</strong>
										</b>
									</span>
								</td>
							</tr>
							<tr>
								<td>
									<i class="fa fa-calendar" aria-hidden="true"></i>
									<b><strong><font size ="2", color="#000000" face="Tahoma">Fecha Fin:</font></strong></b>
								</td>
								<td>								
									<span class="badge btn-md btn-success" style="background: #067bad;">
										<b>
											<strong>
												<font size ="2">
													{{Carbon::parse($value->fecha_fin)->toDateString()}}		
												</font>
											</strong>
										</b>
									</span>
								</td>
							</tr>
						</tbody>
					</div>
				</table>
				<div class="panel-footer">Panel de opciones
					<div class="pull-right">
						<a href="#" data-toggle = 'modal' data-target="#Modal_Confirmacion_Delete" class="Eliminar_Asignacion" id_Eliminar_Asignacion="{{$value->id}}" title="Eliminar"> <strong> <font size ="3", color ="#321a7c" face="Lucida Sans"><span class= "fa fa-times fa-2x"></span></font>
						</a>
						|
						<a href="#" id="{{$value->id}}" id_Editar_Asignacion="{{$value->id}}" class="Editar_Asignacion" title="Editar" <strong> 
							<font size ="3", color ="#321a7c" face="Lucida Sans"><span class= "fa fa-pencil-square-o fa-2x"></span></font>
						</a>	
					</div>
				</div>

			</div>			
		</div>		
	</div>
	@endforeach
</div>
<center>{{$Asignaciones->links()}}</center>	
</div>

<div class="modal fade" id="ModalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">					
				<h4 class="modal-title" id="myModalLabel">¿ Esta seguro de Eliminar la Asignación ?</h4>
				<input type="hidden" name="id_asignacion_eliminar" id="id_asignacion_eliminar" class="form-control">
			</div>					
			<div class="modal-footer">
				<button type="button" class="btn btn-primary DeleteAsignacion">SI</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>					
			</div>
		</div>
	</div>
</div>

{{Form::input("hidden", "_token", csrf_token())}}

<script type="text/javascript">
	$('.Eliminar_Asignacion').click(function(){	
		var id_Eliminar_Asignacion=($(this).attr('id_Eliminar_Asignacion'));	
		$('#id_asignacion_eliminar').val(id_Eliminar_Asignacion);
		$('#ModalEliminar').modal('show');		
	});

	$('.DeleteAsignacion').click(function(){		
		var id_asignacion_eliminar=$('#id_asignacion_eliminar').val();
		$.ajax({
			url   : "<?= URL::to('Eliminar_Asignacion') ?>",
			type  : "GET",
			async : false,
			data  :{
				'id_asignacion_eliminar'     : id_asignacion_eliminar				
			},
			success:function(respuesta){
				if(respuesta==0){ 
					Cargar_Tabla();       
					$('#success-alerta2').show();
					subir();
					$('#ModalEliminar').modal('hide');       
					$(document).ready (function(){  						
						$("#success-alerta2").hide(); 
						$("#success-alerta2").alert();     
						$("#success-alerta2").fadeTo(4500, 500).slideUp(500, function(){
							$("#success-alerta2").hide();
						});  
					});					
				}
			}
		});
	});

	$('.Editar_Asignacion').click(function(){	
		var _token=$('#_token').val();
		var id_Editar_Asignacion=($(this).attr('id_Editar_Asignacion'));		
		$.ajax({
			url   : "<?= URL::to('Cargar_Datos_Editar_Asignacion') ?>",
			type  : "GET",
			async : false,
			data  :{
				'id_Editar_Asignacion'     : id_Editar_Asignacion			
			},
			success:function(respuesta){				
				$('select[name=id_nombre_usuario_editar]').val(respuesta.id_usuario);
				$('select[name=id_nombre_usuario_editar]').change();		
				$('select[name=id_turno_editar]').val(respuesta.fk_turno);
				$('select[name=id_turno_editar]').change();
				$('select[name=id_formulario_editar]').val(respuesta.fk_formulario);
				$('select[name=id_formulario_editar]').change();
				$('#Fecha_Inicial_editar').val(respuesta.fecha_inicial);
				$('#Fecha_Final_editar').val(respuesta.fecha_final);	
				$('#id_oculto_editar').val(respuesta.id_oculto);
				$('#id_nombre_usuario_editar_oculto').val(respuesta.id_usuario);
				$('#id_turno_editar_oculto').val(respuesta.fk_turno);
				$('#id_formulario_editar_oculto').val(respuesta.fk_formulario);	
				$('#id_maquina_oculta_editar').val(respuesta.id_maquina);

			}
		});
	});

	$('.BtnCancelar').click(function(){
		LimpiarFormulario();		
		Cargar_Usuarios();		
		$('#BtnModificar').hide();
		$('#BtnCancelar').hide();	
		$('#BtnEnviar').show();
		$('#estilo_mensaje').hide();
	});



</script>
@endif