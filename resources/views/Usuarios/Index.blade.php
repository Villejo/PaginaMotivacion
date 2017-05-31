@extends('layouts.master')
@section('title')
Menú Usuarios
@stop
@section('content')
<div class="page-bar col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="{{URL::route('Index')}}">Inicio</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>			
			<a href="#">Usuarios</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li class="Modal_Registrar_Nuevo_Usuario">
			<i class="fa fa-user" aria-hidden="true"></i>
			<a href="#">Nuevo Usuario</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li class="RegistrarNuevoRol">
			<i class="fa fa-wrench" aria-hidden="true"></i>
			<a href="#">Nuevo Rol</a>	
			<i class="fa fa-angle-right"></i>		
		</li>
		<li class="BuscarUsuario">
			<i class="fa fa-search" aria-hidden="true"></i>
			<a href="#">Buscar Usuario</a>			
		</li>
	</ul>
</div>
<div class="alert alert-success" style="display: none;" id="Mensaje_Usuario_Registrado">
	<h3>
		<span class="fa fa-thumbs-up fa-2x"></span> 
		<strong>El Usuario se Registro con éxito..!!</strong>
	</h3>					
</div>
<div class="alert alert-success" style="display: none;" id="Mensaje_Usuario_Modificado">
	<h3>
		<span class="fa fa-thumbs-up fa-2x"></span> 
		<strong>El Usuario se Modifico con éxito..!!</strong>
	</h3>					
</div>
<div class="alert alert-success" style="display: none;" id="Mensaje_Usuario_Desactivado">
	<h3>
		<span class="fa fa-thumbs-up fa-2x"></span> 
		<strong>El Usuario se Desactivo con éxito..!!</strong>
	</h3>					
</div>
<div class="alert alert-success" style="display: none;" id="Mensaje_Usuario_Activado">
	<h3>
		<span class="fa fa-thumbs-up fa-2x"></span> 
		<strong>El Usuario se Activo con éxito..!!</strong>
	</h3>					
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div id="tabla_usuarios"></div>
</div>

<!-- Modal Nuevo Rol-->
<div class="modal fade" id="Modal_Nuevo_Rol" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#562502" face="Arial Black">
						<i class="fa fa-file-o fa-2x" aria-hidden="true"></i> REGISTRAR NUEVO ROL</font></strong>						
					</b>
				</h4>
			</div>
			<div class="modal-body">
				<table class="table table-user-information">
					<div class="row">						
						<tbody>	
							<div class="panel panel-danger" id="estilo_mensaje" tyle="display:none">
								<div class="panel-heading" id="id_validacion" style="display:none">
								</div>
							</div>
							<tr>
								<td>
									<i class="fa fa-briefcase"></i>							
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Nuevo Rol:</font></strong></b>
								</td>
								<td>
									<input type="text" name="nombre_nuevo_rol" id="nombre_nuevo_rol" class="form-control btn-circle"  placeholder="Ingrese el nombre del nuevo rol">
								</td>
							</tr>							
						</tbody>
					</div>					
				</table>				
				<div id="Tabla_Roles_Registrados"></div>				
				<div class="modal-footer">
					<button type="button" onclick="Registrar_Nuevo_Rol();"  class="btn btn-circle" style="background-color: #562502" title="Registrar">
						<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>REGISTRAR</span>
							<span class="fa fa-plus-square"></span>
						</font></strong>
					</button>
					<button type="button" class="btn btn-circle CerrarMensaje" data-dismiss="modal" style="background-color: #fc0019" title="Cancelar">
						<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>CANCELAR</span>
							<span class="fa fa-times"></span>
						</font></strong>
					</button>					
				</div>
			</div>		
		</div>
	</div>
</div>
<!-- Termina Modal Registro Asignacion -->

<!-- Modal Confirmacion Crear Rol-->
<div class="modal fade" id="Modal_Confirmar_Registrar_Rol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">					
				<h4 class="modal-title" id="myModalLabel">¿ Esta seguro de Registrar el rol Ingresado ?</h4>
				<input type="hidden" name="IdNotificacion" id="IdNoti" class="form-control">
			</div>					
			<div class="modal-footer">
				<button type="button" class="btn btn-primary RegistrarRol">SI</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>					
			</div>
		</div>
	</div>
</div>
<!--  Termina Modal Confirmacion Crear Rol-->

<!-- Modal Confirmacion Eliminar Rol-->
<div class="modal fade" id="Modal_Confirmar_Eliminar_Rol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">					
				<h4 class="modal-title" id="myModalLabel">¿ Esta seguro de eliminar el rol: <b><strong> <font size ="2", color="#562502" face="Arial Black"><label id="NombreRolEliminar"></label></font></strong></b>?.
					<input type="hidden" id="Id_Rol_Delete" />
				</h4>
			</div>					
			<div class="modal-footer">
				<button type="button" class="btn btn-circle EliminarRol" style="background-color: #562502" title="Si">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>SI</span>
						<span class="fa fa-plus-square"></span>
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
<!--  Termina Modal Confirmacion Eliminar Rol-->

<!-- Empieza Modal Editar Rol-->
<div class="modal fade" id="Modal_Editar_Rol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">					
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#562502" face="Arial Black">
						<i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i> MODIFICAR ROL</font></strong>						
					</b>
				</h4>				
			</div>
			<div class="modal-body">
				<div class="panel panel-danger" id="estilo_mensaje_editar" tyle="display:none">
					<div class="panel-heading" id="id_validacion_editar" style="display:none">
					</div>
				</div>
				<input type="text" name="NombreEditarRol" id="NombreEditarRol" class="form-control btn-circle">
				<input type="hidden" name="NombreEditarRol_Oculto" id="NombreEditarRol_Oculto" class="form-control">
				
				<input type="hidden" name="id_rol_editar_oculto" id="id_rol_editar_oculto" class="form-control">
			</div>					
			<div class="modal-footer">
				<button type="button" class="btn btn-circle" style="background-color: #562502" title="Si" onclick="Modificar_Rol();">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>SI</span>
						<span class="fa fa-plus-square"></span>
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
<!--  Termina Modal Editar Rol-->

<!-- Modal Confirmacion Eliminar Rol-->
<div class="modal fade" id="Modal_Confirmar_Editar_Rol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">					
				<h4 class="modal-title" id="myModalLabel">¿ Esta seguro de editar el rol ingresado?.					
				</h4>
			</div>					
			<div class="modal-footer">
				<button type="button" class="btn btn-circle ModificarRol" style="background-color: #562502" title="SI">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>SI</span>
						<span class="fa fa-plus-square"></span>
					</font></strong>
				</button>
				<button type="button" class="btn btn-circle" data-dismiss="modal" style="background-color: #fc0019" title="NO">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>NO</span>
						<span class="fa fa-times"></span>
					</font></strong>
				</button>					
			</div>
		</div>
	</div>
</div>
<!--  Termina Modal Confirmacion Eliminar Rol-->

