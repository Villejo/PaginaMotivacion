@if($Roles->total()==0)
<script type="text/javascript">	
	$('.BuscarAsignacion').hide();	
</script>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<img src="global/images/No_Found_Asignacion.png" alt="logo" class="img-thumbnail img-responsive" >	
</div>
@else
<script type="text/javascript">	
	$('.BuscarAsignacion').show();	
</script>
<div class="panel panel-info">	
	<div class="panel-heading" style="background-color: #562502">
		<h3 class="panel-title">
			<strong>Listado de Roles</strong>
			<div class="pull-right">
				<strong>Total Roles:</strong>
				<label><font size ="3", color color="#000000" face="Tahoma"><strong>{{$Roles->total()}}</strong></font></label>
			</div>
		</h3>
	</div>
	<div class="panel-body">		
		<div class="row">
			<div class="portlet light">				
				<div class="portlet-body">
					<div class="table-scrollable">
						<table class="table table-striped table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style="width:20px !important">
										<i class="fa fa-check-circle" aria-hidden="true"></i>No.
									</th>
									<th>
										<i class="fa fa-briefcase"></i> Nombre Rol
									</th>
									<th style="width:20px !important"> 
										<i class="fa fa-cog" aria-hidden="true"></i>Opciones
									</th>
								</tr>
							</thead>
							<input type="hidden" value="{{$numero1 = 1}}">
							<tbody>		
								@foreach ($Roles as $value)	
								<tr>
									<td class="highlight">
										<div class="success">
										</div>
										<a href="javascript:;">
											{{$numero1++}}</a>
										</td>
										<td class="hidden-xs">
											{{ucfirst($value->nombre_rol)}}
										</td>
										<td>											
											<a href="#" class="Edit_Rol" id_Rol_Edit="{{$value->id}}"  NombreRolEdit="{{$value->nombre_rol}}"   title="Eliminar Rol"><strong> 
												<font size ="3", color ="#562502" face="Lucida Sans"><span class= "fa fa-times fa-2x"></span></font>
											</a>
											|
											<a href="#" class="Edit_Rol" id_Rol_Edit="{{$value->id}}"  NombreRolEdit="{{$value->nombre_rol}}"   title="Editar Rol" <strong> 
												<font size ="3", color ="#562502" face="Lucida Sans"><span class= "fa fa-pencil-square-o fa-2x"></span></font>
											</a>
										</td>
									</tr>
									@endforeach	
									<center>{{$Roles->links()}}</center>
								</tbody>
							</table>
						</div>
					</div>
				</div>								
			</div>
		</div>
	</div>
	@endif