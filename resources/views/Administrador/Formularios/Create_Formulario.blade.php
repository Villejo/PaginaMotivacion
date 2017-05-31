@extends('layouts.master')
@section('title')
Menú Principal
@stop
@section('content')
<div class="page-bar col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<ul class="page-breadcrumb">
		<li>			
			<a href="{{URL::route('Index')}}">Inicio</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<i class="fa fa-pencil" aria-hidden="true"></i>
			<a href="#">Editar Formulario</a>
			<i class="fa fa-angle-right"></i>
		</li>					
	</ul>
</div>
<br><br><br>
<div class="panel panel-primary">
	<div class="panel-heading">
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-6">
				<div class="panel panel-danger">
					<div class="panel-heading">				
						<h3 class="panel-title"><b><strong>Panel de Opciones</strong></b></h3>	
					</div>					
					<div class="panel-body">			
						<div class="form-group ">				
							<font size ="2", color ="#000000">Seleccione el formulario a mostrar:</font>
							<select class="selectpicker id_formulario_mostrar form-control" onchange="Consultar_Formulario();" data-live-search="true" id="id_formulario_mostrar" name="id_formulario_mostrar" autofocus>
								<option></option>
							</select>
						</div>
						<p></p>
						<button type="button" style="display: none; background-color: #645b7c;" class="btn btnNuevoRegistroDetalle"   
						id="btnNuevoRegistroDetalle" title="Registrar Nuevo Registro">
						<strong>
							<font size ="2", color ="#ffffff" face="Lucida Sans">
								<span>
									Nuevo Registro
								</span>
							</font>
						</strong>
						<font color ="#ffffff">
							<span class="fa fa-plus-square"></span>
						</font>
					</button>
					<button type="button" class="btn NuevoFormulario" style="background-color: #0597a8" 
					id="NuevoFormulario" title="Registrar Nuevo Formulario">
					<strong><font size ="2", color ="#ffffff" face="Lucida Sans"><span>Nuevo Formulario</span></font></strong>
					<font color ="#ffffff">
						<span class="fa fa-plus-square"></span>
					</font>
				</button>
				<button type="button" class="btn Editar_Encabezado_Formulario" style="display: none;background-color: #0597a8" 
				id="NuevoFormulario" title="Editar Formulario">
				<strong><font size ="2", color ="#ffffff" face="Lucida Sans"><span>Editar Formulario</span></font></strong>
				<font color ="#ffffff">
					<span class="fa fa-pencil-square-o"></span>
				</font>
			</button>					
		</div>
	</div>
</div>
<br><br><br>
<input type="hidden" name="id_ultimo_registro_encontrado" id="id_ultimo_registro_encontrado" class="id_ultimo_registro_encontrado">
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-6">
	<div class="panel panel-danger" style="display: none;" id="estilo_mensaje_registro">
		<div class="panel-heading" id="id_validacion_registro" style="display:none">
		</div>
	</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-12">

	<div id="id_tabla_mostrar" class="id_tabla_mostrar" style="display: none"></div>
</div>
</div>
</div>
</div>	

<!-- Modal Registro Encabezado Nuevo Formulario-->
<div class="modal fade" id="Modal_Registro_Encabezado" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#007835" face="Arial Black">
						<i class="fa fa-file-o fa-2x" aria-hidden="true"></i> NUEVO FORMULARIO</font></strong>						
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
								<td>								
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Seleccione el equipo:</font></strong></b>
								</td>
								<td>
									<select class="form-control selectpicker id_nombre_equipo" data-live-search="true" id="id_nombre_equipo" name="id_nombre_equipo" autofocus>
										<option></option>
									</select>
								</td>
							</tr>								
							<tr>
								<td>								
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Nombre Formulario:</font></strong></b>
								</td>
								<td>
									<input type="text" name="Nombre_Nuevo_Formulario" id="Nombre_Nuevo_Formulario" class="form-control">
								</td>
							</tr>														
						</tbody>
					</div>
				</table>
			</div>			
			<div class="modal-footer">
				<button type="button" onclick="Validar_Registro_Formulario();"  class="btn btn-circle" style="background-color: #007835" title="Registrar">
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
<!-- Termina Modal Registro Encabezado -->
<!-- Confirmarcion Modal Registro Encabezado -->
<div class="modal fade" id="ModalConfirmar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">					
				<h4 class="modal-title" id="myModalLabel">¿ Esta seguro de Crear el nuevo formulario ?</h4>
				<input type="hidden" name="IdNotificacion" id="IdNoti" class="form-control">
			</div>					
			<div class="modal-footer">
				<button type="button" class="btn btn-primary BtnRegistrarNuevoFormulario">SI</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>					
			</div>
		</div>
	</div>