<!-- Modal Para Crear Nuevo Usuario -->
<div class="modal fade" id="Modal_Nuevo_Usuario" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#562502" face="Arial Black">
						<i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i> REGISTRAR NUEVO USUARIO</font></strong>						
					</b>
				</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-danger" style="display:none" id="estilo_mensaje_2">
					<div class="panel-heading" id="id_validacion_2" style="display:none">
					</div>
				</div>
				<table class="table table-user-information">
					<div class="row">						
						<tbody>	
							<div class="panel panel-danger" style="display:none" id="estilo_mensaje">
								<div class="panel-heading" id="id_validacion" style="display:none">
								</div>
							</div>
							<tr>
								<td>								
									<span class="badge btn-md btn-success" style="background: #562502;">
										<b>
											<strong>
												<font size ="2", color="#ffffff" face="Tahoma">
													<i class="fa fa-briefcase" aria-hidden="true"></i>	
													Seleccione Rol:
												</font>
											</strong>
										</b>
									</span>
								</td>
								<td>
									<select class="form-control selectpicker id_rol_registrar" data-live-search="true" id="id_rol_registrar" name="id_rol_registrar" autofocus>
										<option></option>
									</select>	
								</td>
							</tr>							
							<tr>
								<td>								
									<span class="badge btn-md btn-success" style="background: #562502;">
										<b>
											<strong>
												<font size ="2", color="#ffffff" face="Tahoma">
													<i class="fa fa-briefcase" aria-hidden="true"></i>	
													Codigo Usuario:
												</font>
											</strong>
										</b>
									</span>
								</td>
								<td>
									<input type="text" name="CodigoRegistrar" id="CodigoRegistrar" class="form-control btn-circle" placeholder="Ingresa Codigo de Usuario">
								</td>
							</tr>
							<tr>
								<td>
									<span class="badge btn-md btn-success" style="background: #562502;">
										<b>
											<strong>
												<font size ="2", color="#ffffff" face="Tahoma">
													<i class="fa fa-user" aria-hidden="true"></i>	
													Nombre Usuario:
												</font>
											</strong>
										</b>
									</span>
								</td>
								<td>
									<input type="text" name="NombreRegistrar" id="NombreRegistrar" class="form-control btn-circle" placeholder="Ingresa Nombre de Usuario">	
								</td>
							</tr>
							<tr>
								<td>								
									<span class="badge btn-md btn-success" style="background: #562502;">
										<b>
											<strong>
												<font size ="2", color="#ffffff" face="Tahoma">
													<i class="fa fa-user" aria-hidden="true"></i>	
													Apellido Usuario:
												</font>
											</strong>
										</b>
									</span>
								</td>
								<td>
									<input type="text" name="ApellidoRegistrar" id="ApellidoRegistrar" class="form-control btn-circle" placeholder="Ingresa Apellido Usuario">
								</td>
							</tr>
							<tr>
								<td>								
									<span class="badge btn-md btn-success" style="background: #562502;">
										<b>
											<strong>
												<font size ="2", color="#ffffff" face="Tahoma">
													<i class="fa fa-phone" aria-hidden="true"></i>
													Teléfono Usuario:
												</font>
											</strong>
										</b>
									</span>
								</td>
								<td>
									<input type="number" name="TelefonoRegistrar" id="TelefonoRegistrar" class="form-control btn-circle" placeholder="Ingresa Telefono Usuario">
								</td>
							</tr>
							<tr>
								<td>								
									<span class="badge btn-md btn-success" style="background: #562502;">
										<b>
											<strong>
												<font size ="2", color="#ffffff" face="Tahoma">
													<i class="fa fa-address-card-o" aria-hidden="true"></i>
													Dirección Usuario:
												</font>
											</strong>
										</b>
									</span>
								</td>
								<td>
									<input type="text" name="DireccionRegistrar" id="DireccionRegistrar" class="form-control btn-circle" placeholder="Ingresa Direccion Usuario">
								</td>
							</tr>
							<tr>
								<td>
									<span class="badge btn-md btn-success" style="background: #562502;">
										<b>
											<strong>
												<font size ="2", color="#ffffff" face="Tahoma">
													<i class="fa fa-envelope" aria-hidden="true"></i>
													Email Usuario:
												</font>
											</strong>
										</b>
									</span>
								</td>
								<td>
									<div class="col-sm-8">
										<input type="text" name="NombreCorreoRegistrar" id="NombreCorreoRegistrar" class="form-control btn-circle" placeholder="Ingresa Email Usuario">
									</div>									
									<label id="DatoCorreo">@TpmMovil.com</label>
									<input type="hidden" name="CorreoRegistrarOculto" id="CorreoRegistrarOculto">
								</td>
							</tr>
						</tbody>
					</div>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" onclick="Validar_Registro_Usuarios();"  class="btn btn-circle" style="background-color: #562502" title="Registrar">
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
</div>
<!-- Termina Modal Para Crear Nuevo Usuario -->
<!-- Modal Confirmacion Registrar Usuario-->
<div class="modal fade" id="Modal_Confirmar_Registrar_Usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">					
				<h4 class="modal-title" id="myModalLabel">¿ Esta seguro de registrar el usuario?					
				</h4>
			</div>					
			<div class="modal-footer">
				<button type="button" class="btn btn-circle RegistrarNuevoUsuario" style="background-color: #562502" title="Si">
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
<!--  Termina Modal Confirmacion Registrar Usuario-->

<!-- Modal Para Editar Usuario -->
<div class="modal fade" id="Modal_Editar_Usuario" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#562502" face="Arial Black">
						<i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i> MODIFICAR USUARIO</font></strong>						
					</b>
				</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="CodigoOculto" id="CodigoOculto">
				<input type="hidden" name="CorreoOculto" id="CorreoOculto">
				<input type="hidden" name="TelefonoOculto" id="TelefonoOculto">				
				<div class="panel panel-danger" style="display:none" id="estilo_mensaje_3">
					<div class="panel-heading" id="id_validacion_3" style="display:none">
					</div>
				</div>
				<table class="table table-user-information">
					<div class="row">						
						<tbody>	
							<div class="panel panel-danger" style="display:none" id="estilo_mensaje">
								<div class="panel-heading" id="id_validacion" style="display:none">
								</div>
							</div>
							<tr>
								<td>								
									<span class="badge btn-md btn-success" style="background: #562502;">
										<b>
											<strong>
												<font size ="2", color="#ffffff" face="Tahoma">
													<i class="fa fa-briefcase" aria-hidden="true"></i>	
													Seleccione Rol:
												</font>
											</strong>
										</b>
									</span>
								</td>
								<td>
									<select class="form-control selectpicker id_rol_editar" data-live-search="true" id="id_rol_editar" name="id_rol_editar" autofocus>
										<option></option>
									</select>	
								</td>
							</tr>
							<tr>
								<td>								
									<span class="badge btn-md btn-success" style="background: #562502;">
										<b>
											<strong>
												<font size ="2", color="#ffffff" face="Tahoma">
													<i class="fa fa-briefcase" aria-hidden="true"></i>	
													Codigo Usuario:
												</font>
											</strong>
										</b>
									</span>
								</td>
								<td>
									<input type="text" name="CodigoModificar" id="CodigoModificar" class="form-control btn-circle" placeholder="Ingresa Codigo de Usuario">
								</td>
							</tr>
							<tr>
								<td>
									<span class="badge btn-md btn-success" style="background: #562502;">
										<b>
											<strong>
												<font size ="2", color="#ffffff" face="Tahoma">
													<i class="fa fa-user" aria-hidden="true"></i>	
													Nombre Usuario:
												</font>
											</strong>
										</b>
									</span>
								</td>
								<td>
									<input type="text" name="NombreModificar" id="NombreModificar" class="form-control btn-circle" placeholder="Ingresa Nombre de Usuario">	
								</td>
							</tr>
							<tr>
								<td>								
									<span class="badge btn-md btn-success" style="background: #562502;">
										<b>
											<strong>
												<font size ="2", color="#ffffff" face="Tahoma">
													<i class="fa fa-user" aria-hidden="true"></i>	
													Apellido Usuario:
												</font>
											</strong>
										</b>
									</span>
								</td>
								<td>
									<input type="text" name="ApellidoModificar" id="ApellidoModificar" class="form-control btn-circle" placeholder="Ingresa Apellido Usuario">
								</td>
							</tr>
							<tr>
								<td>								
									<span class="badge btn-md btn-success" style="background: #562502;">
										<b>
											<strong>
												<font size ="2", color="#ffffff" face="Tahoma">
													<i class="fa fa-phone" aria-hidden="true"></i>
													Teléfono Usuario:
												</font>
											</strong>
										</b>
									</span>
								</td>
								<td>
									<input type="number" name="TelefonoModificar" id="TelefonoModificar" class="form-control btn-circle" placeholder="Ingresa Telefono Usuario">
								</td>
							</tr>
							<tr>
								<td>								
									<span class="badge btn-md btn-success" style="background: #562502;">
										<b>
											<strong>
												<font size ="2", color="#ffffff" face="Tahoma">
													<i class="fa fa-address-card-o" aria-hidden="true"></i>
													Dirección Usuario:
												</font>
											</strong>
										</b>
									</span>
								</td>
								<td>
									<input type="text" name="DireccionModificar" id="DireccionModificar" class="form-control btn-circle" placeholder="Ingresa Direccion Usuario">
								</td>
							</tr>
							<tr>
								<td>
									<span class="badge btn-md btn-success" style="background: #562502;">
										<b>
											<strong>
												<font size ="2", color="#ffffff" face="Tahoma">
													<i class="fa fa-envelope" aria-hidden="true"></i>
													Email Usuario:
												</font>
											</strong>
										</b>
									</span>
								</td>
								<td>
									<div class="col-sm-8">
										<input type="text" name="NombreCorreoModificar" id="NombreCorreoModificar" class="form-control btn-circle" placeholder="Ingresa Email Usuario">
									</div>

									<label id="DatoCorreo">@TpmMovil.com</label>
									<input type="hidden" name="CorreoModificarOculto" id="CorreoModificarOculto">
								</div>
							</td>
						</tr>
					</tbody>
				</div>
			</table>
		</div>	
		<div class="modal-footer">
			<button type="button" onclick="Validar_Modificar_Usuarios();"  class="btn btn-circle" style="background-color: #562502" title="Modificar">
				<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>MODIFICAR</span>
					<span class="fa fa-pencil-square"></span>
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
</div>
<!-- Termina Modal Para Editar Usuario -->

