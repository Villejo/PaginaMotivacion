<?php if($ultimo_registroo!=0): ?>

<script>
	ConteoRegresivo();
	function  ConteoRegresivo(){
		var countDownDate = new Date("<?php echo e($TurnoFinal); ?>").getTime();
		var x = setInterval(function() {
			var now = new Date().getTime();  
			var distance = countDownDate - now; 
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000); 

			$("#HoraFinalTurno").css("fontSize", 20);						
			$("#HoraFinalTurno").css("font-weight","Bold");		
			$('#HoraFinalTurno').text(+hours+':'+minutes+':'+seconds);
			// console.log('DISTANCIA: '+distance+' TURNO FINAL: '+"<?php echo e($TurnoFinal); ?>");
			if (distance < 0) {
				// console.log('ENTRO');
				clearInterval(x);  	
				$('#HoraFinalTurno').text('0:'+'0:'+'0');
				setTimeout('document.location.href = "<?php echo e(route('Index')); ?>"',1);
			}
		}, 1000);
	}
</script>

<form class="form-horizontal" enctype="multipart/form-data" id="id_formulario_consolidado" role="form" method="POST" action="">	
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<!-- Para que no guarde en cache -->
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-cache">

	<div class="portlet box purple">
		<div class="portlet-title">
			<div class="caption"><h4>HOJA RUTA</h4></div>
			<div class="btn-group pull-right">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background: #007835;">
					<h4><i class="fa fa-clock-o fa-2x" aria-hidden="true"></i> El turno se cerrara  en: <label id="HoraFinalTurno" name="HoraFinalTurno"></label></h4> 
				</div>
			</div>
		</div>
		<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"> 
		<input type="hidden" name="id_asignacion"  id="id_asignacion" class="form-control" value="<?php echo e($id_asignacion); ?>">
		<input type="hidden" name="id_formulario"  id="id_formulario" class="form-control" value="<?php echo e($Num_formulario); ?>">
		<input type="hidden" name="fk_usuario"  id="fk_usuario" class="form-control" value="<?php echo e($id_usuario); ?>">
		<input type="hidden" name="turno_actual" id="turno_actual" value="<?php echo e($turno_actual); ?>">
		<input type="hidden" name="fk_formulario" id="fk_formulario" value="<?php echo e($fk_formulario); ?>">
		<input type="hidden" name="id_version_formulario" id="id_version_formulario" value="<?php echo e($id_version_formulario); ?>">
		<input type="hidden" name="estado_registro" id="estado_registro" value="<?php echo e($estado_registro); ?>">
		<div class="portlet-body">
			<div class="panel panel-success">
				<div class="panel-heading">					
				</div>
				<div class="panel-body">					
					<div class="col-sm-2">
						<i class="fa fa-calendar" aria-hidden="true"></i>
						<label>Fecha Turno:</label>
					</div>
					<div class="col-sm-4">
						<input type="text" name="fecha_turno" id="fecha_turno" class="form-control" value="<?php echo e($Fecha_Actual); ?>" readonly >
					</div>				
					<div class="col-sm-2">
						<i class="fa fa-book" aria-hidden="true"></i>
						<label>Formulario:</label>
					</div>
					<div class="col-sm-4">
						<input type="text" name="" class="form-control" value="<?php echo e($Nombre_Formulario); ?>" readonly>
					</div>
					<br>
					<br>
					<br>					
					<div class="col-sm-2">
						<i class="fa fa-user" aria-hidden="true"></i>
						<label>Nombre Equipo:</label>
					</div>
					<div class="col-sm-4">
						<input type="text" name="" class="form-control" value="<?php echo e($NombreEquipo); ?>" readonly>
					</div>				
					<div class="col-sm-2">
						<i class="fa fa-clock-o" aria-hidden="true"></i>
						<label>Turno:</label>
					</div>
					<div class="col-sm-4">
						<input type="text" name="" class="form-control" value="<?php echo e($Nombre_Turno); ?>" readonly>
					</div>
					<input type="hidden" name="fk_equipos" id="fk_equipos" class="form-control" value="<?php echo e($fk_equipos); ?>">
				</div>
			</div>

			<div class="table-scrollable">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th scope="col" style="width:200px !important; background: #16d6fc">
								<i class="fa fa-cogs" aria-hidden="true"></i>
								Parametros
							</th>
							<th scope="col" style="width:200px !important; background: #16d6fc">
								<i class="fa fa-sitemap" aria-hidden="true"></i>
								Unidad
							</th>
							<th scope="col" style="width:150px !important; background: #16d6fc">
								<i class="fa fa-table" aria-hidden="true"></i>
								Valor Minimo
							</th>
							<th scope="col" style="width:150px !important; background: #16d6fc">
								<i class="fa fa-table" aria-hidden="true"></i>
								Valor Ideal
							</th>							
							<th scope="col" style="width:150px !important; background: #16d6fc">
								<i class="fa fa-table" aria-hidden="true"></i>
								Valor Máximo
							</th>
							<th scope="col" style="width:250px !important; background: #16d6fc">
								<i class="fa fa-keyboard-o" aria-hidden="true"></i>
								Valor a ingresar
							</th>
						</tr>
					</thead>
					<tbody>
						<input type="hidden" value="<?php echo e($numero = 1); ?>">
						<input type="hidden" value="<?php echo e($numero2 = 1); ?>">
						<input type="hidden" value="<?php echo e($numero3 = 1); ?>">
						<input type="hidden" value="<?php echo e($numero6 = 1); ?>">
						<?php foreach($Detalle_Formulario as $key => $value): ?>
						<tr>
							<td>
								<?php echo e($parametros_control=ucfirst($value->NombreParametro->nombre_parametro)); ?>

							</td>
							<td>
								<?php echo e($parametros_control=ucfirst($value->NombreUnidad->nombre_unidad)); ?>

							</td>
							<td>
								<?php echo e($parametros_control=$value->valor_minimo); ?>

							</td>
							<td>
								<?php echo e($parametros_control=$value->valor_ideal); ?>								
							</td>
							<td>
								<?php echo e($parametros_control=$value->valor_maximo); ?>

							</td>
							<td>
								<div class="panel panel-danger" style="display:none" id="mensaje_<?php echo e($numero2++); ?>">
									<div class="panel-heading" id="valida_<?php echo e($numero3++); ?>" style="display:none">
									</div>
								</div>
								<input type="number" name="variable_<?php echo e($numero++); ?>" id="variable_<?php echo e($numero6++); ?>" class="form-control">
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<button type="button" class="btn btn-circle blue BtnRegistrar">
				<strong> <font size ="2", color ="#f9f9f9"> <span class= "fa fa-floppy-o"></span></font></strong>
				<strong> <font size ="2", color ="#f9f9f9" face="Lucida Sans"><span>Guardar</span></font></strong>
			</button>
		</div>
	</div>		
</form>


<?php else: ?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<img src="global/images/No_Found_Formulario.png" alt="logo" class="img-thumbnail img-responsive" >	
</div>
<?php endif; ?>