</div>
<!-- Termina Confirmarcion Modal Registro Encabezado -->
<!-- Modal Registrar detalle formulario-->
<div class="modal fade" id="Modal_Registro_Detalle" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#007835" face="Arial Black">
						<i class="fa fa-file-o fa-2x" aria-hidden="true"></i> REGISTROS DETALLE FORMULARIO</font></strong>						
					</b>
				</h4>
			</div>
			<div class="modal-body">
				<table class="table table-user-information">
					<div class="row">						
						<tbody>	
							<div class="panel panel-danger" style="display:none" id="estilo_mensaje3">
								<div class="panel-heading" id="id_validacion3" style="display:none">
								</div>
							</div>							
							<tr>
								<td>
									<i class="fa fa-cogs" aria-hidden="true"></i> 							
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Parámetros Control:</font></strong></b>
								</td>
								<td>
									<select  class="form-control selectpicker id_parametro_seleccionado" data-live-search="true" id="id_parametro_seleccionado"  name="id_parametro_seleccionado" onchange="Cambio_Estado_Botones();" >
										<option></option>
									</select>									
								</td>
							</tr>
							<tr>
								<td>
									<i class="fa fa-cogs" aria-hidden="true"></i> 							
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Unidad:</font></strong></b>
								</td>
								<td>
									<select  class="form-control selectpicker id_select_unidad" data-live-search="true" id="id_select_unidad"  name="id_select_unidad" onchange="Habilitar_Botones_Unidad();" >
										<option></option>
									</select>
								</td>
							</tr>						
							<tr>
								<td>
									<i class="fa fa-cogs" aria-hidden="true"></i> 							
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Valor Mínimo</font></strong></b>
								</td>
								<td>
									<input type="number" name="reg_alarma" id="reg_alarma" class="form-control">
								</td>
							</tr>
							<tr>
								<td>
									<i class="fa fa-cogs" aria-hidden="true"></i> 							
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Valor Ideal:</font></strong></b>
								</td>
								<td>
									<input type="number" name="reg_porcentaje_minimo" id="reg_porcentaje_minimo" class="form-control">
								</td>
							</tr>
							<tr>
								<td>	
									<i class="fa fa-cogs" aria-hidden="true"></i> 						
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Valor Máximo</font></strong></b>
								</td>
								<td>
									<input type="number" name="reg_disparo" id="reg_disparo" class="form-control">
								</td>
							</tr>														
						</tbody>
					</div>
				</table>
			</div>			
			<div class="modal-footer">
				<button type="button" onclick="Validar_Registro_Formulario_Detalle();"  class="btn btn-circle" style="background-color: #007835" title="Registrar">
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
<!-- Termina Modal Registro detalle formulario -->
<!-- Modal Confirmacion Registro detalle formulario -->
<div class="modal fade" id="ModalConfirmar_Detalle_Registro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">					
				<h4 class="modal-title" id="myModalLabel">
					¿ Esta seguro de crear el nuevo detalle al formulario ?</h4>
					<input type="hidden" name="IdNotificacion" id="IdNoti" class="form-control">
				</div>					
				<div class="modal-footer">
					<button type="button" class="btn btn-primary BtnRegistrarNuevoDetalleFormulario">SI</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>			
				</div>
			</div>
		</div>
	</div>
	<!-- Termina Confirmacion Modal Registro detalle formulario -->

	<!-- Modal Confirmacion Eliminar detalle formulario -->
	<div class="modal fade" id="ModalConfirmar_Eliminar_Detalle_Registro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">					
					<h4 class="modal-title" id="myModalLabel">
						<b><strong> <font size ="2", color="#007835" face="Arial Black">
							<i class="fa fa-trash-o fa-2x" aria-hidden="true"></i> ¿ESTÁ SEGURO DE ELIMINAR EL DETALLE DEL FORMULARIO?</font></strong>						
						</b>
					</h4>
					<input type="hidden" name="id_registro_detalle_eliminar" id="id_registro_detalle_eliminar" class="form-control">				
				</div>					
				<div class="modal-footer">
					<button type="button" class="btn btn-primary BtnEliminarRegistroDetalle">SI</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>					
				</div>
			</div>
		</div>
	</div>
	<!-- Termina  Modal Confirmacion Eliminar detalle formulario -->


	<!-- Modal Confirmar -->
	<div class="modal fade" id="ModalRegistrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Esperando Confirmación...</h4>
				</div>
				<div class="modal-body">
					¿ Esta seguro de guardar la información ingresada ?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary BtnRegistrarDatos">SI</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
				</div>
			</div>
		</div>
	</div>
	<!-- EMpeiza Modal Editar Registro -->

	<div class="modal fade" id="Modal_Editar_Registro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">					
					<h4 class="modal-title" id="myModalLabel">
						<center>
							<b><strong> <font size ="3", color="#007835" face="Arial Black">
								<i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i> MODIFICAR REGISTRO</font></strong>						
							</b>
						</center>
					</h4>				
				</div>
				<div class="modal-body">			

					<form class="form-horizontal" enctype="multipart/form-data" id="id_formulario_editar" role="form" method="POST" action="" >	
						<input type="hidden" name="Id_formulario_editar_registro" id="Id_formulario_editar_registro" class="form-control btn-circle">		
						<input type="hidden" name="_token" value="{{ csrf_token()}}"> 
						<b>
							<strong>
								<font size ="3", color="#007835" face="Arial Black">
									<label>
										Ingresa los datos a modificar:
									</label>
								</font>
							</strong>
						</b>			
						<table class="table table-user-information">
							<div class="row">						
								<tbody>	
									<div class="panel panel-danger" id="Estilo_Validacion_Editando_Detalle_Registro" tyle="display:none">
										<div class="panel-heading" id="ID_Validacion_Editando_Detalle_Registro" style="display:none">
										</div>
									</div>
									<tr>
										<td>
											<i class="fa fa-briefcase"></i>							
											<b><strong><font size ="2", color color="#000000" face="Tahoma">
												Variable:</font></strong></b>
											</td>
											<td>
												<select  class="form-control selectpicker id_parametro_seleccionado2" data-live-search="true" id="id_parametro_seleccionado2"  name="id_parametro_seleccionado2" onchange="Cambio_Estado_Botones2();" >
													<option></option>
												</select>
											</td>
										</tr>
										<tr>
											<td>
												<i class="fa fa-briefcase"></i>							
												<b><strong><font size ="2", color color="#000000" face="Tahoma">Unidad:</font></strong></b>
											</td>
											<td>
												<select  class="form-control selectpicker id_select_unidad2" data-live-search="true" id="id_select_unidad2"  name="id_select_unidad2" onchange="Habilitar_Botones_Unidad2();" >
													<option></option>
												</select>
											</td>
										</tr>																
										<tr>
											<td>
												<i class="fa fa-briefcase"></i>							
												<b><strong><font size ="2", color color="#000000" face="Tahoma">Valor Mínimo:</font></strong></b>
											</td>
											<td>
												<input type="text" name="Alarma_editar" id="Alarma_editar" class="form-control btn-circle"  placeholder="Ingrese valor donde se genera una alarma">
											</td>
										</tr>
										<tr>
											<td>
												<i class="fa fa-briefcase"></i>							
												<b><strong><font size ="2", color color="#000000" face="Tahoma">Valor Ideal:</font></strong></b>
											</td>
											<td>
												<input type="text" name="Porcentaje_Minimo_editar" id="Porcentaje_Minimo_editar" class="form-control btn-circle"  placeholder="Ingrese el porcentaje mínimo estipulado">
											</td>
										</tr>
										<tr>
											<td>
												<i class="fa fa-briefcase"></i>							
												<b><strong><font size ="2", color color="#000000" face="Tahoma">Valor Máximo</font></strong></b>
											</td>
											<td>
												<input type="text" name="Disparo_editar" id="Disparo_editar" class="form-control btn-circle"  placeholder="Ingrese el valor donde se genera un disparo">
											</td>

										</tr>							
									</tbody>
								</div>					
							</table>
						</form>
					</div>					
					<div class="modal-footer">
						<button type="button" class="btn btn-circle" style="background-color: #007835" title="Modificar" onclick="Validar_Editar_registro();">
							<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>MODIFICAR</span>
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
		<!--  Termina Modal Editar Rol-->

		<!-- Modal Confirmacion Editar Registro detalle-->
		<div class="modal fade" id="Modal_Confirmar_Editar_Registro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">					
						<h4 class="modal-title" id="myModalLabel">¿ Esta seguro de editar el registro?.					
						</h4>
					</div>					
					<div class="modal-footer">
						<button type="button" class="btn btn-circle BtnEditarRegistro" style="background-color: #007835">
							<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>SI</span>
								<span class="fa fa-plus-square"></span>
							</font></strong>
						</button>
						<button type="button" class="btn btn-circle" data-dismiss="modal" style="background-color: #fc0019">
							<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>NO</span>
								<span class="fa fa-times"></span>
							</font></strong>
						</button>					
					</div>
				</div>
			</div>
		</div>
		<!--  Termina Modal Confirmacion Editar Registro detalle-->


		<!--  Modal Editar Encabezado Formulario-->
		<div class="modal fade" id="Modal_Editar_Encabezado_Formulario" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">
							<b><strong> <font size ="2", color="#007835" face="Arial Black">
								<i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i> EDITAR FORMULARIO</font></strong>						
							</b>
						</h4>
					</div>
					<div class="modal-body">
						<table class="table table-user-information">
							<div class="row">						
								<tbody>	
									<div class="panel panel-danger" style="display:none" id="estilo_mensaje_registro2">
										<div class="panel-heading" id="id_validacion_registro2" style="display:none">
										</div>
									</div>
									<tr>
										<td>								
											<b><strong><font size ="2", color color="#000000" face="Tahoma">Seleccione el equipo:</font></strong></b>
										</td>
										<td>
											<select class="form-control selectpicker id_nombre_equipo_editar" data-live-search="true" id="id_nombre_equipo_editar" name="id_nombre_equipo_editar" autofocus>
												<option></option>
											</select>
										</td>
									</tr>								
									<tr>
										<td>								
											<b><strong><font size ="2", color color="#000000" face="Tahoma">Nombre Formulario:</font></strong></b>
										</td>
										<td>
											<input type="text" name="Nombre_Formulario_Editar" id="Nombre_Formulario_Editar" class="form-control">
										</td>							
										
										<input type="hidden" name="id_nombre_equipo_editar_Oculto" id="id_nombre_equipo_editar_Oculto">

										<input type="hidden" name="Nombre_Formulario_Editar_Oculto" id="Nombre_Formulario_Editar_Oculto">
										<input type="hidden" name="id_encabezado_oculto" id="id_encabezado_oculto">
									</tr>														
								</tbody>
							</div>
						</table>
					</div>			
					<div class="modal-footer">
						<button type="button" id="Btn_Confirmar_ModificarEncabezado" onclick="Validar_Editar_Formulario_Encabezado();"  class="btn btn-circle" style="background-color: #007835" title="Modificar">
							<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>MODIFICAR</span>
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
		<!-- Termina Modal Editar Encabezado Formulario -->
		<!-- Modal Confirmacion Editar Encabezado Formulario-->
		<div class="modal fade" id="Modal_Confirmar_Editar_Encabezado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">				
						<h4 class="modal-title" id="myModalLabel">¿Esta seguro de editar el formulario?	</h4>
					</div>					
					<div class="modal-footer">				
						<button type="button" class="btn btn-circle BtnEditarFormularioEncabezado" style="background-color: #007835">
							<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>SI</span>
								<span class="fa fa-plus-square"></span>
							</font></strong>
						</button>
						<button type="button" class="btn btn-circle" data-dismiss="modal" style="background-color: #fc0019">
							<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>NO</span>
								<span class="fa fa-times"></span>
							</font></strong>
						</button>					
					</div>
				</div>
			</div>
		</div>
		<!--  Termina Modal Confirmacion Editar Encabezado Formulario-->

		<!-- Modal Confirmacion Nueva Version Formulario-->
		<div class="modal fade" id="Modal_Confirmar_Nueva_Version_Formulario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">				
						<h4 class="modal-title" id="myModalLabel">¿Esta seguro de Crear una nueva version del formulario?</h4>
					</div>
					<div class="modal-boy">
						<div class="row">					
							<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">			
								<table class="table table-user-information">									
									<tbody>							
										<tr>
											<td>
												<center><img src="global/images/AlertaMensaje.png" width="150" height="150" border="5"/></center>										
											</td>	
										</tr>
									</tbody>	
								</table>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<table class="table table-user-information">									
									<tbody>							
										<tr>
											<td>															
												<b>											
													<strong>
														<font size ="3", color="#000000" face="Tahoma">
															<label id="TextoConfirmarTotalRegistros"><h4><strong>NOTA:</strong></h4></label>
														</font>
													</strong>
												</b>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="modal-footer">				
						<button type="button" class="btn btn-circle BtnNuevaVersionFormulario" style="background-color: #007835">
							<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>SI</span>
								<span class="fa fa-check"></span>
							</font></strong>
						</button>
						<button type="button" class="btn btn-circle" data-dismiss="modal" style="background-color: #fc0019">
							<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>NO</span>
								<span class="fa fa-times"></span>
							</font></strong>
						</button>					
					</div>
				</div>
			</div>
		</div>
		<!--  Termina Modal Confirmacion Nueva Version Formulario-->

		{{Form::input("hidden", "_token", csrf_token())}}

		<script type="text/javascript">


			function Cambio_Estado_Botones(){
				var id_parametro_seleccionado= document.getElementById("id_parametro_seleccionado").value;		
				if(id_parametro_seleccionado==0){		
					document.getElementById('id_select_unidad').disabled=true;						
					$('#id_parametro_seleccionado').val('').selectpicker('refresh');
					$('#id_select_unidad').val('').selectpicker('refresh');		

				}else{		
					
					RemoverDataCombobox(document.getElementById("id_select_unidad"));
					Cargar_Unidades();			
					document.getElementById('id_select_unidad').disabled=false;						
					$('#id_select_unidad').val('').selectpicker('refresh');
				}		
			}
			function Habilitar_Botones_Unidad(){
				var id_select_unidad= document.getElementById("id_select_unidad").value;		

				if(id_select_unidad==0){	
					$('#id_select_unidad').val('').selectpicker('refresh');				
				}
			}

			function RemoverDataCombobox(selectbox){
				var i;
				for(i = selectbox.options.length - 1 ; i >= 1 ; i--)
				{
					selectbox.remove(i);
				}
			}


			function Cambio_Estado_Botones2(){
				var id_parametro_seleccionado2= document.getElementById("id_parametro_seleccionado2").value;		
				if(id_parametro_seleccionado2==0){		
					document.getElementById('id_select_unidad2').disabled=true;						
					$('#id_parametro_seleccionado2').val('').selectpicker('refresh');
					$('#id_select_unidad2').val('').selectpicker('refresh');		

				}else{	
					RemoverDataCombobox(document.getElementById('id_select_unidad2'));
					Cargar_Unidades2();			
					document.getElementById('id_select_unidad2').disabled=false;					
					$('#id_select_unidad2').val('').selectpicker('refresh');
				}		
			}	


			function Habilitar_Botones_Unidad2(){
				var id_select_unidad2= document.getElementById("id_select_unidad2").value;		

				if(id_select_unidad2==0){	
					$('#id_select_unidad2').val('').selectpicker('refresh');				
				}
			}

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
			function Cargar_Parametros2(){
				$el =$('#id_parametro_seleccionado2');			

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

						var options = $('.id_parametro_seleccionado2 option');
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

			function Cargar_Unidades2(){
				$el =$('#id_select_unidad2');		
				var id_parametro_seleccionado= document.getElementById("id_parametro_seleccionado2").value;	
				var NombreVariable =$("#id_parametro_seleccionado2 option:selected").text();

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

						var options = $('.id_select_unidad2 option');
						var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
						arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
						options.each(function(i, o) {
							o.value = arr[i].v;
							$(o).text(arr[i].t);
						});
						
					}
				});
			}

			Cargar_Nombres_Formularios();


