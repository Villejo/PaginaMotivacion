<form class="form-horizontal" enctype="multipart/form-data" id="id_formulario_principal" role="form" method="POST" action="" >
	<input type="hidden" name="Ultimo_id_version_Nuevo_Formulario" id="Ultimo_id_version_Nuevo_Formulario" value="<?php echo e($Ultimo_id_version_Nuevo_Formulario); ?>">
	<input type="hidden" name="Ultimo_id_version_Nuevo_Registro" id="Ultimo_id_version_Nuevo_Registro" value="<?php echo e($Ultimo_id_version_Nuevo_Registro); ?>">
	<input type="hidden" name="estado_registro_version" id="estado_registro_version" value="Activo">
	<input type="hidden" name="TotalRegistros" id="TotalRegistros" value="<?php echo e($detalleFormulario->total()); ?>">
	<input type="hidden" name="fk_formulario" id="fk_formulario" value="<?php echo e($id_formulario_mostrar); ?>">	
	<?php if($detalleFormulario->total()==0): ?>
	<script type="text/javascript">	
		$('.id_tabla_mostrar').hide();	
		$('body').delegate('.id_formulario_mostrar','click',function(){	
			var id_formulario_mostrar =($(this).attr('id_formulario_mostrar'));
			if(id_formulario_mostrar==0){
				$('.btnNuevoRegistroDetalle').hide();	
				$('.EditarFormulario').show();
			}

		});

	</script>
	<?php else: ?>
	<script type="text/javascript">	
		$('.id_tabla_mostrar').show();	
		<?php if($detalleFormulario->total()==16): ?>
		$('.btnNuevoRegistroDetalle').hide();
		<?php else: ?>
		$('.btnNuevoRegistroDetalle').show();
		<?php endif; ?>

		$( ".BtnEliminarDetalle" ).prop( "disabled", true );
		$( ".BtnActualizarDetalle" ).prop( "disabled", true );	
		$( ".BtnRegistrarNuevaVersionFormulario" ).prop( "disabled", true );	
		
	</script>
	<div class="panel panel-info">	
		<div class="portlet-title">
			<div class="panel-heading" style="background-color: #1c6a9e">
				<h3 class="panel-title">
					<strong>
						<font size ="3", color="#f4f4f4" face="Tahoma">
							Editando Formulario
						</font>
					</strong>	
					<div class="pull-right" style="background-color: #000000">
					<font size ="4", color="#ffffff" face="Segoe UI Black">
							<strong>(Registros Permitidos  <?php echo e($detalleFormulario->total()); ?>  de  40)</strong>
						</font>
					</div>		
				</h3>

			</div>		
		</div>	
		<div class="table-scrollable">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th scope="col" style="width:100px !important">
							
						</th>
						<th scope="col" style="width:300px !important">
							Variable
						</th>
						<th scope="col" style="width:300px !important">
							Unidad
						</th>												
						<th scope="col" style="width:100px !important">
							Valor Mínimo
						</th>
						<th scope="col" style="width:100px !important">
							Valor Ideal
						</th>
						<th scope="col" style="width:100px !important">
							Valor Máximo
						</th>
						<th scope="col" style="width:100px !important">
							Panel Opciones
						</th>					
					</tr>
				</thead>
				<tbody>
					<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">  
					<input type="hidden" value="<?php echo e($numero1 = 1); ?>">
					<input type="hidden" value="<?php echo e($numero2 = 1); ?>">
					<input type="hidden" value="<?php echo e($numero3 = 1); ?>">
					<input type="hidden" value="<?php echo e($numero4 = 1); ?>">
					<input type="hidden" value="<?php echo e($numero5 = 1); ?>">
					<input type="hidden" value="<?php echo e($numero6 = 1); ?>">
					<input type="hidden" value="<?php echo e($numero7 = 1); ?>">
					<?php foreach($detalleFormulario as $key => $value): ?>
					<tr>
						<td>							
							<i class="fa fa-check" aria-hidden="true"></i>
							No. <?php echo e($numero6++); ?>

						</td>
						<td>
							<input type="text" name="nombre_parametro_<?php echo e($numero1++); ?>" class="form-control" value="<?php echo e($parametros_control=ucfirst($value->NombreParametro->nombre_parametro)); ?>" disabled>
						</td>
						<td>
							<input type="text" name="unidad_<?php echo e($numero3++); ?>" class="form-control" value="<?php echo e($parametros_control=ucfirst($value->NombreUnidad->nombre_unidad)); ?>" disabled>

						</td>
						<td>
							<input type="number" name="alarma_<?php echo e($numero4++); ?>" class="form-control" value="<?php echo e($parametros_control=$value->valor_minimo); ?>">
						</td>
						<td>
							<input type="text" name="porcentaje_minimo_<?php echo e($numero2++); ?>" class="form-control" value="<?php echo e($parametros_control=$value->valor_ideal); ?>">
						</td>					
						<td>
							<input type="number" name="disparo_<?php echo e($numero5++); ?>" class="form-control" value="<?php echo e($parametros_control=$value->valor_maximo); ?>">

						</td>
						<td>
							<button  style="background-color: #06b3e2" title="Editar Detalle" type="button" class="btn btn-circle  BtnActualizarDetalle" id_editar_registro="<?php echo e($parametros_control=$value->id); ?>" 
								parametros_editar="<?php echo e($parametros_control=$value->parametros_control); ?>"
								unidad="<?php echo e($parametros_control=$value->unidad); ?>"
								porcentaje_minimo="<?php echo e($parametros_control=$value->valor_ideal); ?>"
								alarma="<?php echo e($parametros_control=$value->valor_minimo); ?>"
								disparo="<?php echo e($parametros_control=$value->valor_maximo); ?>" disa>
								<strong> <font size ="2", color ="#ffffff"> <span class="fa fa-pencil-square-o""></span></font></strong>
								<strong > <font size ="2", color ="#ffffff"  face="Lucida Sans"><span></span></font></strong>
							</button>

							<button  id="id_btn_eliminar_detalle" style="background-color: #ff0000" title="Eliminar Detalle" type="button" class="btn btn-circle  BtnEliminarDetalle" id_eliminar_registro="<?php echo e($value->id); ?>">								
								<strong> <font size ="2", color ="#ffffff"> <span class="fa fa-trash-o""></span></font></strong>
								<strong > <font size ="2", color ="#ffffff"  face="Lucida Sans"><span></span></font></strong>
							</button>
						</td>					
					</tr>
					<?php endforeach; ?>						

				</tbody>
			</table>
		</div>		
	</div>
	<button type="button" class="btn btn-circle blue BtnRegistrarNuevaVersionFormulario" TotalRegistros="<?php echo e($detalleFormulario->total()); ?>">
		<strong> <font size ="2", color ="#ffffff"> <span class= "fa fa-file-text"></span></font></strong>
		<strong > <font size ="2", color ="#ffffff"  face="Lucida Sans"><span>Crear Nueva Version</span></font></strong>
	</button>
</div>
<?php endif; ?>

</form>