<!-- Modal Confirmacion Registrar Usuario-->
<div class="modal fade" id="Modal_Confirmar_Modificar_Usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">					
				<h4 class="modal-title" id="myModalLabel">¿ Esta seguro de modificar el usuario?	
				</h4>
			</div>					
			<div class="modal-footer">
				<button type="button" class="btn btn-circle EditarUsuario" style="background-color: #562502" title="Si">
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
<!--  Termina Modal Confirmacion Registrar Usuario-->

<!-- Modal Para Desactivar Usuario -->
<div class="modal fade" id="Modal_Desactivar_Usuario" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#562502" face="Arial Black">
						<i class="fa fa-bell-slash fa-2x" aria-hidden="true"></i> DESACTIVAR USUARIO</font></strong>						
					</b>
				</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id_usuario_desactivar" id="id_usuario_desactivar">				
				<table class="table table-user-information">
					<div class="row">						
						<tbody>	
							<div class="panel panel-danger" style="display:none" id="estilo_mensaje">
								<div class="panel-heading" id="id_validacion" style="display:none">
								</div>
							</div>
							<div class="col-sm-5">
								<center><img id="Foto_Desactivar_Usuario" width="100" height="100" border="5"/></center>
								<center>
									<span class="badge btn-md btn-success" style="background: #562502;">
										<b>
											<strong>
												<font size ="2">
													<label id="Rango_Usuario_Desactivar"></label>
												</font>
											</strong>
										</b>
									</span>
								</center>
							</div>								
							<center>
								<br>
								<br>
								¿Esta seguro de Desactivar el Usuario?
								<br>
								<br>
								<label id="NombreUsuarioDesactivar"></label>
								<br>
								<br>
								<br>
								<span class="help-block">Nota:Al desactivar el usuario quedara inactivo de forma permanente.</span>
							</center>							
						</tbody>
					</div>
				</table>
			</div>	
			<div class="modal-footer">
				<button type="button" onclick="Desactivar_Usuario();"  class="btn btn-circle" style="background-color: #562502" title="Desactivar Usuario">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>SI</span>
						<span class="fa fa-check"></span>
					</font></strong>
				</button>
				<button type="button" class="btn btn-circle" data-dismiss="modal" style="background-color: #fc0019" title="Cancelar">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>NO</span>
						<span class="fa fa-times"></span>
					</font></strong>
				</button>					
			</div>
		</div>		
	</div>
</div>
</div>
<!-- Termina Modal Para Desactivar Usuario -->

<!-- Modal Para Activar Usuario -->
<div class="modal fade" id="Modal_Activar_Usuario" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#562502" face="Arial Black">
						<i class="fa fa-bell fa-2x" aria-hidden="true"></i> ACTIVAR USUARIO</font></strong>						
					</b>
				</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="Id_Usuario_Activar" id="Id_Usuario_Activar">				
				<table class="table table-user-information">
					<div class="row">						
						<tbody>	
							<div class="panel panel-danger" style="display:none" id="estilo_mensaje">
								<div class="panel-heading" id="id_validacion" style="display:none">
								</div>
							</div>
							<div class="col-sm-5">
								<center><img id="Foto_Activar_Usuario" width="100" height="100" border="5"/></center>
								<center>
									<span class="badge btn-md btn-success" style="background: #562502;">
										<b>
											<strong>
												<font size ="2">
													<label id="Rango_Usuario_Activar""></label>
												</font>
											</strong>
										</b>
									</span>
								</center>
							</div>								
							<center>
								¿Esta seguro de Activar el Usuario?
								<br>
								<br>
								<label id="NombreUsuarioActivar"></label>
								<br>
								<br>								
							</center>							
						</tbody>
					</div>
				</table>
			</div>	
			<div class="modal-footer">
				<button type="button" onclick="Activar_Usuario();"  class="btn btn-circle" style="background-color: #562502" title="Desactivar Usuario">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>SI</span>
						<span class="fa fa-check"></span>
					</font></strong>
				</button>
				<button type="button" class="btn btn-circle" data-dismiss="modal" style="background-color: #fc0019" title="Cancelar">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>NO</span>
						<span class="fa fa-times"></span>
					</font></strong>
				</button>					
			</div>
		</div>		
	</div>
</div>
</div>
<!-- Termina Modal Para Activar Usuario -->

<!-- Modal Para Buscar Usuario -->
<div class="modal fade" id="Modal_Buscar_Usuario" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">	

				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#562502" face="Arial Black">
						<i class="fa fa-search fa-2x" aria-hidden="true"></i> BUSCAR USUARIO</font></strong>						
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
							Selecciona el usuario a buscar:
							<br>
							<br>
							<select class="form-control selectpicker id_usario_buscar" data-live-search="true" id="id_usario_buscar" name="id_usario_buscar" onchange="Cargar_Tabla_Consultada_Usuarios();" autofocus>
								<option></option>
							</select>
						</tbody>
					</div>
				</table>
				<button class="btn btn-success" data-dismiss="modal">Cerrar</button>
			</div>

		</div>		
	</div>
</div>
</div>
<!-- Termina Modal Para Buscar Usuario -->

<!-- Modal Para Ver Perfil Usuario -->


<!-- Modal -->
<div class="modal fade" id="Modal_VerPerfil_Usuario" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="pull-right">
					<button type="button" data-dismiss="modal" >X</button>
				</div>
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="2", color="#562502" face="Arial Black">
						<i class="fa fa-user fa-2x" aria-hidden="true"></i> USUARIO</font></strong>		
					</b>
					<font color="#0481a0" face="Arial Black">
						<label id="NombreUsuarioPerfil"></label>
					</font>					
				</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-danger" style="display:none" id="estilo_mensaje5">
					<div class="panel-heading" id="id_validacion5" style="display:none">
					</div>
				</div>
				<div class="row">					
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">			
						<table class="table table-user-information">									
							<tbody>							
								<tr>
									<td>
										<center><img id="FotoUsuarioPerfil" width="100" height="100" border="5"/></center>
										<center>
											<span class="badge btn-md btn-success" style="background: #562502;">
												<b>
													<strong>
														<font size ="2">
															<label id="RangoUsuarioPerfil"></label>
														</font>
													</strong>
												</b>
											</span>
										</center>	
									</td>	
								</tr>
							</tbody>	
						</table>
					</div>
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
						<table class="table table-user-information">									
							<tbody>							
								<tr>
									<td>
										<input type="hidden" name="id_password_restablecer_usuario" id="id_password_restablecer_usuario">																
										<b>
											<font size ="2", color="#562502" face="Tahoma">
												<i class="fa fa-briefcase" aria-hidden="true" title="Codigo"></i>
											</font>												
											<strong>
												<font color="#000000" face="Arial">
													<label id="CodigoUsuarioPerfil"></label>
												</font>
											</strong>
										</b>
									</td>								
								</tr>
								<tr>								
									<td>								
										<b>
											<font size ="2", color="#562502" face="Tahoma">
												<i class="fa fa-phone-square" aria-hidden="true" title="Telefono Usuario"></i>
											</font>
											<strong>
												<font color="#000000" face="Arial">
													<label id="TelefonoUsuarioPerfil"></label>
												</font>
											</strong>
										</b>
									</td>								
								</tr>
								<tr>								
									<td>								
										<b>
											<font size ="2", color="#562502" face="Tahoma">
												<i class="fa fa-address-card" aria-hidden="true" title="Direccion Usuario"></i>
											</font>
											<strong>
												<font color="#000000" face="Arial">
													<label id="DireccionUsuarioPerfil"></label>
												</font>
											</strong>
										</b>
									</td>								
								</tr>
								<tr>								
									<td>								
										<b>
											<font size ="2", color="#562502" face="Tahoma">
												<i class="fa fa-envelope" aria-hidden="true" title="Correo Usuario"></i>
											</font>
											<strong>
												<font color="#000000" face="Arial">
													<label id="DireccionEmailUsuarioPerfil"></label>
												</font>
											</strong>
										</b>
									</td>								
								</tr>
								<tr>								
									<td>								
										<b>
											<font size ="2", color="#562502" face="Tahoma">
												<i class="fa fa-bell" aria-hidden="true" title="Estado Usuario"></i>
											</font>
											<strong>
												<font color="#000000" face="Arial">
													<label id="EstadoUsuarioPerfil"></label>	
												</font>
											</strong>
										</b>
									</td>
								</tr>
								<tr>								
									<td>								
										<b>
											<font size ="2", color="#562502" face="Tahoma">
												<i class="fa fa-refresh" aria-hidden="true" title="Restablecer Password"></i> 
											</font>
											<label id="TextoRestablecer"></label>
											<button type="button" class="btn btn-circle" onclick="RestablecerPassword();" style="background-color: #fc0019" title="Restablecer Password">
												<strong> <font size ="1", color ="#ffffff" face="Lucida Sans"><span></span>
													<span class="fa fa-refresh"></span>
												</font></strong>
											</button>											
										</b>
									</td>
								</tr>
							</tbody>
						</table>
					</div>					
				</div>
				<div id="Tabla_Conexion_Usuarios">					
				</div>
			</div> 		
		</div>		
	</div>