// Validacion del registro del detalle formulario
function Validar_Registro_Formulario_Detalle(){
	var reg_Parametros_Control =document.getElementById("id_parametro_seleccionado").value;	
	var reg_unidad= document.getElementById("id_select_unidad").value;	
	
	if(reg_Parametros_Control==0){	
		$("#id_validacion3").css("fontSize", 15);						
		$("#id_validacion3").css("font-weight","Bold"); 	
		$("#estilo_mensaje3").attr("class", "panel panel-danger");
		$('#estilo_mensaje3').show();			
		$('#id_validacion3').html('Es obligatorio seleccionar un parametro.');
		$('#id_validacion3').show();	
		$('#reg_Parametros_Control').val('');		
		$('#id_parametro_seleccionado').selectpicker('toggle');		
		$('#Modal_Registro_Detalle').scrollTop(0);
		return true;
	}else{		
		if(reg_unidad==0){			
			$("#id_validacion3").css("fontSize", 15);						
			$("#id_validacion3").css("font-weight","Bold"); 	
			$("#estilo_mensaje3").attr("class", "panel panel-danger");
			$('#estilo_mensaje3').show();			
			$('#id_validacion3').html('Es obligatorio seleccionar un tipo de unidad.');
			$('#id_validacion3').show();	
			$('#reg_unidad').val('');			
			$('#id_select_unidad').selectpicker('toggle');		
			$('#Modal_Registro_Detalle').scrollTop(0);
			return true;
		}else{
			$('#estilo_mensaje3').hide();	
			$('#id_validacion3').hide();	
			$('#ModalConfirmar_Detalle_Registro').modal('show');
			return false;
		}	
	}
}

