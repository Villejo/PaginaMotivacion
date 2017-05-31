<ul class="nav navbar-nav pull-right">

	<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
		@if(Auth::user()->fk_rol==1) 
		<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
			<i class="icon-envelope-open"></i>
			@if($Notificacion==0)			
			@else
			<span class="badge badge-default">
				{{$Notificacion}}
			</span>
			@endif
		</a>
		<ul class="dropdown-menu">
			<li class="external">
				@if($Notificacion==1)
				<h3>Tienes <span class="bold">{{$Notificacion}} Nuevo</span> Mensaje</h3>
				<a href="{{URL::route('Notificaciones')}}">Ver todos</a>
				@elseif($Notificacion>=1)
				<h3>Tienes <span class="bold">{{$Notificacion}} Nuevos</span> Mensajes</h3>
				<a href="{{URL::route('Notificaciones')}}">Ver todos</a>
				@else
				<h3>No tienes<span class="bold"> Nuevos</span> Mensajes</h3>
				@endif				
			</li>

			@if($Mensaje)
			<li>
				<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
					@foreach ($Mensaje as $key => $value) 				
					<li>
						<a href="{{URL::route('Notificaciones')}}">
							<span class="photo">
								@if(File::exists($value->Nombre_Usuario->ruta_photo_profile))
								<img src="{{$value->Nombre_Usuario->ruta_photo_profile}}" class="img-rounded" alt="">
								@else
								<img src="global/images/no_photo_profile.png" class="img-rounded" alt="">
								@endif
							</span>
							<span class="subject">
								<span class="from">
									{{$value->Nombre_Usuario->nombre_usuario}} {{$value->Nombre_Usuario->apellido}}</span>
									<span class="time">
										<i class="fa fa-clock-o" aria-hidden="true"></i>{{$hora_notificacion=Carbon::parse($value->hora_notificacion)->diffForHumans()}}</span>
									</span>
									<span class="message">
										{{$titulo_mensaje=$value->titulo_mensaje}}
									</span>	
									<span class="message">
										{{$value->Nombre_Equipo->nombre_equipo}}	
									</span>	
								</span>
							</a>
						</li>
						@endforeach	
					</ul>
				</li>
			</ul>
			@endif

			@else								
			<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
				<li>
				</li>
			</ul>
			@endif						
			<li class="dropdown dropdown-user">
				<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<!-- <img alt="" class="img-circle PhotoPequenaPerfil" src="global/images/img.jpg"/> -->
					@if(Auth::user()->ruta_photo_profile==null)
					<img src="global/images/no_photo_profile.png"  title="Usuario Sin Foto" class="img-circle PhotoPequenaPerfil"/>
					@elseif(File::exists(Auth::user()->ruta_photo_profile))
					<img src="{{Auth::user()->ruta_photo_profile}}" Imagen="{{Auth::user()->ruta_photo_profile}}"  class="img-circle PhotoPequenaPerfil"/>	
					@else		
					<img src="global/images/no_photo_profile.png"  title="Usuario Sin Foto" class="img-circle PhotoPequenaPerfil" />
					@endif
					<span class="username username-hide-on-mobile">
						{{Auth::user()->nombre_usuario}} {{Auth::user()->apellido}}</span>
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						@if(Auth::user()->fk_rol!='1')
						<li>
							<a href="{{URL::route('MyProfile')}}">
								<i class="icon-user"></i> Mi Perfil </a>
							</li>
							<li class="divider">
							</li>
							@endif							
							<li>
								<a href="{{URL::route('Salir')}}">
									<i class="icon-key"></i> Cerrar Sesión </a>
								</li>
							</ul>
						</li>
					</li>
				</ul>										

				<script>
					jQuery(document).ready(function() {
						Metronic.init();  																
					});
				</script>
