@if($formulario_diligenciado->total()!=0)
<div class="panel panel-info">	
<div class="panel-heading" style="background-color: #0000FF">
		<h3 class="panel-title" style="text-align: center;">
			<strong>INFORMACION DE DILIGENCIAMIENTO DE RUTAS</strong>
		</h3>
	</div>	
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>					
					<tr>
						<th style="background-color:#8181F7"><center>Usuario</center></th>
						<th style="background-color:#8181F7"><center>Codigo Usuario</center></th>
						<th style="background-color:#8181F7"><center>Formulario</center></th>
						<th style="background-color:#8181F7"><center>Codigo Formulario</center></th>
						<th style="background-color:#8181F7"><center>Turno</center></th>
						<th style="background-color:#8181F7"><center>Fecha Registro</center></th>
						<th style="background-color:#8181F7"><center>Registrado Por</center></th>
					</tr>					
				</thead>
				<tbody>					
					@foreach($formulario_diligenciado as $value)
					<tr >
						<th id="nombre_usuario"><center>{{$value->Formulario_Usuario->nombre_usuario}}</center></th>
						<td id="codigo_usuario"><center>{{$value->Formulario_Usuario->codigo}}</center></td>
						<th id="nombre_formulario"><center>{{$value->Encabezado_Formulario->nombre_formulario}}</center></th>
						<th id="id_formulario"><center>{{$value->Encabezado_Formulario->id}}</center></th>
						<th id="id_turno"><center>{{$value->fk_turno}}</center></th>
						<th><center>{{$value->fecha_ingreso}}</center></th>


						@if($value->ingreso_por_usuario != "no")
						<th><center><i class="fa fa-user-circle fa-2x" aria-hidden="true"></i></center></th>
						@else
						<th><center><i class="fa fa-desktop fa-2x" aria-hidden="true"></i></center></th>
						@endif
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>








<div class="panel-heading" style="background-color: #FE2E64">
		<h3 class="panel-title" style="text-align: center;">
			<strong>DIAS NO ASISTIDOS</strong>
		</h3>
	
</div>



		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>					
					<tr>
						<th style="background-color:#F5A9F2"><center>Usuario</center></th>
						<th style="background-color:#F5A9F2"><center>Codigo Usuario</center></th>
						<th style="background-color:#F5A9F2"><center>Formulario</center></th>
						<th style="background-color:#F5A9F2"><center>Codigo Formulario</center></th>
						<th style="background-color:#F5A9F2"><center>Turno</center></th>
						<th style="background-color:#F5A9F2"><center>Fecha de Inasistencia</center></th>
					</tr>					
				</thead>

				<tbody>	
					<tr>
						@foreach($DiasNoLaborados as $value2)

						@foreach ($formulario_diligenciado->take(1) as $value)
						<th ><center>{{$value->Formulario_Usuario->nombre_usuario}}</center></th>
						<td ><center>{{$value->Formulario_Usuario->codigo}}</center></td>
						<th ><center>{{$value->Encabezado_Formulario->nombre_formulario}}</center></th>
						<th ><center>{{$value->Encabezado_Formulario->id}}</center></th>
						<th >{{$value->fk_turno}}</center></th>
						@endforeach

						<th><center>{{$value2}}</center></th>

					</tr>

					@endforeach

				</tbody>
			</table>
	
		</div>
	</div> 


@else
No tiene asignaciones
@endif