$('.BtnRegistrarNuevoDetalleFormulario').click(function(){

	var reg_Parametros_Control= document.getElementById("id_parametro_seleccionado").value;
	var reg_unidad= document.getElementById("id_select_unidad").value;
	var reg_porcentaje_minimo= $('#reg_porcentaje_minimo').val();	
	var reg_alarma= $('#reg_alarma').val();
	var reg_disparo= $('#reg_disparo').val();
	var id_formulario_mostrar= document.getElementById("id_formulario_mostrar").value;
	var Ultimo_id_version_Nuevo_Registro= $('#Ultimo_id_version_Nuevo_Registro').val();

	$.ajax({
		type:'GET',
		data: {
			'reg_Parametros_Control' 		: reg_Parametros_Control,
			'reg_porcentaje_minimo' 		: reg_porcentaje_minimo,
			'reg_unidad' 					: reg_unidad,
			'reg_alarma' 					: reg_alarma,
			'reg_disparo' 					: reg_disparo,
			'Ultimo_id_version_Nuevo_Registro' : Ultimo_id_version_Nuevo_Registro,
			'id_formulario_mostrar' 		: id_formulario_mostrar 
		},
		url:'{{ url('Registrar_Nuevo_Detalle_Formulario')}}',
		success: function(respuesta){      
			if(respuesta==0){					  
				$('#ModalConfirmar_Detalle_Registro').modal('hide');
				$('#Modal_Registro_Detalle').modal('hide');	
				$("#estilo_mensaje_registro").attr("class", "panel panel-success");
				$('#id_validacion_registro').html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> Se ha creado exitosamente un nuevo detalle.');
				$("#id_validacion_registro").css("fontSize", 15);						
				$("#id_validacion_registro").css("font-weight","Bold"); 		
				$('#estilo_mensaje_registro').show();
				$('#id_validacion_registro').show();
				$('#Modal_VerPerfil_Usuario').scrollTop(0);
				$("#estilo_mensaje_registro").fadeTo(4500, 500).slideUp(500, function(){
					$("#estilo_mensaje_registro").hide();
					$( ".BtnEliminarDetalle" ).prop( "disabled", false );
					$( ".BtnActualizarDetalle" ).prop( "disabled", false );
					$( ".BtnRegistrarNuevaVersionFormulario" ).prop( "disabled", false );					
				});				
				Cargar_Tabla();				
			}			
		}		
	});
});


function LimpiarDatosNuevoDetalle(){
	$('#reg_Parametros_Control').val('');
	$('#reg_porcentaje_minimo').val('');
	$('#reg_unidad').val('');
	$('#reg_alarma').val('');
	$('#reg_disparo').val('');
}
$('body').delegate('.BtnEliminarDetalle','click',function(){	

	var id_eliminar_registro =($(this).attr('id_eliminar_registro'));
	$('#id_registro_detalle_eliminar').val(id_eliminar_registro);
	$('#ModalConfirmar_Eliminar_Detalle_Registro').modal('show');	
});