</div>
</div>
<!-- Termina Modal Para Ver Perfil Usuario -->

<!-- Modal Confirmacion Restablecer Password Usuario-->
<div class="modal fade" id="Modal_Confirmar_Restablecer_Password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">					
				<h4 class="modal-title" id="myModalLabel">¿ Esta seguro de restablecer el password del usuario?	
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
{{Form::input("hidden", "_token", csrf_token())}}

<script type="text/javascript">

	// Empieza Todo lo de Roles
	Cargar_Tabla();
	Tabla_Roles_Registrados();

	function Modificar_Rol(){
		var patron =/[a-z]/;
		var NombreEditarRol=$('#NombreEditarRol').val();

		if(!patron.test(NombreEditarRol)){
			$("#estilo_mensaje_editar").attr("class", "panel panel-danger");
			$('#estilo_mensaje_editar').show();			
			$('#id_validacion_editar').html('El campo no puede estar vacío y solo se permiten letras en minúsculas.');	
			$('#id_validacion_editar').show();	
			$('#NombreEditarRol').val('');			      
			document.getElementById("NombreEditarRol").focus();
			$('#Modal_Nuevo_Rol').scrollTop(0);
			return true;
		}else{
			$('#estilo_mensaje_editar').hide();
			$('#id_validacion_editar').html('');
			cadena=$('#NombreEditarRol').val();  
			cadena=cadena.trim();
			$('#NombreEditarRol').val(cadena);	
			$('#Modal_Confirmar_Editar_Rol').modal('show');
			return false;
		}
	}
	// Convetir Primera Letra em Mayuscula
	String.prototype.ucfirst = function(){
		return this.charAt(0).toUpperCase() + this.substr(1);
	}
	$('body').delegate('.Edit_Rol','click',function(){					
		var NombreEditarRol =($(this).attr('NombreRolEdit'));
		var id_rol_editar_oculto =($(this).attr('id_Rol_Edit'));


		$('#NombreEditarRol').val(NombreEditarRol.ucfirst());	
		$('#NombreEditarRol_Oculto').val(NombreEditarRol);	
		$('#id_rol_editar_oculto').val(id_rol_editar_oculto);		
		$('#Modal_Editar_Rol').modal('show');
	});


	$('.ModificarRol').click(function(){
		var id_rol_editar_oculto =$('#id_rol_editar_oculto').val();
		var NombreEditarRol =$('#NombreEditarRol').val();
		var NombreEditarRol_Oculto =$('#NombreEditarRol_Oculto').val()
		$.ajax({
			type:'GET',
			data: {
				'id_rol_editar_oculto' 		: id_rol_editar_oculto,
				'NombreEditarRol' 	   		: NombreEditarRol,
				'NombreEditarRol_Oculto' 	: NombreEditarRol_Oculto
			},
			url:'{{ url('EditarRol')}}',
			success: function(data){      
				if(data==0){   
					$('#Modal_Confirmar_Editar_Rol').modal('hide');
					$('#Modal_Editar_Rol').modal('hide');
					$("#estilo_mensaje").attr("class", "panel panel-success");
					$('#id_validacion').html('El rol fue editado con éxito.!');
					$("#id_validacion").css("fontSize", 15);						
					$("#id_validacion").css("font-weight","Bold"); 		
					$('#estilo_mensaje').show();
					$('#id_validacion').show();
					Tabla_Roles_Registrados();
					LimpiarDatos();
					$("#nombre_nuevo_rol").focus();
					$('#Modal_Nuevo_Rol').scrollTop(0);
					$("#estilo_mensaje").fadeTo(4500, 500).slideUp(500, function(){
						$("#estilo_mensaje").hide();
					});
				}				
				if(data==1){   
					$('#Modal_Confirmar_Editar_Rol').modal('hide');					
					$("#estilo_mensaje_editar").attr("class", "panel panel-danger");
					$('#id_validacion_editar').html('Error: No se encontró ningun cambio a modificar!');
					$("#id_validacion_editar").css("fontSize" ,15);						
					$("#id_validacion_editar").css("font-weight","Bold"); 		
					$('#estilo_mensaje_editar').show();
					$('#id_validacion_editar').show();					
					$("#nombre_nuevo_rol").focus();
					$('#Modal_Nuevo_Rol').scrollTop(0);
					$("#estilo_mensaje_editar").fadeTo(4500, 500).slideUp(500, function(){
						$("#estilo_mensaje_editar").hide();
					});
				}
				if(data==2){   
					$('#Modal_Confirmar_Editar_Rol').modal('hide');					
					$("#estilo_mensaje_editar").attr("class", "panel panel-danger");
					$('#id_validacion_editar').html('Error: Se encontró un registro con el mismo nombre de rol.!');
					$("#id_validacion_editar").css("fontSize", 15);						
					$("#id_validacion_editar").css("font-weight","Bold"); 		
					$('#estilo_mensaje_editar').show();
					$('#id_validacion_editar').show();					
					$("#nombre_nuevo_rol").focus();
					$('#Modal_Nuevo_Rol').scrollTop(0);
					$("#estilo_mensaje_editar").fadeTo(4500, 500).slideUp(500, function(){
						$("#estilo_mensaje_editar").hide();
					});
				}
				
			}
		});
	});

	$('body').delegate('.Delete_Rol','click',function(){					
		var NombreRolEliminar =($(this).attr('NombreRolEliminar'));
		var Id_Rol_Delete =($(this).attr('Id_Rol_Delete'));	
		NombreRolEliminar = NombreRolEliminar.toUpperCase();
		$('#NombreRolEliminar').text(NombreRolEliminar);	
		$('#Id_Rol_Delete').val(Id_Rol_Delete);	
		$('#Modal_Confirmar_Eliminar_Rol').modal('show');
	});

	$('.EliminarRol').click(function(){
		var Id_Rol_Delete =$('#Id_Rol_Delete').val();
		$.ajax({
			type:'GET',
			data: {
				'Id_Rol_Delete' : Id_Rol_Delete
			},
			url:'{{ url('ElimiarRol')}}',
			success: function(data){      
				if(data==0){   
					$('#Modal_Confirmar_Eliminar_Rol').modal('hide');
					$("#estilo_mensaje").attr("class", "panel panel-success");
					$('#id_validacion').html('El rol fue eliminado con éxito.!');
					$("#id_validacion").css("fontSize", 15);						
					$("#id_validacion").css("font-weight","Bold"); 		
					$('#estilo_mensaje').show();
					$('#id_validacion').show();
					Tabla_Roles_Registrados();
					LimpiarDatos();
					$("#nombre_nuevo_rol").focus();
					$('#Modal_Nuevo_Rol').scrollTop(0);
					$("#estilo_mensaje").fadeTo(4500, 500).slideUp(500, function(){
						$("#estilo_mensaje").hide();
					});
				}
				if(data==3){   
					$('#Modal_Confirmar_Eliminar_Rol').modal('hide');
					$("#estilo_mensaje").attr("class", "panel panel-danger");
					$('#id_validacion').html('ERROR: El rol no se puede eliminar, ya que está siendo usado por usuarios.');
					$("#id_validacion").css("fontSize", 15);						
					$("#id_validacion").css("font-weight","Bold"); 		
					$('#estilo_mensaje').show();
					$('#id_validacion').show();
					Tabla_Roles_Registrados();
					LimpiarDatos();
					$("#nombre_nuevo_rol").focus();
					$('#Modal_Nuevo_Rol').scrollTop(0);
					$("#estilo_mensaje").fadeTo(5500, 500).slideUp(500, function(){
						$("#estilo_mensaje").hide();
					});
				}
			}
		});
	});

	function Cargar_Tabla(){
		var _token=$('#_token').val();
		$.ajax({
			type:'POST',
			data: {
				'_token' : _token
			},
			url:'{{ url('Tabla_Usuarios')}}',
			success: function(data){      
				$('#tabla_usuarios').empty().html(data);
			}
		});

		$(document).on("click",".pagination li a",function(e) {
			e.preventDefault();		
			var url = $(this).attr("href");
			$.ajax({
				type:'get',
				url:url,			
				success: function(data){
					$('#tabla_usuarios').empty().html(data);				
				}
			});
		});		
	}

	function Tabla_Roles_Registrados(){
		var _token=$('#_token').val();
		$.ajax({
			type:'POST',
			data: {
				'_token' : _token
			},
			url:'{{ url('Tabla_Roles_Registrados')}}',
			success: function(data){      
				$('#Tabla_Roles_Registrados').empty().html(data);
			}
		});		
	}

	$('.RegistrarNuevoRol').click(function(){
		LimpiarDatos();
		$('#Modal_Nuevo_Rol').modal('show');
	});

	function LimpiarDatos(){
		$('#nombre_nuevo_rol').val('');
		$('#estilo_mensaje').hide();
		// $('#id_validacion').html('');
		$('#nombre_nuevo_rol').focus();	
	}

	function Registrar_Nuevo_Rol(){
		var patron =/[a-z]/;
		var nombre_nuevo_rol=$('#nombre_nuevo_rol').val();

		if(!patron.test(nombre_nuevo_rol)){
			$("#id_validacion").css("fontSize", 15);						
			$("#id_validacion").css("font-weight","Bold"); 	
			$("#estilo_mensaje").attr("class", "panel panel-danger");
			$('#estilo_mensaje').show();			
			$('#id_validacion').html('El campo no puede estar vacío y solo se permiten letras en minúsculas.');	
			$('#id_validacion').show();	
			$('#nombre_nuevo_rol').val('');			      
			document.getElementById("nombre_nuevo_rol").focus();
			$('#Modal_Nuevo_Rol').scrollTop(0);
			return true;
		}else{
			$('#estilo_mensaje').hide();
			$('#id_validacion').html('');
			cadena=$('#nombre_nuevo_rol').val();  
			cadena=cadena.trim();
			$('#nombre_nuevo_rol').val(cadena);	
			$('#Modal_Confirmar_Registrar_Rol').modal('show');
			return false;
		}
	}

	$('.RegistrarRol').click(function(){
		var nombre_nuevo_rol =$('#nombre_nuevo_rol').val();	
		$.ajax({
			type:'GET',
			data: {
				'nombre_nuevo_rol' : nombre_nuevo_rol
			},
			url:'{{ url('RegistrarNuevoRol')}}',
			success: function(data){ 
				if(data==0){   
					$('#Modal_Confirmar_Registrar_Rol').modal('hide');
					$("#estilo_mensaje").attr("class", "panel panel-success");
					$('#id_validacion').html('El rol fue registrado con éxito.!');
					$("#id_validacion").css("fontSize", 15);						
					$("#id_validacion").css("font-weight","Bold"); 		
					$('#estilo_mensaje').show();
					$('#id_validacion').show();
					Tabla_Roles_Registrados();
					LimpiarDatos();
					$("#nombre_nuevo_rol").focus();
					$('#Modal_Nuevo_Rol').scrollTop(0);
					$("#estilo_mensaje").fadeTo(4500, 500).slideUp(500, function(){
						$("#estilo_mensaje").hide();
					});
				}
				if(data==3){	
					$('#Modal_Confirmar_Registrar_Rol').modal('hide');
					$("#estilo_mensaje").attr("class", "panel panel-danger");				
					$('#id_validacion').html('Error: Se encontró un registro con el mismo nombre.');
					$('#estilo_mensaje').show();
					$('#id_validacion').show();		
					$("#nombre_nuevo_rol").focus();				
					$('#Modal_Nuevo_Rol').scrollTop(0);
					$("#estilo_mensaje").fadeTo(4500, 500).slideUp(500, function(){
						$("#estilo_mensaje").hide();
					});					
				}
			}
		});	
	});

	$('.CerrarMensaje').click(function(){
		LimpiarDatos();
		Cargar_Tabla();		
	});
	

	function Cargar_Roles(){

		$el =$('#id_rol_registrar');
		$el2 =$('#id_rol_editar');


		$.ajax({
			url   : "<?= URL::to('Listar_Roles') ?>",
			type  : "GET",
			async : false,			
			success:function(re){
				var option = $('<option />');
				$.each(re, function(key,value) {
					$el.append($("<option></option>")
						.attr("value", key).text(value));
				});							

				var options = $('.id_rol_registrar option');
				var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});

				var option2 = $('<option />');
				$.each(re, function(key,value) {
					$el2.append($("<option></option>")
						.attr("value", key).text(value));
				});							

				var options2 = $('.id_rol_editar option');
				var arr2 = options2.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr2.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options2.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});
			}
		});
	}
