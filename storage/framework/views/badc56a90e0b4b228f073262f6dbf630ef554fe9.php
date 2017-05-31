<?php if($Conexion->total()==0): ?>
<div class="panel panel-info">	
	<div class="panel-heading" style="background-color: #562502">
		<h3 class="panel-title">
			<strong>Últimas Conexiones</strong>
			<div class="pull-right">
				<strong>Total Conexiones:</strong>
				<label><font size ="3", color color="#000000" face="Tahoma"><strong>0</strong></font></label>
			</div>
		</h3>
	</div>
	<div class="panel-body">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<img src="global/images/No_Found_Ultimas_Conexiones.png" alt="logo" class="img-thumbnail img-responsive" >
		</div>
	</div>
</div>
<?php else: ?>
<div class="panel panel-info">	
	<div class="panel-heading" style="background-color: #562502">
		<h3 class="panel-title">
			<strong>Últimas Conexiones</strong>
			<div class="pull-right">
				<strong>Total Conexiones:</strong>
				<label><font size ="3", color color="#000000" face="Tahoma"><strong><?php echo e($Conexion->total()); ?></strong></font></label>
			</div>
		</h3>
	</div>
	<div class="panel-body">
		<div class="portlet light">				
			<div class="portlet-body">
				<div class="table-scrollable">
					<table class="table table-striped table-bordered table-advance table-hover">
						<thead>
							<tr>									
								<th style="width:30px !important"> 
									<i class="fa fa-clock-o" aria-hidden="true"></i> Fecha y Hora Conexión
								</th>
								<th style="width:30px !important"> 
									<i class="fa fa-desktop" aria-hidden="true"></i> Dirección IP
								</th>
								<th style="width:30px !important"> 
									<i class="fa fa-briefcase" aria-hidden="true"></i> Codigo
								</th>
							</tr>
						</thead>
						<input type="hidden" value="<?php echo e($numero1 = 1); ?>">
						<tbody>		
							<?php foreach($Conexion as $value): ?>	
							<tr>
								<td class="highlight">										
									EL DIA <strong><?php echo e(Carbon::parse($value->fecha_conexion)->toDateString()); ?></strong>
									A LAS  <strong><?php echo e(Carbon::parse($value->hora_conexion)->format('g:i A')); ?></strong>
								</td>	
								<td class="hidden-xs">
									<?php echo e($value->ip_conexion); ?>											
								</td>
								<td class="hidden-xs">	
									<?php echo e($value->CodigoUsuario->codigo); ?>								
								</td>														
							</tr>
							<?php endforeach; ?>	
							<center><?php echo e($Conexion->links()); ?></center>
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
</div>
<?php endif; ?>