$('.BtnEliminarRegistroDetalle').click(function(){
	var id_registro_detalle_eliminar=$('#id_registro_detalle_eliminar').val();

	$.ajax({
		type:'GET',
		data: {
			'id_registro_detalle_eliminar' 		: id_registro_detalle_eliminar			
		},
		url:'{{ url('Eliminar_Registro_Detalle_Formulario')}}',
		success: function(respuesta){      
			if(respuesta==0){
				$( ".BtnEliminarDetalle" ).prop( "disabled", true );
				$('#ModalConfirmar_Eliminar_Detalle_Registro').modal('hide');	
				$("#estilo_mensaje_registro").attr("class", "panel panel-danger");
				$('#id_validacion_registro').html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> Se ha eliminado exitosamente el registro.');
				$("#id_validacion_registro").css("fontSize", 15);						
				$("#id_validacion_registro").css("font-weight","Bold"); 		
				$('#estilo_mensaje_registro').show();
				$('#id_validacion_registro').show();
				$('#Modal_VerPerfil_Usuario').scrollTop(0);
				$("#estilo_mensaje_registro").fadeTo(4500, 500).slideUp(500, function(){
					$("#estilo_mensaje_registro").hide();
					$( ".BtnEliminarDetalle" ).prop( "disabled", false );
					$( ".BtnActualizarDetalle" ).prop( "disabled", false );
					$( ".BtnRegistrarNuevaVersionFormulario" ).prop( "disabled", false );
				});				
				Cargar_Tabla();	
				subir();			
			}			
		}		
	});
});

function subir() {
	$("html, body").animate({ scrollTop: 0 }, "slow");
	return false;
}


function RemoverDataCombobox(selectbox)
{
	var i;
	for(i = selectbox.options.length - 1 ; i >= 1 ; i--)
	{
		selectbox.remove(i);
	}
}	

function Consultar_Formulario(){

	Cargar_Tabla();	
	
	var id_formulario_mostrar= document.getElementById("id_formulario_mostrar").value;	
	if(id_formulario_mostrar==0){
		$('.btnNuevoRegistroDetalle').hide();
		$('.Editar_Encabezado_Formulario').hide()		
		$('.NuevoFormulario').show();			
	}else{		
		$('.NuevoFormulario').hide();
		$('.btnNuevoRegistroDetalle').show();
		$('.Editar_Encabezado_Formulario').show();			
		Tiempo_Inactividad=setTimeout('$( ".BtnEliminarDetalle" ).prop( "disabled", false );$( ".BtnActualizarDetalle" ).prop( "disabled", false );$( ".BtnRegistrarNuevaVersionFormulario" ).prop( "disabled", false );',500);
	}


}

function Cargar_Tabla(){	

	var id_formulario_mostrar= document.getElementById("id_formulario_mostrar").value;

	var _token=$('#_token').val();
	$.ajax({
		type:'POST',
		data: {
			'_token' : _token,
			'id_formulario_mostrar' : id_formulario_mostrar				
		},
		url:'{{ url('Listar_tabla_formularios_seleccioandos')}}',
		success: function(data){      
			$('#id_tabla_mostrar').empty().html(data);			
		}
	});
}

function Cargar_Nombres_Formularios(){
	RemoverDataCombobox(document.getElementById("id_formulario_mostrar"));
	$el =$('#id_formulario_mostrar');		

	var _token=$('#_token').val();
	$.ajax({
		url   : "<?= URL::to('Listar_Nombres_Formularios') ?>",
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

			var options = $('id_formulario_mostrar option');
			var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
			arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
			options.each(function(i, o) {
				o.value = arr[i].v;
				$(o).text(arr[i].t);
			});	
		}

	});
}
// Llama el combox para los equipos
function Cargar_Nombres_Equipos(){
	RemoverDataCombobox(document.getElementById("id_nombre_equipo"));
	RemoverDataCombobox(document.getElementById("id_nombre_equipo_editar"));

	$el =$('#id_nombre_equipo');
	$el2 =$('#id_nombre_equipo_editar');			

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

			var options = $('id_nombre_equipo option');
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

			var options2 = $('id_nombre_equipo_editar option');
			var arr2 = options2.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
			arr2.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
			options2.each(function(i, o) {
				o.value = arr2[i].v;
				$(o).text(arr2[i].t);
			});	
		}

	});
}

$('.NuevoFormulario').click(function(){
	Cargar_Nombres_Equipos();
	$('#id_nombre_equipo').val('').selectpicker('refresh');	
	$('#Modal_Registro_Encabezado').modal('show');
});

function Validar_Registro_Formulario(){
	var patron =/[a-z/0-9]/;
	var Nombre_Nuevo_Formulario= $('#Nombre_Nuevo_Formulario').val();
	var id_nombre_equipo= document.getElementById("id_nombre_equipo").value;

	if(id_nombre_equipo==0){
		$("#id_validacion").css("fontSize", 15);						
		$("#id_validacion").css("font-weight","Bold"); 	
		$("#estilo_mensaje").attr("class", "panel panel-danger");
		$('#estilo_mensaje').show();			
		$('#id_validacion').html('Selecciona un maquina.');
		$('#id_validacion').show();	
		$('#id_nombre_equipo').val('');			      
		$('#id_nombre_equipo').selectpicker('toggle');
		$('#Modal_Registro_Encabezado').scrollTop(0);
		return true;
	}else{
		if(!patron.test(Nombre_Nuevo_Formulario)){
			$("#id_validacion").css("fontSize", 15);						
			$("#id_validacion").css("font-weight","Bold"); 	
			$("#estilo_mensaje").attr("class", "panel panel-danger");
			$('#estilo_mensaje').show();			
			$('#id_validacion').html('El nombre del formulario no puede estar vacío.');
			$('#id_validacion').show();	
			$('#Nombre_Nuevo_Formulario').val('');		
			document.getElementById("Nombre_Nuevo_Formulario").focus();
			$('#Modal_Registro_Encabezado').scrollTop(0);
			return true;
		}else{
			$('#id_validacion').hide();	
			$('#estilo_mensaje').hide();
			$('#ModalConfirmar').modal('show');
		}
	}
}