// termina Todo lo de Roles

// Empieza Todo lo de usuarios
$('.Modal_Registrar_Nuevo_Usuario').click(function(){	
	Limpiar_Datos_Registro();
	$('#Modal_Nuevo_Usuario').modal('show');
});

function Validar_Registro_Usuarios(){
	var patron =/[a-z/0-9]/;
	var patron2=/^[A-Za-z\_\-\.\s\xF1\xD1]+$/;	
	var CodigoRegistrar= $('#CodigoRegistrar').val();
	var NombreRegistrar= $('#NombreRegistrar').val();
	var ApellidoRegistrar= $('#ApellidoRegistrar').val(); 
	var TelefonoRegistrar = $('#TelefonoRegistrar').val(); 
	var DireccionRegistrar= $('#DireccionRegistrar').val(); 
	var NombreCorreoRegistrar =  $('#NombreCorreoRegistrar').val();
	var DatoCorreo =  $('#DatoCorreo').text();	
	
	var id_rol_registrar= document.getElementById("id_rol_registrar").value;


	if(id_rol_registrar==0){
		$('#estilo_mensaje3').show();
		$("#id_validacion_2").css("fontSize", 15);						
		$("#id_validacion_2").css("font-weight","Bold"); 	
		$("#estilo_mensaje_2").attr("class", "panel panel-danger");
		$('#estilo_mensaje_2').show();			
		$('#id_validacion_2').html('Debes Seleccionar un Rol de Usuario.');
		$('#id_validacion_2').show();	
		$('#id_rol_registrar').val('');			      
		$('#id_rol_registrar').selectpicker('toggle');
		$('#Modal_Nuevo_Usuario').scrollTop(0);
		return true;
	}else{
		if(!patron.test(CodigoRegistrar)){
			$("#id_validacion_2").css("fontSize", 15);						
			$("#id_validacion_2").css("font-weight","Bold"); 	
			$("#estilo_mensaje_2").attr("class", "panel panel-danger");
			$('#estilo_mensaje_2').show();			
			$('#id_validacion_2').html('El codigo no puede estar vacío.');
			$('#id_validacion_2').show();	
			$('#CodigoRegistrar').val('');
			document.getElementById("CodigoRegistrar").focus();
			$('#Modal_Nuevo_Usuario').scrollTop(0);
			return true;
		}else{
			if(!patron.test(NombreRegistrar)){
				$("#id_validacion_2").css("fontSize", 15);						
				$("#id_validacion_2").css("font-weight","Bold"); 	
				$("#estilo_mensaje_2").attr("class", "panel panel-danger");
				$('#estilo_mensaje_2').show();			
				$('#id_validacion_2').html('El nombre no puede estar vacío.');
				$('#id_validacion_2').show();	
				$('#NombreRegistrar').val('');			      
				document.getElementById("NombreRegistrar").focus();
				$('#Modal_Nuevo_Usuario').scrollTop(0);
				return true;
			}else{
				if(!patron.test(ApellidoRegistrar)){
					$("#id_validacion_2").css("fontSize", 15);						
					$("#id_validacion_2").css("font-weight","Bold"); 	
					$("#estilo_mensaje_2").attr("class", "panel panel-danger");
					$('#estilo_mensaje_2').show();			
					$('#id_validacion_2').html('El apellido no puede estar vacío.');
					$('#id_validacion_2').show();	
					$('#ApellidoRegistrar').val('');			      
					document.getElementById("ApellidoRegistrar").focus();
					$('#Modal_Nuevo_Usuario').scrollTop(0);
					return true;
				}else{
					if(!patron.test(TelefonoRegistrar)){
						$("#id_validacion_2").css("fontSize", 15);						
						$("#id_validacion_2").css("font-weight","Bold"); 	
						$("#estilo_mensaje_2").attr("class", "panel panel-danger");
						$('#estilo_mensaje_2').show();			
						$('#id_validacion_2').html('El télefono no puede estar vacío.');
						$('#id_validacion_2').show();	
						$('#TelefonoRegistrar').val('');			      
						document.getElementById("TelefonoRegistrar").focus();
						$('#Modal_Nuevo_Usuario').scrollTop(0);
						return true;
					}else{
						if(!patron.test(DireccionRegistrar)){
							$("#id_validacion_2").css("fontSize", 15);						
							$("#id_validacion_2").css("font-weight","Bold"); 	
							$("#estilo_mensaje_2").attr("class", "panel panel-danger");
							$('#estilo_mensaje_2').show();			
							$('#id_validacion_2').html('La dirección no puede estar vacío.');
							$('#id_validacion_2').show();	
							$('#DireccionRegistrar').val('');			      
							document.getElementById("DireccionRegistrar").focus();
							$('#Modal_Nuevo_Usuario').scrollTop(0);
							return true;
						}else{
							if(!patron2.test(NombreCorreoRegistrar)){
								$("#id_validacion_2").css("fontSize", 15);						
								$("#id_validacion_2").css("font-weight","Bold"); 	
								$("#estilo_mensaje_2").attr("class", "panel panel-danger");
								$('#estilo_mensaje_2').show();			
								$('#id_validacion_2').html('El email no puede estar vacío, solo se permiten letras.');
								$('#id_validacion_2').show();	
								$('#NombreCorreoRegistrar').val('');			      
								document.getElementById("NombreCorreoRegistrar").focus();
								$('#Modal_Nuevo_Usuario').scrollTop(0);
								return true;
							}else{
								$('#CorreoRegistrarOculto').val(NombreCorreoRegistrar+DatoCorreo);
								$('#id_validacion_2').hide();
								$('#estilo_mensaje_2').hide();
								$('#Modal_Confirmar_Registrar_Usuario').modal('show');	
								return false;
							}
						}
					}
				}
			}
		}
	}
}

