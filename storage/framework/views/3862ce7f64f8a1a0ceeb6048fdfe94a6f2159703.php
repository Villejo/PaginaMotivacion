<?php $__env->startSection('title'); ?>
Reportes - Maquinas
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i> <strong> REPORTES DAÑOS MÁQUINAS</strong>
	</div>
	<div class="panel-body">
		<div class="row col-md-offset-3">					
			<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">			
				<table class="table table-user-information">									
					<tbody>
						<center>							
							<b>
								<strong>									
									<font color="#0a80cc" face="Arial">
										<center><h2>Selecciona una máquina</h2>
											<select class="form-control selectpicker id_maquina" data-live-search="true" id="id_maquina" name="id_maquina" onchange="OcultarDatos();" autofocus>
												<option></option>
											</select>	
											<br><br>												</center>
										</font>
									</strong>
								</b>
							</center>
							<tr>
								<td>								
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Fecha Inicial:</font></strong></b>
								</td>
								<td>								
									<div class="form-group">				
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
											<input type="text" class="form-control form-filter input-sm" name="Fecha_Inicial" id="Fecha_Inicial"   placeholder="Fecha Inicial" value="<?php echo e(Carbon::today()->toDateString()); ?>" onchange="OcultarDatos();" readonly>
											<span class="input-group-btn">
												<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
									</div>
								</td>							
								<td>								
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Fecha Final:</font></strong></b>
								</td>
								<td>								
									<div class="form-group">				
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
											<input type="text" class="form-control form-filter input-sm" name="Fecha_Final" id="Fecha_Final" onchange="OcultarDatos();"   placeholder="Fecha Final" value="<?php echo e(Carbon::today()->toDateString()); ?>" readonly>
											<span class="input-group-btn">
												<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>							
						</tbody>
					</table>				
					<center>
						<button type="button" id="BuscarReporte" class="btn btn-circle BuscarReporte" style="background-color: #0578bf" title="BUSCAR REPORTE">
							<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>BUSCAR</span>
								<span class="fa fa-search"></span>
							</font></strong>
						</button>						
					</center>
					<br>
					<center><img src="global/images/loading.gif" height="100" id="LoadingGif" style="display: none;"></center>
					<br>
					<br>
					<div class="panel panel-default" id="estilo_mensaje" style="display: none;">
						<div class="panel-heading" id="id_validacion" style="display: none;" >
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		Cargar_Nombres_Equipos();
// Llama el combox para los equipos
function Cargar_Nombres_Equipos(){		

	$el =$('#id_maquina');


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

			var options = $('id_maquina option');
			var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
			arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
			options.each(function(i, o) {
				o.value = arr[i].v;
				$(o).text(arr[i].t);
			});					
		}

	});

}

function OcultarDatos(){
	$( ".BuscarReporte" ).prop( "disabled", false );
	$("#estilo_mensaje").hide();
	$('#id_validacion').html('');	
	$('#id_validacion').hide();	
	$("#estilo_mensaje").fadeTo(100, 500).slideUp(500, function(){
		$("#estilo_mensaje").hide();					
		$( ".BuscarReporte" ).prop( "disabled", false );
	}); 
}

