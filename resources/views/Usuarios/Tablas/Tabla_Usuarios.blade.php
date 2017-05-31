@if($Usuarios->total()==0)
<script type="text/javascript">	
	$('.BuscarAsignacion').hide();	
</script>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<img src="global/images/No_Found_Usuario.png" alt="logo" class="img-thumbnail img-responsive" >	
</div>
@else
<script type="text/javascript">	
	$('.BuscarAsignacion').show();	
</script>
<div class="panel panel-info">	
	<div class="panel-heading" style="background-color: #562502">
		<h3 class="panel-title">
			<strong>Listado de Usuarios</strong>
			<div class="pull-right">
				<strong>Total Usuarios:</strong>
				<label><font size ="3", color color="#ff6d05" face="Tahoma"><strong>{{$Usuarios->total()}}</strong></font></label>
			</div>
		</h3>
	</div>	
	<div class="panel-body">
		@foreach ($Usuarios as $value)
		<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
			<div class="panel panel-success">
				<div class="panel-heading" style="background: #562502;">					
				</div>
				<div class="panel-body">					
					<div class="col-sm-12 col-md-5 col-lg-5">	
						@if($value->ruta_photo_profile==null || $value->ruta_photo_profile=="global/images/no_photo_profile.png")						
						<center><img src="global/images/no_photo_profile.png" width="100" height="100" border="5" title="Usuario sin foto de perfil"/></center>				
						@elseif(File::exists($value->ruta_photo_profile))
						<center><img class="FotoGrande" src="{{$value->ruta_photo_profile}}" Imagen="{{$value->ruta_photo_profile}}" width="100px" height="100px"/></center>
						@else
						<center><img src="global/images/no_photo_profile.png" width="100px" height="100px" title="Usuario sin foto de perfil" /> </center>	
						@endif
						<center>	
							<span class="badge btn-md btn-success" style="background: #562502;">
								<b>
									<strong>
										<font size ="2">
											{{ucfirst($value->Nombre_Rol->nombre_rol)}}
										</font>
									</strong>
								</b>
							</span>
							<br>
							<h4><font color="#562502" face="Tahoma"><a href="#" class="VerPerfilUsuario" NombreUsuarioPerfil="{{ucfirst($value->nombre_usuario)}} {{ucfirst($value->apellido)}}" CodigoUsuarioPerfil="{{$value->codigo}}" TelefonoUsuarioPerfil="{{$value->telefono}}" DireccionUsuarioPerfil="{{ucfirst($value->dierccion)}}" DireccionEmailUsuarioPerfil="{{ucfirst($value->email)}}" EstadoUsuarioPerfil="{{ucfirst($value->estado_usuario)}}" FotoUsuarioPerfil="{{$value->ruta_photo_profile}}" RangoUsuarioPerfil="{{ucfirst($value->Nombre_Rol->nombre_rol)}}" IDUsuarioPerfil="{{$value->id}}"><strong>Ver Perfil</strong></a></font></h4>
						</center>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
						<div class="form-group">
							<b>
								<font size ="2", color="#562502" face="Tahoma">
									<i class="fa fa-briefcase" aria-hidden="true" title="Codigo Usuario"></i>
								</font>												
								<strong>
									{{$value->codigo}}
								</strong>
							</b>
						</div>
						<div class="form-group">
							<b>
								<font size ="2", color="#562502" face="Tahoma">
									<i class="fa fa-user" aria-hidden="true" title="Nombre Usuario"></i>
								</font>
								<strong>
									{{ucfirst($value->nombre_usuario)}} {{ucfirst($value->apellido)}}
								</strong>
							</b>
						</div>
						<div class="form-group">
							<b>
								<font size ="2", color="#562502" face="Tahoma">
									<i class="fa fa-phone-square" aria-hidden="true" title="Telefono Usuario"></i>
								</font>
								<strong>
									{{$value->telefono}}
								</strong>
							</b>
						</div>
						<div class="form-group">
							<b>
								<font size ="2", color="#562502" face="Tahoma">
									<i class="fa fa-address-card" aria-hidden="true" title="Direccion Usuario"></i>
								</font>
								<strong>										
									{{ucfirst($value->dierccion)}}									
								</strong>
							</b>
						</div>						
						<div class="form-group">
							<b>
								<font size ="2", color="#562502" face="Tahoma">
									<i class="fa fa-envelope" aria-hidden="true" title="Email Usuario"></i>
								</font>
								<strong>
									<a href="mailto:{{$value->email}}">{{ucfirst($value->email)}}</a>		
								</strong>
							</b>								
						</div>
						<div class="form-group">
							<b>
								<font size ="2", color="#562502" face="Tahoma">
									@if($value->estado_usuario=='Activo')
									<i class="fa fa-bell" aria-hidden="true" title="Estado Usuario"></i>
									@else
									<i class="fa fa-bell-slash" aria-hidden="true" title="Estado Usuario"></i>
									@endif
								</font>
								<strong>
									{{ucfirst($value->estado_usuario)}}
								</strong>
							</b>								
						</div>
					</div>	
					<div class="btn-group pull-left">
						@if($value->estado_usuario=='Inactivo')
						<h4><font color="#562502" face="Tahoma">El usuario <strong>{{ucfirst($value->nombre_usuario)}} {{ucfirst($value->apellido)}}</strong>, se encuentra Inactivo.</font></h4>						
						<a href="#" title="Activar Usuario" class="ActivarUsuarioTabla" IdUsuario="{{$value->id}}" NombreUsuario="{{ucfirst($value->nombre_usuario)}} {{ucfirst($value->apellido)}}" FotoUsuario="{{$value->ruta_photo_profile}}" RolUsuario="{{ucfirst($value->Nombre_Rol->nombre_rol)}}"><strong> <font size ="3", color="#0fed00" face="Lucida Sans"></font>¿Desea Activarlo?</a>
						@endif
					</div>
					<div class="btn-group pull-right">
						<a href="#"  class="ModificarUsuarioTabla" RolUsuario="{{$value->Nombre_Rol->id}}" CodigoUsuario="{{$value->codigo}}" NombreUsuario="{{$value->nombre_usuario}}" ApellidoUsuario="{{$value->apellido}}" TelefonoUsuario="{{$value->telefono}}" DireccionUsuario="{{$value->dierccion}}" CorreoUsuario="{{$value->email}}"  title="Modificar Usuario"><strong> <font size ="3", color="#562502" face="Lucida Sans"><span class="fa fa-pencil-square fa-2x"></span></font></a>
					</a>					
					@if($value->estado_usuario=='Activo')
					|
					<a href="#" title="Desactivar Usuario" class="DesactivarUsuarioTabla" IdUsuario="{{$value->id}}" NombreUsuario="{{ucfirst($value->nombre_usuario)}} {{ucfirst($value->apellido)}}" FotoUsuario="{{$value->ruta_photo_profile}}" RolUsuario="{{ucfirst($value->Nombre_Rol->nombre_rol)}}"><strong> <font size ="3", color="#562502" face="Lucida Sans"><span class="fa fa-bell-slash fa-2x"></span></font></a>	
					@endif
				</div>
			</div>
		</div>
	</div>
	@endforeach		
</div>	
<center>{{$Usuarios->links()}}</center>
</div>

<!-- Modal See Perfil-->
<div class="modal fade" id="Modal_See_Profile" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">	
			<center><img  id="id_photo_preview" width="100%" height="100%"/></center>
		</div>
	</div>
</div>
<!-- Termina Modal See Perfil-->

{{Form::input("hidden", "_token", csrf_token())}}

<script type="text/javascript">
	$('.FotoGrande').click(function(){
		var Ruta_Imagen =($(this).attr('Imagen'));	
		$("#id_photo_preview").attr("src",Ruta_Imagen);		
		$('#Modal_See_Profile').modal('show');

	});	
</script>
@endif