$('.BtnRegistrarNuevoFormulario').click(function(){
	var Nombre_Nuevo_Formulario= $('#Nombre_Nuevo_Formulario').val();
	var id_nombre_equipo= document.getElementById("id_nombre_equipo").value;
	$.ajax({
		type:'GET',
		data: {
			'Nombre_Nuevo_Formulario' 	: Nombre_Nuevo_Formulario,
			'id_nombre_equipo' 			: id_nombre_equipo
		},
		url:'{{ url('RegistraNuevoFormulario')}}',
		success: function(respuesta){      
			if(respuesta==0){ 
				Cargar_Nombres_Formularios();
				$('#id_formulario_mostrar').val('').selectpicker('refresh');	  
				$('#ModalConfirmar').modal('hide');
				$('#Modal_Registro_Encabezado').modal('hide');

				$("#estilo_mensaje_registro").attr("class", "panel panel-success");
				$('#id_validacion_registro').html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> Se ha registrado un nuevo formulario exitosamente el registro.');
				$("#id_validacion_registro").css("fontSize", 15);						
				$("#id_validacion_registro").css("font-weight","Bold"); 		
				$('#estilo_mensaje_registro').show();
				$('#id_validacion_registro').show();
				$('#Modal_VerPerfil_Usuario').scrollTop(0);
				$("#estilo_mensaje_registro").fadeTo(4500, 500).slideUp(500, function(){
					$("#estilo_mensaje_registro").hide();
					$( ".BtnEliminarDetalle" ).prop( "disabled", false );
					$( ".BtnActualizarDetalle" ).prop( "disabled", false );
					$( ".BtnRegistrarNuevaVersionFormulario" ).prop( "disabled", false );
				});			

			}
			if(respuesta.error==false){
				$('#ModalConfirmar').modal('hide');
				$('#id_validacion').html('');
				$.each(respuesta.errors,function(index, error){ 
					$('#estilo_mensaje').show();
					$("#id_validacion").css("fontSize", 15);						
					$("#id_validacion").css("font-weight","Bold"); 				
					$('#id_validacion').html('<strong>'+error+'</strong>');
					$('#id_validacion').show();
				}); 
			}
			if(respuesta==3){
				$('#ModalConfirmar').modal('hide');
				$("#id_validacion").css("fontSize", 15);						
				$("#id_validacion").css("font-weight","Bold");
				$("#estilo_mensaje").attr("class", "panel panel-danger");				
				$('#id_validacion').html('Error: Se encontró un formulario asociado a la maquina seleccionada. Por favor seleccione otra maquina.');
				$('#estilo_mensaje').show();
				$('#id_validacion').show();								
				$('#Modal_Registro_Encabezado').scrollTop(0);
				$("#estilo_mensaje").fadeTo(10000, 500).slideUp(500, function(){
					$("#estilo_mensaje").hide();
				});	

			}
		}		
	});
});

$('#btnNuevoRegistroDetalle').click(function(){
	LimpiarDatosNuevoDetalle();
	RemoverDataCombobox(document.getElementById('id_select_unidad'));
	RemoverDataCombobox(document.getElementById('id_parametro_seleccionado'));
	$('#id_select_unidad').val('').selectpicker('refresh');	
	$('#id_parametro_seleccionado').val('').selectpicker('refresh');
	Cargar_Parametros();
	Cambio_Estado_Botones();
	$('#Modal_Registro_Detalle').modal('show');
});

$('body').delegate('.BtnActualizarDetalle','click',function(){
	Cargar_Parametros2();
	Cambio_Estado_Botones2();
	var id_editar_registro =($(this).attr('id_editar_registro')); 
	var id_parametros_editar =($(this).attr('parametros_editar'));
	var Porcentaje_Minimo_editar =($(this).attr('porcentaje_minimo'));
	var unidad =($(this).attr('unidad'));
	var alarma =($(this).attr('alarma'));
	var disparo =($(this).attr('disparo'));
	$('select[name=id_parametro_seleccionado2]').val(id_parametros_editar);
	$('select[name=id_parametro_seleccionado2]').change();
	$('select[name=id_select_unidad2]').val(unidad);
	$('select[name=id_select_unidad2]').change();
	$('#Id_formulario_editar_registro').val(id_editar_registro);	
	$('#Porcentaje_Minimo_editar').val(Porcentaje_Minimo_editar);	
	$('#Alarma_editar').val(alarma);
	$('#Disparo_editar').val(disparo);
	$('#Modal_Editar_Registro').modal('show');
});

$('.BtnEditarRegistro').click(function(){
	$.ajax({
		url:'Confirmar_Edicion_ruta',
		data:new FormData($("#id_formulario_editar")[0]),
		dataType:'json',
		async:false,
		type:'post',
		processData: false,
		contentType: false,
		success:function(respuesta){
			if(respuesta==0){					
				$('#Modal_Confirmar_Editar_Registro').modal('hide');
				$('#Modal_Editar_Registro').modal('hide');		
				$("#estilo_mensaje_registro").attr("class", "panel panel-success");
				$('#id_validacion_registro').html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> Se ha actualizado exitosamente el registro.');
				$("#id_validacion_registro").css("fontSize", 15);						
				$("#id_validacion_registro").css("font-weight","Bold"); 		
				$('#estilo_mensaje_registro').show();
				$('#id_validacion_registro').show();
				$('#Modal_VerPerfil_Usuario').scrollTop(0);
				$("#estilo_mensaje_registro").fadeTo(4500, 500).slideUp(500, function(){
					$("#estilo_mensaje_registro").hide();
					$( ".BtnEliminarDetalle" ).prop( "disabled", false );
					$( ".BtnActualizarDetalle" ).prop( "disabled", false );
					$( ".BtnRegistrarNuevaVersionFormulario" ).prop( "disabled", false );
				});				
				Cargar_Tabla();	
				subir();
			}
			if(respuesta==1){					
				$('#Modal_Confirmar_Editar_Registro').modal('hide');
				$('#ID_Validacion_Editando_Detalle_Registro').html('');				
				$('#Estilo_Validacion_Editando_Detalle_Registro').show();
				$("#ID_Validacion_Editando_Detalle_Registro").css("fontSize", 15);	
				$('#ID_Validacion_Editando_Detalle_Registro').html('<strong>ERROR:</strong> No se encontró ningún cambio a modificar.');
				$('#ID_Validacion_Editando_Detalle_Registro').show();
				$("#Estilo_Validacion_Editando_Detalle_Registro").fadeTo(4500, 500).slideUp(500, function(){
					$("#Estilo_Validacion_Editando_Detalle_Registro").hide();
					
				}); 
			}	
			if(respuesta.error==false){					
				$('#Modal_Confirmar_Editar_Registro').modal('hide');
				$('#ID_Validacion_Editando_Detalle_Registro').html('');
				$.each(respuesta.errors,function(index, error){ 
					$('#Estilo_Validacion_Editando_Detalle_Registro').show();
					$("#ID_Validacion_Editando_Detalle_Registro").css("fontSize", 15);	
					$('#ID_Validacion_Editando_Detalle_Registro').html('<strong>ERROR:</strong>'+error);
					$('#ID_Validacion_Editando_Detalle_Registro').show();
					$("#Estilo_Validacion_Editando_Detalle_Registro").fadeTo(4500, 500).slideUp(500, function(){
						$("#Estilo_Validacion_Editando_Detalle_Registro").hide();
					}); 
				}); 
			}		
		}
	}); 					
});
// Crear nueva version Formulario
$('body').delegate('.BtnRegistrarNuevaVersionFormulario','click',function(){
	// var TotalRegistros =parseInt($(this).attr('TotalRegistros'));	
	$('#TextoConfirmarTotalRegistros').text('Esto hará que se desactive la versión actual y se genere una nueva versión del formulario.');
	$('#Modal_Confirmar_Nueva_Version_Formulario').modal('show');
});