$('.BuscarReporte').click(function(){
	var id_maquina= document.getElementById("id_maquina").value;
	var Fecha_Inicial =$('#Fecha_Inicial').val();
	var Fecha_Final =$('#Fecha_Final').val();
	$('#LoadingGif').hide();

	if(id_maquina==0){
		$("#id_validacion").css("fontSize", 15);						
		$("#id_validacion").css("font-weight","Bold"); 	
		$("#estilo_mensaje").attr("class", "panel panel-danger");
		$('#estilo_mensaje').show();		
		$('#id_validacion').html('<center>Debes seleccionar un máquina.</center>');	
		$('#id_validacion').show();	
		$('#id_maquina').selectpicker('toggle');	
		return true;
	}else{
		if(Fecha_Inicial==""){
			$("#id_validacion").css("fontSize", 15);						
			$("#id_validacion").css("font-weight","Bold"); 	
			$("#estilo_mensaje").attr("class", "panel panel-danger");
			$('#estilo_mensaje').show();				
			$('#id_validacion').html('<center>Debes seleccionar una Fecha Inicial.</center>');	
			$('#id_validacion').show();	
			$('#Fecha_Inicial').selectpicker('toggle');	
			return true;
		}else{
			if(Fecha_Final==""){
				$("#id_validacion").css("fontSize", 15);						
				$("#id_validacion").css("font-weight","Bold"); 	
				$("#estilo_mensaje").attr("class", "panel panel-danger");
				$('#estilo_mensaje').show();					
				$('#id_validacion').html('<center>Debes seleccionar una Fecha Final.</center>');	
				$('#id_validacion').show();	
				$('#Fecha_Final').selectpicker('toggle');	
				return true;
			}else{
				inicio= new Date(Fecha_Inicial);
				final= new Date(Fecha_Final);
				if(inicio>final){
					$("#id_validacion").css("fontSize", 15);						
					$("#id_validacion").css("font-weight","Bold"); 	
					$("#estilo_mensaje").attr("class", "panel panel-danger");
					$('#estilo_mensaje').show();					
					$('#id_validacion').html('<center>La fecha inicial no puede ser mayor a la fecha final.</center>');	
					$('#id_validacion').show();							
					return true;
				}else{
					$('#estilo_mensaje').hide();
					$('#id_validacion').hide();
					Consultar_Reporte();
					$( ".BuscarReporte" ).prop( "disabled", true );
					$('#LoadingGif').show();
					return false;
				}
			}
		}
	}
});



function Consultar_Reporte(){
	var id_maquina= document.getElementById("id_maquina").value;
	var Fecha_Inicial =$('#Fecha_Inicial').val();
	var Fecha_Final =$('#Fecha_Final').val();
	

	$.ajax({
		type:'GET',
		data: {
			'id_maquina' 	: id_maquina,
			'Fecha_Inicial' : Fecha_Inicial,
			'Fecha_Final' 	: Fecha_Final	
		},
		url:'<?php echo e(url('GenerarReporteDanoMaquinas')); ?>',
		success: function(respuesta){      
			if(respuesta==1){ 				 
				$("#id_validacion").css("fontSize", 15);						
				$("#id_validacion").css("font-weight","Bold"); 	
				$("#estilo_mensaje").attr("class", "panel panel-danger");
				$('#estilo_mensaje').show();			
				$('#id_validacion').html('<center>No se encontró ningún resultado. <i class="fa fa-frown-o fa-2x" aria-hidden="true"></i></center>');	
				$('#id_validacion').show();	     
				$("#estilo_mensaje").fadeTo(5000, 500).slideUp(500, function(){
					$("#estilo_mensaje").hide();					
					$( ".BuscarReporte" ).prop( "disabled", false );
				});
				$('#LoadingGif').hide();					
			}else{
				var ruta= respuesta.path;				 
				$("#id_validacion").css("fontSize", 15);						
				$("#id_validacion").css("font-weight","Bold"); 	
				$("#estilo_mensaje").attr("class", "panel panel-success");
				$('#estilo_mensaje').show();			
				$('#id_validacion').html('<center><strong> <font size ="3", color="#ffffff" face="Lucida Sans"><span class="fa fa-download fa-2x"></span></font></strong> <a href='+ruta+' download='+ruta+' title="Descargar PDF"> <strong><font size ="3", color="#ffffff" face="Lucida Sans">Descargar</font></strong> </center>');
				$('#id_validacion').show();	     
				$("#estilo_mensaje").fadeTo(55000, 500).slideUp(500, function(){
					$("#estilo_mensaje").hide();
					$( ".BuscarReporte" ).prop( "disabled", false );

					window.setTimeout(function(){ElminiarArchivoExportado(respuesta.RutaArchivo);},10000);
					console.clear();				
				}); 

				$('#LoadingGif').hide();
				$('#id_maquina').val('').selectpicker('refresh');
				$( ".BuscarReporte" ).prop( "disabled", false );
			}
		}
	});
}

function ElminiarArchivoExportado($ruta){
	$.ajax({
		url   : "<?= URL::to('delete_archivo_exportado') ?>",
		type  : "GET",
		async : false,		
		data: {
			'ruta' :$ruta												
		}

	});
	console.clear();
}




</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>