$('.RegistrarNuevoUsuario').click(function(){
	var CodigoRegistrar= $('#CodigoRegistrar').val();
	var NombreRegistrar= $('#NombreRegistrar').val();
	var ApellidoRegistrar= $('#ApellidoRegistrar').val(); 
	var TelefonoRegistrar = $('#TelefonoRegistrar').val(); 
	var DireccionRegistrar= $('#DireccionRegistrar').val(); 	
	var CorreoRegistrarOculto =  $('#CorreoRegistrarOculto').val();	
	var id_rol_registrar= document.getElementById("id_rol_registrar").value;

	$.ajax({
		type:'GET',
		data: {
			'CodigoRegistrar' 		: CodigoRegistrar,
			'NombreRegistrar' 		: NombreRegistrar,
			'ApellidoRegistrar' 	: ApellidoRegistrar,
			'TelefonoRegistrar' 	: TelefonoRegistrar,
			'DireccionRegistrar'	: DireccionRegistrar,
			'CorreoRegistrarOculto' : CorreoRegistrarOculto,
			'id_rol_registrar' 		: id_rol_registrar
		},
		url:'{{ url('RegistrarNuevoUsuario')}}',
		success: function(respuesta){      
			if(respuesta==0){   
				$('#Modal_Confirmar_Registrar_Usuario').modal('hide');
				$('#Modal_Nuevo_Usuario').modal('hide');
				$('#Mensaje_Usuario_Registrado').show();       
				$(document).ready (function(){  
					$('#ModalConfirmar').modal('hide');
					$("#Mensaje_Usuario_Registrado").hide(); 
					$("#Mensaje_Usuario_Registrado").alert();     
					$("#Mensaje_Usuario_Registrado").fadeTo(4500, 500).slideUp(500, function(){
						$("#Mensaje_Usuario_Registrado").hide();
					});  
				});				
				Tabla_Roles_Registrados();
				Cargar_Tabla();
				LimpiarDatos();	
				Limpiar_Datos_Registro();			
			}
			if(respuesta.error==false){
				$('#Modal_Confirmar_Registrar_Usuario').modal('hide');
				$('#id_validacion2').html('');
				$.each(respuesta.errors,function(index, error){ 
					$('#estilo_mensaje_2').show();			
					$('#id_validacion_2').html('<strong>'+error+'</strong>');
					$('#id_validacion_2').show();
				}); 
			}

		}
	});
});

function Limpiar_Datos_Registro(){
	$('#CodigoRegistrar').val('');
	$('#NombreRegistrar').val('');
	$('#ApellidoRegistrar').val('');
	$('#TelefonoRegistrar').val(''); 
	$('#DireccionRegistrar').val(''); 
	$('#NombreCorreoRegistrar').val('');
	$('#id_validacion_2').hide();
	$('#estilo_mensaje_2').hide();		
	$('#id_rol_registrar').val('').selectpicker('refresh');			
	$('#CodigoRegistrar').focus();
}

function Validar_Modificar_Usuarios(){
	var patron =/[a-z/0-9]/;
	var patron2=/^[0-9/A-Za-z\_\-\.\s\xF1\xD1]+$/;	
	var CodigoModificar= $('#CodigoModificar').val();
	var NombreModificar= $('#NombreModificar').val();
	var ApellidoModificar= $('#ApellidoModificar').val(); 
	var TelefonoModificar = $('#TelefonoModificar').val(); 
	var DireccionModificar= $('#DireccionModificar').val(); 
	var NombreCorreoModificar =  $('#NombreCorreoModificar').val();
	var DatoCorreo =  $('#DatoCorreo').text();	
	var id_rol_editar= document.getElementById("id_rol_editar").value;


	if(id_rol_editar==0){
		$("#id_validacion_3").css("fontSize", 15);						
		$("#id_validacion_3").css("font-weight","Bold"); 	
		$("#estilo_mensaje_3").attr("class", "panel panel-danger");
		$('#estilo_mensaje_3').show();			
		$('#id_validacion_3').html('Selecciona un rol de usuario.');
		$('#id_validacion_3').show();	
		$('#id_rol_editar').val('');			      
		$('#id_rol_editar').selectpicker('toggle');
		$('#Modal_Editar_Usuario').scrollTop(0);
		return true;
	}else{
		if(!patron.test(CodigoModificar)){
			$("#id_validacion_3").css("fontSize", 15);						
			$("#id_validacion_3").css("font-weight","Bold"); 	
			$("#estilo_mensaje_3").attr("class", "panel panel-danger");
			$('#estilo_mensaje_3').show();			
			$('#id_validacion_3').html('El codigo no puede estar vacío.');
			$('#id_validacion_3').show();	
			$('#CodigoModificar').val('');		
			$('#Modal_Editar_Usuario').scrollTop(0);
			return true;
		}else{
			if(!patron.test(NombreModificar)){
				$("#id_validacion_3").css("fontSize", 15);						
				$("#id_validacion_3").css("font-weight","Bold"); 	
				$("#estilo_mensaje_3").attr("class", "panel panel-danger");
				$('#estilo_mensaje_3').show();			
				$('#id_validacion_3').html('El nombre no puede estar vacío.');
				$('#id_validacion_3').show();	
				$('#NombreModificar').val('');			      
				document.getElementById("NombreModificar").focus();
				$('#Modal_Editar_Usuario').scrollTop(0);
				return true;
			}else{
				if(!patron.test(ApellidoModificar)){
					$("#id_validacion_3").css("fontSize", 15);						
					$("#id_validacion_3").css("font-weight","Bold"); 	
					$("#estilo_mensaje_3").attr("class", "panel panel-danger");
					$('#estilo_mensaje_3').show();			
					$('#id_validacion_3').html('El apellido no puede estar vacío.');
					$('#id_validacion_3').show();	
					$('#ApellidoModificar').val('');			      
					document.getElementById("ApellidoModificar").focus();
					$('#Modal_Editar_Usuario').scrollTop(0);
					return true;
				}else{
					if(!patron.test(TelefonoModificar)){
						$("#id_validacion_3").css("fontSize", 15);						
						$("#id_validacion_3").css("font-weight","Bold"); 	
						$("#estilo_mensaje_3").attr("class", "panel panel-danger");
						$('#estilo_mensaje_3').show();			
						$('#id_validacion_3').html('El télefono no puede estar vacío.');
						$('#id_validacion_3').show();	
						$('#TelefonoModificar').val('');			      
						document.getElementById("TelefonoModificar").focus();
						$('#Modal_Editar_Usuario').scrollTop(0);
						return true;
					}else{
						if(!patron.test(DireccionModificar)){
							$("#id_validacion_3").css("fontSize", 15);						
							$("#id_validacion_3").css("font-weight","Bold"); 	
							$("#estilo_mensaje_3").attr("class", "panel panel-danger");
							$('#estilo_mensaje_3').show();			
							$('#id_validacion_3').html('La dirección no puede estar vacío.');
							$('#id_validacion_3').show();	
							$('#DireccionModificar').val('');			      
							document.getElementById("DireccionModificar").focus();
							$('#Modal_Editar_Usuario').scrollTop(0);
							return true;
						}else{
							if(!patron2.test(NombreCorreoModificar)){
								$("#id_validacion_3").css("fontSize", 15);						
								$("#id_validacion_3").css("font-weight","Bold"); 	
								$("#estilo_mensaje_3").attr("class", "panel panel-danger");
								$('#estilo_mensaje_3').show();			
								$('#id_validacion_3').html('El email no puede estar vacío, solo se permiten letras.');
								$('#id_validacion_3').show();	
								$('#NombreCorreoModificar').val('');			      
								document.getElementById("NombreCorreoModificar").focus();
								$('#Modal_Editar_Usuario').scrollTop(0);
								return true;
							}else{
								$('#CorreoModificarOculto').val(NombreCorreoModificar+DatoCorreo);
								$('#id_validacion_3').hide();
								$('#estilo_mensaje_3').hide();
								$('#Modal_Confirmar_Modificar_Usuario').modal('show');	
								return false;
							}
						}
					}
				}
			}
		}
	}
}