$('.BtnNuevaVersionFormulario').click(function(){
	$.ajax({
		url:'CrearNuevaVersionFormulario',
		data:new FormData($("#id_formulario_principal")[0]),
		dataType:'json',
		async:false,
		type:'post',
		processData: false,
		contentType: false,
		success:function(respuesta){
			$('#Modal_Confirmar_Nueva_Version_Formulario').modal('hide');
			$("#estilo_mensaje_registro").attr("class", "panel panel-success");
			$('#id_validacion_registro').html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> Se ha creado una nueva versión del formulario.');
			$("#id_validacion_registro").css("fontSize", 15);						
			$("#id_validacion_registro").css("font-weight","Bold"); 		
			$('#estilo_mensaje_registro').show();
			$('#id_validacion_registro').show();
			$('#Modal_Editar_Encabezado_Formulario').scrollTop(0);
			$("#estilo_mensaje_registro2").fadeTo(4500, 500).slideUp(500, function(){
				$("#estilo_mensaje_registro").hide();	
				$( ".BtnEliminarDetalle" ).prop( "disabled", false );
				$( ".BtnActualizarDetalle" ).prop( "disabled", false );	
				$( ".BtnRegistrarNuevaVersionFormulario" ).prop( "disabled", false );		
			});	
			Cargar_Tabla();	
			subir();
		}
	}); 


}); 



function subir() {
	$("html, body").animate({ scrollTop: 0 }, "slow");
	return false;
}


// Valida edicion del formulario Detalle
function Validar_Editar_registro(){

	var reg_Parametros_Control =document.getElementById("id_parametro_seleccionado2").value;
	var reg_unidad= document.getElementById("id_select_unidad2").value;	

	if(reg_Parametros_Control==0){
		$("#Estilo_Validacion_Editando_Detalle_Registro").attr("class", "panel panel-danger");
		$('#Estilo_Validacion_Editando_Detalle_Registro').show();			
		$('#ID_Validacion_Editando_Detalle_Registro').html('Debes seleccionar un parametro.');	
		$('#ID_Validacion_Editando_Detalle_Registro').show();	
		$('#id_parametros_editar').val('');			      
		
		$('#id_parametro_seleccionado2').selectpicker('toggle');			
		return true;
	}else{
		if(reg_unidad==0){
			$("#Estilo_Validacion_Editando_Detalle_Registro").attr("class", "panel panel-danger");
			$('#Estilo_Validacion_Editando_Detalle_Registro').show();			
			$('#ID_Validacion_Editando_Detalle_Registro').html('Debes seleccionar una unidad.');	
			$('#ID_Validacion_Editando_Detalle_Registro').show();					      
			$('#id_select_unidad2').selectpicker('toggle');			
			return true;
		}else{						
			$('#Estilo_Validacion_Editando_Detalle_Registro').hide();
			$('#ID_Validacion_Editando_Detalle_Registro').html('');							
			$('#Modal_Confirmar_Editar_Registro').modal('show');
			return false;
		}
	}
}

$('.Editar_Encabezado_Formulario').click(function(){			
	Cargar_Nombres_Equipos();
	$('#id_nombre_equipo_editar').val('').selectpicker('refresh');
	var id_formulario_mostrar= document.getElementById("id_formulario_mostrar").value;

	var _token=$('#_token').val();
	$.ajax({
		url:'Consultar_Datos_Formulario_Editar',
		type  : "GET",
		async : false,
		data  :{
			'id_formulario_mostrar'  : id_formulario_mostrar
		},
		success:function(respuesta){
			$('select[name=id_nombre_equipo_editar]').val(respuesta.NombreEquipo);
			$('select[name=id_nombre_equipo_editar]').change();
			$('#Nombre_Formulario_Editar').val(respuesta.NombreFormulario);
			$('#id_nombre_equipo_editar_Oculto').val(respuesta.NombreEquipo);
			$('#Nombre_Formulario_Editar_Oculto').val(respuesta.NombreFormulario);
			$('#id_encabezado_oculto').val(respuesta.id_encabezado_oculto);			
		}
	});

	$('#Modal_Editar_Encabezado_Formulario').modal('show');
});

function Validar_Editar_Formulario_Encabezado(){
	var patron =/[a-z/0-9]/;
	var id_nombre_equipo_editar= document.getElementById("id_nombre_equipo_editar").value;
	var Nombre_Formulario_Editar=$('#Nombre_Formulario_Editar').val();


	if(id_nombre_equipo_editar==0){
		$("#id_validacion_registro2").css("fontSize", 15);						
		$("#id_validacion_registro2").css("font-weight","Bold"); 	
		$("#estilo_mensaje_registro2").attr("class", "panel panel-danger");
		$('#estilo_mensaje_registro2').show();			
		$('#id_validacion_registro2').html('Debes seleccionar un maquina.');
		$('#id_validacion_registro2').show();	
		$('#id_nombre_equipo_editar').val('');			      
		$('#id_nombre_equipo_editar').selectpicker('toggle');
		$('#Modal_Editar_Encabezado_Formulario').scrollTop(0);
		return true;
	}else{
		if(!patron.test(Nombre_Formulario_Editar)){
			$("#id_validacion_registro2").css("fontSize", 15);						
			$("#id_validacion_registro2").css("font-weight","Bold"); 	
			$("#estilo_mensaje_registro2").attr("class", "panel panel-danger");
			$('#estilo_mensaje_registro2').show();			
			$('#id_validacion_registro2').html('El nombre del formulario no puede estar vacío.');
			$('#id_validacion_registro2').show();
			$('#Nombre_Formulario_Editar').val('');		
			document.getElementById("Nombre_Formulario_Editar").focus();
			$('#Modal_Editar_Encabezado_Formulario').scrollTop(0);
			return true;
		}else{
			$('#estilo_mensaje_registro2').hide();
			$('#id_validacion_registro2').hide();
			$('#Modal_Confirmar_Editar_Encabezado').modal('show');
			return false;
		}
	}
}


