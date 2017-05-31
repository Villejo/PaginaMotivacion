<?php if($formulario_diligenciado->total()!=0): ?>
<div class="panel panel-info">	
	<!-- <div class="panel-heading" style=" background-color: #0000FF">
		<h3 class="panel-title" style="text-align: center;">
			<strong>INFORMACION DE DILIGENCIAMIENTO DE RUTAS</strong>
		</h3>
	</div>	 -->
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
					</tr>					
				</thead>
				<tbody>
					<?php foreach($formulario_diligenciado->take(1) as $value): ?>
					<tr >
						<th id="nombre_usuario"><center><?php echo e($value->Formulario_Usuario->nombre_usuario); ?></center></th>
						<td id="codigo_usuario"><center><?php echo e($value->Formulario_Usuario->codigo); ?></center></td>
						<th id="nombre_formulario"><center><?php echo e($value->Encabezado_Formulario->nombre_formulario); ?></center></th>
						<th id="id_formulario"><center><?php echo e($value->Encabezado_Formulario->id); ?></center></th>
						<th id="id_turno"><center><?php echo e($value->fk_turno); ?></center></th>					
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-9">
		<div class="panel panel-info">	
			<div class="panel-heading" style="background-color: #01DF74;color: black">
				<h3 class="panel-title" style="text-align: center;">
					<strong>INFORMACION DE INGRESO DE RUTAS</strong>
				</h3>
			</div>	
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>					
							<tr>								
								<th style="background-color:#A9F5D0"><center>Registrado Por</center></th>
								<th style="background-color:#A9F5D0"><center>Fecha Registro</center></th>
								<th style="background-color:#A9F5D0"><center>IR AL REGISTRO</center></th>
								

							</tr>					
						</thead>

						
						<tbody>	

							<?php foreach($formulario_diligenciado as $value): ?>
							<tr >

								


								<?php if($value->ingreso_por_usuario != "no"): ?>
								<th><center><i class="fa fa-user-circle fa-3x" aria-hidden="true" style="margin-top: 10px"></i></center></th>
								<?php else: ?>
								<th><center><i class="fa fa-desktop fa-3x" aria-hidden="true" style="margin-top: 10px"></i></center></th>
								<?php endif; ?>
								<th><center><?php echo e($value->fecha_ingreso); ?></center></th>
								<th><center><i class="fa fa-arrow-circle-right fa-3x" aria-hidden="true" style="margin-top: 10px"></i></center></th>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-info">	
			<div class="panel-heading" style="color: black;background-color: #FE2E64">
				<h3 class="panel-title" style="text-align: center;">
					<strong>DIAS SIN GESTION</strong>
				</h3>
			</div>	
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>					
							<tr>

								<th style="background-color:#F5A9F2"><center>Fecha de Inasistencia</center></th>
								<th style="background-color:#F5A9F2"><center>Registrar</center></th>
							</tr>					
						</thead>

						<tbody>	
							<tr>

								<?php foreach($DiasNoLaborados as $value2): ?>
								<th><center><?php echo e($value2); ?></center></th>

								<th><center><i class="fa fa-arrow-circle-right fa-3x" aria-hidden="true" style="margin-top: 10px"></i></center></th>


							</tr>

							<?php endforeach; ?>

						</tbody>

					</table>
					<button type="button" class="btn btn-success RegistrarIngresoEquipos" 
					id="BtnNuevoEquipo" title="Ingresar registro de equipos" style="display: block;" >
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>REGISTRAR TODOS</span></font></strong>
					<span class="fa fa-plus-square"></span></button>
				</div>
			</div>
		</div>

	</div>

</div>
<?php else: ?>
No tiene asignaciones
<?php endif; ?>