$('body').delegate('.ModificarUsuarioTabla','click',function(){
	var RolUsuario =($(this).attr('RolUsuario'));
	var CodigoUsuario =($(this).attr('CodigoUsuario'));	
	var NombreUsuario =($(this).attr('NombreUsuario'));	
	var ApellidoUsuario =($(this).attr('ApellidoUsuario'));	
	var TelefonoUsuario =($(this).attr('TelefonoUsuario'));	
	var DireccionUsuario =($(this).attr('DireccionUsuario'));
	var CorreoUsuario =($(this).attr('CorreoUsuario'));	
	$('select[name=id_rol_editar]').val(RolUsuario);
	$('select[name=id_rol_editar]').change();
	$('#CorreoModificarOculto').val(CorreoUsuario);
	$('#CodigoOculto').val(CodigoUsuario);
	$('#CorreoOculto').val(CorreoUsuario);
	$('#TelefonoOculto').val(TelefonoUsuario);	
	CorreoUsuario=CorreoUsuario.replace('@TpmMovil.com','')	
	$('#CodigoModificar').val(CodigoUsuario);
	$('#NombreModificar').val(NombreUsuario);
	$('#ApellidoModificar').val(ApellidoUsuario); 
	$('#TelefonoModificar').val(TelefonoUsuario); 
	$('#DireccionModificar').val(DireccionUsuario); 	
	$('#NombreCorreoModificar').val(CorreoUsuario);	
	$('#Modal_Editar_Usuario').modal('show');
});

$('.EditarUsuario').click(function(){
	var CodigoModificar			= $('#CodigoModificar').val();
	var NombreModificar 		= $('#NombreModificar').val();
	var ApellidoModificar 		= $('#ApellidoModificar').val(); 
	var TelefonoModificar 		= $('#TelefonoModificar').val(); 
	var DireccionModificar		= $('#DireccionModificar').val(); 	
	var CorreoModificarOculto 	=  $('#CorreoModificarOculto').val();	
	var CodigoOculto 			=  $('#CodigoOculto').val();
	var TelefonoOculto 			=  $('#TelefonoOculto').val();	
	var CorreoOculto 			=  $('#CorreoOculto').val();
	var id_rol_editar 			= document.getElementById("id_rol_editar").value;	


	$.ajax({
		type:'GET',
		data: {
			'CodigoModificar' 		: CodigoModificar,
			'NombreModificar' 		: NombreModificar,
			'ApellidoModificar' 	: ApellidoModificar,
			'TelefonoModificar' 	: TelefonoModificar,
			'DireccionModificar'	: DireccionModificar,
			'CorreoModificarOculto' : CorreoModificarOculto,
			'CodigoOculto' 			: CodigoOculto,
			'TelefonoOculto' 		: TelefonoOculto,
			'CorreoOculto' 			: CorreoOculto,
			'id_rol_editar' 		: id_rol_editar
		},
		url:'{{ url('ModificarNuevoUsuario')}}',
		success: function(respuesta){      
			if(respuesta==0){   
				$('#Modal_Editar_Usuario').modal('hide');
				$('#Modal_Confirmar_Modificar_Usuario').modal('hide');
				$('#Mensaje_Usuario_Modificado').show();       
				$(document).ready (function(){  
					$('#ModalConfirmar').modal('hide');
					$("#Mensaje_Usuario_Modificado").hide(); 
					$("#Mensaje_Usuario_Modificado").alert();     
					$("#Mensaje_Usuario_Modificado").fadeTo(4500, 500).slideUp(500, function(){
						$("#Mensaje_Usuario_Modificado").hide();
					});  
				});				
				// Tabla_Roles_Registrados();
				Cargar_Tabla();
				// LimpiarDatos();	
				// Limpiar_Datos_Registro();								
			}
			if(respuesta.error==false){
				$('#Modal_Confirmar_Modificar_Usuario').modal('hide');
				$('#id_validacion3').html('');
				$.each(respuesta.errors,function(index, error){ 
					$('#estilo_mensaje_3').show();			
					$('#id_validacion_3').html('<strong>'+error+'</strong>');
					$('#id_validacion_3').show();
				}); 
			}

			if(respuesta=respuesta.error){
				$('#Modal_Confirmar_Modificar_Usuario').modal('hide');
				$('#id_validacion3').html('');
				$('#estilo_mensaje_3').show();
				$('#id_validacion_3').html('<strong>'+respuesta+'</strong>');
				$('#id_validacion_3').show();
			}

		}
	});
});

$('body').delegate('.DesactivarUsuarioTabla','click',function(){
	var IdUsuario =($(this).attr('IdUsuario'));
	var NombreUsuario =($(this).attr('NombreUsuario'));
	var RolUsuario =($(this).attr('RolUsuario'));
	var FotoUsuario =($(this).attr('FotoUsuario'));
	if(FotoUsuario==""){
		FotoUsuario="global/images/no_photo_profile.png";
	}
	$('#id_usuario_desactivar').val(IdUsuario);
	$("#Foto_Desactivar_Usuario").attr("src",FotoUsuario);
	$("#NombreUsuarioDesactivar").css("fontSize", 18);						
	$("#NombreUsuarioDesactivar").css("font-weight","Bold");
	$('#NombreUsuarioDesactivar').text(NombreUsuario);
	$('#Rango_Usuario_Desactivar').text(RolUsuario);
	$('#Modal_Desactivar_Usuario').modal('show');
});

function Desactivar_Usuario(){
	var id_usuario_desactivar =$('#id_usuario_desactivar').val();
	$.ajax({
		type:'GET',
		data: {
			'id_usuario_desactivar' 		: id_usuario_desactivar
		},
		url:'{{ url('Desactivar_Usuario')}}',
		success: function(respuesta){      
			if(respuesta==0){   
				$('#Modal_Desactivar_Usuario').modal('hide');				
				$('#Mensaje_Usuario_Desactivado').show();       
				$(document).ready (function(){  
					$('#ModalConfirmar').modal('hide');
					$("#Mensaje_Usuario_Desactivado").hide(); 
					$("#Mensaje_Usuario_Desactivado").alert();     
					$("#Mensaje_Usuario_Desactivado").fadeTo(4500, 500).slideUp(500, function(){
						$("#Mensaje_Usuario_Desactivado").hide();
					});  
				});					
				Cargar_Tabla();											
			}
		}
	});
}