$('.BtnEditarFormularioEncabezado').click(function(){
	var id_nombre_equipo_editar= document.getElementById("id_nombre_equipo_editar").value;
	var Nombre_Formulario_Editar=$('#Nombre_Formulario_Editar').val();
	var id_nombre_equipo_editar_Oculto=$('#id_nombre_equipo_editar_Oculto').val();
	var Nombre_Formulario_Editar_Oculto=$('#Nombre_Formulario_Editar_Oculto').val();
	var id_encabezado_oculto=$('#id_encabezado_oculto').val();

	$.ajax({
		url:'Editar_Emcabezado_Formulario',
		type  : "GET",
		async : false,
		data  :{
			'id_nombre_equipo_editar'  : id_nombre_equipo_editar,
			'Nombre_Formulario_Editar' : Nombre_Formulario_Editar,
			'id_nombre_equipo_editar_Oculto' : id_nombre_equipo_editar_Oculto,
			'Nombre_Formulario_Editar_Oculto' : Nombre_Formulario_Editar_Oculto,
			'id_encabezado_oculto' : id_encabezado_oculto
		},
		success:function(respuesta){
			if(respuesta==0){				
				$('#Modal_Confirmar_Editar_Encabezado').modal('hide');
				$('#Modal_Editar_Encabezado_Formulario').modal('hide');		
				$("#estilo_mensaje_registro").attr("class", "panel panel-success");
				$('#id_validacion_registro').html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> Se ha actualizado exitosamente el Formulario.');
				$("#id_validacion_registro").css("fontSize", 15);						
				$("#id_validacion_registro").css("font-weight","Bold"); 		
				$('#estilo_mensaje_registro').show();
				$('#id_validacion_registro').show();
				$('#Modal_Editar_Encabezado_Formulario').scrollTop(0);
				$("#estilo_mensaje_registro").fadeTo(4500, 500).slideUp(500, function(){
					$("#estilo_mensaje_registro").hide();
					$( ".BtnEliminarDetalle" ).prop( "disabled", false );
					$( ".BtnActualizarDetalle" ).prop( "disabled", false );
					$( ".BtnRegistrarNuevaVersionFormulario" ).prop( "disabled", false );
				});	
				Cargar_Tabla();				
				Cargar_Nombres_Formularios();
				$('#id_formulario_mostrar').val('').selectpicker('refresh');	
				$('select[name=id_formulario_mostrar]').val(id_encabezado_oculto);
				$('select[name=id_formulario_mostrar]').change();
			}

			if(respuesta==3){
				$( "#Btn_Confirmar_ModificarEncabezado" ).prop( "disabled", true );			
				$('#Modal_Confirmar_Editar_Encabezado').modal('hide');
				$("#estilo_mensaje_registro2").attr("class", "panel panel-danger");
				$('#id_validacion_registro2').html('<i class="fa fa-thumbs-down" aria-hidden="true"></i> ERROR: No se encontró ningun cambio a modificar.');
				$("#id_validacion_registro2").css("fontSize", 15);						
				$("#id_validacion_registro2").css("font-weight","Bold"); 		
				$('#estilo_mensaje_registro2').show();
				$('#id_validacion_registro2').show();
				$('#Modal_Editar_Encabezado_Formulario').scrollTop(0);
				$("#estilo_mensaje_registro2").fadeTo(4500, 500).slideUp(500, function(){
					$("#estilo_mensaje_registro2").hide();	
					$( "#Btn_Confirmar_ModificarEncabezado" ).prop( "disabled", false );				
				});	
			}
			if(respuesta==4){
				$( "#Btn_Confirmar_ModificarEncabezado" ).prop( "disabled", true );	
				$('#Modal_Confirmar_Editar_Encabezado').modal('hide');
				$("#estilo_mensaje_registro2").attr("class", "panel panel-danger");
				$('#id_validacion_registro2').html('<i class="fa fa-thumbs-down" aria-hidden="true"></i> ERROR: El equipo seleccionado no esta disponible para este formulario.');
				$("#id_validacion_registro2").css("fontSize", 15);						
				$("#id_validacion_registro2").css("font-weight","Bold"); 		
				$('#estilo_mensaje_registro2').show();
				$('#id_validacion_registro2').show();
				$('#Modal_Editar_Encabezado_Formulario').scrollTop(0);
				$("#estilo_mensaje_registro2").fadeTo(4500, 500).slideUp(500, function(){
					$("#estilo_mensaje_registro2").hide();
					$( "#Btn_Confirmar_ModificarEncabezado" ).prop( "disabled", false );					
				});	
			}

			if(respuesta==5){
				$( "#Btn_Confirmar_ModificarEncabezado" ).prop( "disabled", true );
				$('#Modal_Confirmar_Editar_Encabezado').modal('hide');
				$("#estilo_mensaje_registro2").attr("class", "panel panel-danger");
				$('#id_validacion_registro2').html('<i class="fa fa-thumbs-down" aria-hidden="true"></i> ERROR: Se encontró un formulario con el mismo nombre ingresado.');
				$("#id_validacion_registro2").css("fontSize", 15);						
				$("#id_validacion_registro2").css("font-weight","Bold"); 		
				$('#estilo_mensaje_registro2').show();
				$('#id_validacion_registro2').show();
				$('#Modal_Editar_Encabezado_Formulario').scrollTop(0);
				$("#estilo_mensaje_registro2").fadeTo(4500, 500).slideUp(500, function(){
					$("#estilo_mensaje_registro2").hide();	
					$( "#Btn_Confirmar_ModificarEncabezado" ).prop( "disabled", false );				
				});	
			}
		}
	});

});


</script>

@stop