function Cargar_Nombres_Usuarios(){	

	$el =$('#id_usario_buscar');
	$.ajax({
		url   : "<?= URL::to('Listar_Nombres_Usuarios') ?>",
		type  : "GET",
		async : false,			
		success:function(re){
			var option = $('<option />');
			$.each(re, function(key,value) {
				$el.append($("<option></option>")
					.attr("value", key).text(value));
			});							

			var options = $('.id_usario_buscar option');
			var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
			arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
			options.each(function(i, o) {
				o.value = arr[i].v;
				$(o).text(arr[i].t);
			});

		}
	});	
	$('#id_usario_buscar').val('').selectpicker('refresh');	
}

function RemoverDataCombobox(selectbox)
{
	var i;
	for(i = selectbox.options.length - 1 ; i >= 1 ; i--)
	{
		selectbox.remove(i);
	}
}

$('.BuscarUsuario').click(function(){	
	RemoverDataCombobox(document.getElementById("id_usario_buscar"));
	Cargar_Nombres_Usuarios();		
	$('#Modal_Buscar_Usuario').modal('show');

});

function Cargar_Tabla_Consultada_Usuarios(){

	var _token=$('#_token').val();
	var id_usario_buscar = document.getElementById("id_usario_buscar").value;	

	$.ajax({
		type:'POST',
		data: {
			'_token'		   : _token,
			'id_usario_buscar' : id_usario_buscar
		},
		url:'{{ url('Tabla_Usuarios_Consultada')}}',
		success: function(data){   
			$('#Modal_Buscar_Usuario').modal('hide');			
			$('#tabla_usuarios').empty().html(data);

		}
	});

	$(document).on("click",".pagination li a",function(e) {
		e.preventDefault();		
		var url = $(this).attr("href");
		$.ajax({
			type:'get',
			url:url,			
			success: function(data){
				$('#tabla_usuarios').empty().html(data);				
			}
		});
	});	
}

$('body').delegate('.ActivarUsuarioTabla','click',function(){
	var IdUsuario =($(this).attr('IdUsuario'));
	var NombreUsuario =($(this).attr('NombreUsuario'));
	var RolUsuario =($(this).attr('RolUsuario'));
	var FotoUsuario =($(this).attr('FotoUsuario'));
	if(FotoUsuario==""){
		FotoUsuario="global/images/no_photo_profile.png";
	}
	$('#Id_Usuario_Activar').val(IdUsuario);
	$("#Foto_Activar_Usuario").attr("src",FotoUsuario);
	$("#NombreUsuarioActivar").css("fontSize", 18);						
	$("#NombreUsuarioActivar").css("font-weight","Bold");
	$('#NombreUsuarioActivar').text(NombreUsuario);
	$('#Rango_Usuario_Activar').text(RolUsuario);
	$('#Modal_Activar_Usuario').modal('show');	
});

function Activar_Usuario(){
	var Id_Usuario_Activar =$('#Id_Usuario_Activar').val();
	$.ajax({
		type:'GET',
		data: {
			'Id_Usuario_Activar' 		: Id_Usuario_Activar
		},
		url:'{{ url('Activar_Usuario')}}',
		success: function(respuesta){      
			if(respuesta==0){   
				$('#Modal_Activar_Usuario').modal('hide');				
				$('#Mensaje_Usuario_Activado').show();       
				$(document).ready (function(){  
					$('#ModalConfirmar').modal('hide');
					$("#Mensaje_Usuario_Activado").hide(); 
					$("#Mensaje_Usuario_Activado").alert();     
					$("#Mensaje_Usuario_Activado").fadeTo(4500, 500).slideUp(500, function(){
						$("#Mensaje_Usuario_Activado").hide();
					});  
				});					
				Cargar_Tabla();											
			}
		}
	});
}

$('body').delegate('.VerPerfilUsuario','click',function(){
	var IDUsuarioPerfil =($(this).attr('IDUsuarioPerfil'));
	var NombreUsuarioPerfil =($(this).attr('NombreUsuarioPerfil'));
	var CodigoUsuarioPerfil =($(this).attr('CodigoUsuarioPerfil'));
	var TelefonoUsuarioPerfil =($(this).attr('TelefonoUsuarioPerfil'));
	var DireccionUsuarioPerfil =($(this).attr('DireccionUsuarioPerfil'));
	var DireccionEmailUsuarioPerfil =($(this).attr('DireccionEmailUsuarioPerfil'));
	var EstadoUsuarioPerfil =($(this).attr('EstadoUsuarioPerfil'));
	var FotoUsuarioPerfil =($(this).attr('FotoUsuarioPerfil'));
	var RangoUsuarioPerfil =($(this).attr('RangoUsuarioPerfil'));

	if(FotoUsuarioPerfil==""){
		FotoUsuarioPerfil="global/images/no_photo_profile.png";
	}
	$("#NombreUsuarioPerfil").css("fontSize", 18);						
	$("#NombreUsuarioPerfil").css("font-weight","Bold");
	$('#NombreUsuarioPerfil').text(NombreUsuarioPerfil);

	$("#TextoRestablecer").css("fontSize", 13);						
	$("#TextoRestablecer").css("font-weight","Bold");
	$("#TextoRestablecer").text('Restablecer Password');
	Tabla_Conexion_Usuarios(IDUsuarioPerfil);

	
	$('#CodigoUsuarioPerfil').text(CodigoUsuarioPerfil);
	$('#TelefonoUsuarioPerfil').text(TelefonoUsuarioPerfil);
	$('#DireccionUsuarioPerfil').text(DireccionUsuarioPerfil);
	$('#DireccionEmailUsuarioPerfil').text(DireccionEmailUsuarioPerfil);
	$('#EstadoUsuarioPerfil').text(EstadoUsuarioPerfil);
	$("#FotoUsuarioPerfil").attr("src",FotoUsuarioPerfil);
	$('#RangoUsuarioPerfil').text(RangoUsuarioPerfil);
	$('#id_password_restablecer_usuario').val(IDUsuarioPerfil);
	$('#Modal_VerPerfil_Usuario').modal('show');
});


function Tabla_Conexion_Usuarios($id_usuario){
	var _token=$('#_token').val();		
	$.ajax({
		type:'POST',
		data: {
			'_token' 		: _token,
			'id_usuario' 	: $id_usuario
		},
		url:'{{ url('Tabla_Conexiones_Usuarios')}}',
		success: function(data){      
			$('#Tabla_Conexion_Usuarios').empty().html(data);
		}
	});

	$(document).on("click",".pagination li a",function(e) {
		e.preventDefault();		
		var url = $(this).attr("href");
		$.ajax({
			type:'get',
			url:url,			
			success: function(data){
				$('#Tabla_Conexion_Usuarios').empty().html(data);				
			}
		});
	});		
}

function RestablecerPassword(){
	$('#Modal_Confirmar_Restablecer_Password').modal('show');
}

$('.RestablecerPassword').click(function(){
	var id_password_restablecer_usuario= $('#id_password_restablecer_usuario').val();
	$.ajax({
		type:'get',
		data: {			
			'id_password_restablecer_usuario' 	:id_password_restablecer_usuario
		},
		url:'{{ url('RestablecerPasswordUsuario')}}',
		success: function(respuesta){  
			if(respuesta==0){ 
				$('#Modal_Confirmar_Restablecer_Password').modal('hide');
				$("#estilo_mensaje5").attr("class", "panel panel-success");
				$('#id_validacion5').html('Se restablecio el password del usuario con éxito.!');
				$("#id_validacion5").css("fontSize", 15);						
				$("#id_validacion5").css("font-weight","Bold"); 		
				$('#estilo_mensaje5').show();
				$('#id_validacion5').show();
				$('#Modal_VerPerfil_Usuario').scrollTop(0);
				$("#estilo_mensaje5").fadeTo(4500, 500).slideUp(500, function(){
					$("#estilo_mensaje5").hide();
				});										
			}			
		}
	});
});



// Termina Todo lo de Usuarios
function subir() {
	$("html, body").animate({ scrollTop: 0 }, "slow");
	return false;
}

Cargar_Roles();

</script>
@stop