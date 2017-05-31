@extends('layouts.master')
@section('title')
Menú Principal
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
			<a href="#">Panel de Inicio</a>			
		</li>
	</ul>	
</div>
<br>
<br>
<br>
<div class="panel panel-danger" style="display: none;" id="estilo_mensaje_registro">
	<div class="panel-heading" id="id_validacion_registro" style="display:none">
	</div>
</div>
<div class="row">
	<div class="col-md-12">		
		<div class="panel panel-default EstiloMensajeSinInactividad pulsate-regular
		pulsate-regular" id="pulsate-regular" style="display: none;text-align: right;">
		<div class="panel-heading MensajeSinInactividad" style="display: none;" >
		</div>
	</div>

	<!-- Begin: life time stats -->
	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-plus-circle font-green-sharp"></i>
				<span class="caption-subject font-green-sharp bold uppercase">
					REGISTRO DE RUTAS </span>
					<span class="caption-helper"></span>
				</div>
					<!-- <div class="actions">
						<div class="btn-group">
							<a class="btn btn-default btn-circle" href="javascript:;" data-toggle="dropdown">
								<i class="fa fa-cog"></i>
								<span class="hidden-480">
									Herramientas </span>
									<i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu pull-right">
									<li>
										<a href="javascript:;">
											Exportar a Excel </a>
										</li>
										<li>
											<a href="javascript:;">
												Exportar a CSV </a>
											</li>
											<li>
												<a href="javascript:;">
													Exportar a XML </a>
												</li>
												<li class="divider">
												</li>
											</ul>
										</div>
									</div> -->
								</div>
								<div class="portlet-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-lg">
											<!-- <li class="active"> -->
											<a href="#pestaña_registro" data-toggle="tab">
											</a>
											<!-- </li> -->
										</ul>
										<div class="tab-content">
											<div class="tab-pane active" id="pestaña_registro">
											</div>
											<div class="tab-pane" id="pestaña_detalle">
											</div>
											<div class="tab-pane" id="pestaña_consolidado">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Modal Confirmar -->
					<div class="modal fade" id="ModalRegistrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="myModalLabel">Esperando Confirmación...</h4>
								</div>
								<div class="modal-body">
									¿ Esta seguro de guardar la información ingresada ?
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary BtnRegistrarDatos">SI</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
								</div>
							</div>
						</div>
					</div>
					

					<script type="text/javascript">
						Cargar_Formulario();
						
						function Cargar_Formulario(){
							$.ajax({
								type:'get',
								url:'{{ url('Cargar_Formulario')}}',
								success: function(data){
									$('#pestaña_registro').empty().html(data);
								}
							});
						}

						function Validar_Vacios(){
							var variable_1=$('#variable_1').val();
							var variable_2=$('#variable_2').val();
							var variable_3=$('#variable_3').val();
							var variable_4=$('#variable_4').val();
							var variable_5=$('#variable_5').val();
							var variable_6=$('#variable_6').val();
							var variable_7=$('#variable_7').val();
							var variable_8=$('#variable_8').val();
							var variable_9=$('#variable_9').val();
							var variable_10=$('#variable_10').val();
							var variable_11=$('#variable_11').val();
							var variable_12=$('#variable_12').val();
							var variable_13=$('#variable_13').val();
							var variable_14=$('#variable_14').val();
							var variable_15=$('#variable_15').val();
							var variable_16=$('#variable_16').val();

							if(variable_1==""){
								$('#valida_1').html('');
								$("#valida_1").css("fontSize", 15);						
								$("#valida_1").css("font-weight","Bold"); 	
								$("#mensaje_1").attr("class", "panel panel-danger");
								$('#mensaje_1').show();			
								$('#valida_1').html('Este campo no puede estar vacio.');
								$('#valida_1').show();	
								$('#variable_1').val('');		
								document.getElementById("variable_1").focus();
								return true;
							}else if(variable_2==""){
								$('#mensaje_1').hide();									
								$('#valida_2').html('');
								$("#valida_2").css("fontSize", 15);						
								$("#valida_2").css("font-weight","Bold"); 	
								$("#mensaje_2").attr("class", "panel panel-danger");
								$('#mensaje_2').show();			
								$('#valida_2').html('Este campo no puede estar vacio.');
								$('#valida_2').show();	
								$('#variable_2').val('');		
								document.getElementById("variable_2").focus();
								return true;
							}else if(variable_3==""){
								$('#mensaje_2').hide();									
								$('#valida_3').html('');
								$("#valida_3").css("fontSize", 15);						
								$("#valida_3").css("font-weight","Bold"); 	
								$("#mensaje_3").attr("class", "panel panel-danger");
								$('#mensaje_3').show();			
								$('#valida_3').html('Este campo no puede estar vacio.');
								$('#valida_3').show();	
								$('#variable_3').val('');		
								document.getElementById("variable_3").focus();
								return true;
							}else if(variable_4==""){
								$('#mensaje_3').hide();									
								$('#valida_4').html('');
								$("#valida_4").css("fontSize", 15);						
								$("#valida_4").css("font-weight","Bold"); 	
								$("#mensaje_4").attr("class", "panel panel-danger");
								$('#mensaje_4').show();			
								$('#valida_4').html('Este campo no puede estar vacio.');
								$('#valida_4').show();	
								$('#variable_4').val('');		
								document.getElementById("variable_4").focus();
								return true;
							}else if(variable_5==""){
								$('#mensaje_4').hide();									
								$('#valida_5').html('');
								$("#valida_5").css("fontSize", 15);						
								$("#valida_5").css("font-weight","Bold"); 	
								$("#mensaje_5").attr("class", "panel panel-danger");
								$('#mensaje_5').show();			
								$('#valida_5').html('Este campo no puede estar vacio.');
								$('#valida_5').show();	
								$('#variable_5').val('');		
								document.getElementById("variable_5").focus();
								return true;
							}else if(variable_6==""){
								$('#mensaje_5').hide();									
								$('#valida_6').html('');
								$("#valida_6").css("fontSize", 15);						
								$("#valida_6").css("font-weight","Bold"); 	
								$("#mensaje_6").attr("class", "panel panel-danger");
								$('#mensaje_6').show();			
								$('#valida_6').html('Este campo no puede estar vacio.');
								$('#valida_6').show();	
								$('#variable_6').val('');		
								document.getElementById("variable_6").focus();
								return true;
							}else if(variable_7==""){
								$('#mensaje_6').hide();									
								$('#valida_7').html('');
								$("#valida_7").css("fontSize", 15);						
								$("#valida_7").css("font-weight","Bold"); 	
								$("#mensaje_7").attr("class", "panel panel-danger");
								$('#mensaje_7').show();			
								$('#valida_7').html('Este campo no puede estar vacio.');
								$('#valida_7').show();	
								$('#variable_7').val('');		
								document.getElementById("variable_7").focus();
								return true;
							}else if(variable_8==""){
								$('#mensaje_7').hide();									
								$('#valida_8').html('');
								$("#valida_8").css("fontSize", 15);						
								$("#valida_8").css("font-weight","Bold"); 	
								$("#mensaje_8").attr("class", "panel panel-danger");
								$('#mensaje_8').show();			
								$('#valida_8').html('Este campo no puede estar vacio.');
								$('#valida_8').show();	
								$('#variable_8').val('');		
								document.getElementById("variable_8").focus();
								return true;	
							}else if(variable_9==""){
								$('#mensaje_8').hide();									
								$('#valida_9').html('');
								$("#valida_9").css("fontSize", 15);						
								$("#valida_9").css("font-weight","Bold"); 	
								$("#mensaje_9").attr("class", "panel panel-danger");
								$('#mensaje_9').show();			
								$('#valida_9').html('Este campo no puede estar vacio.');
								$('#valida_9').show();	
								$('#variable_9').val('');		
								document.getElementById("variable_9").focus();
								return true;
							}else if(variable_10==""){
								$('#mensaje_9').hide();									
								$('#valida_10').html('');
								$("#valida_10").css("fontSize", 15);						
								$("#valida_10").css("font-weight","Bold"); 	
								$("#mensaje_10").attr("class", "panel panel-danger");
								$('#mensaje_10').show();			
								$('#valida_10').html('Este campo no puede estar vacio.');
								$('#valida_10').show();	
								$('#variable_10').val('');		
								document.getElementById("variable_10").focus();
								return true;
							}else if(variable_11==""){
								$('#mensaje_10').hide();									
								$('#valida_11').html('');
								$("#valida_11").css("fontSize", 15);						
								$("#valida_11").css("font-weight","Bold"); 	
								$("#mensaje_11").attr("class", "panel panel-danger");
								$('#mensaje_11').show();			
								$('#valida_11').html('Este campo no puede estar vacio.');
								$('#valida_11').show();	
								$('#variable_11').val('');		
								document.getElementById("variable_11").focus();
								return true;
							}else if(variable_12==""){
								$('#mensaje_11').hide();									
								$('#valida_12').html('');
								$("#valida_12").css("fontSize", 15);						
								$("#valida_12").css("font-weight","Bold"); 	
								$("#mensaje_12").attr("class", "panel panel-danger");
								$('#mensaje_12').show();			
								$('#valida_12').html('Este campo no puede estar vacio.');
								$('#valida_12').show();	
								$('#variable_12').val('');		
								document.getElementById("variable_12").focus();
								return true;
							}else if(variable_13==""){
								$('#mensaje_12').hide();									
								$('#valida_13').html('');
								$("#valida_13").css("fontSize", 15);						
								$("#valida_13").css("font-weight","Bold"); 	
								$("#mensaje_13").attr("class", "panel panel-danger");
								$('#mensaje_13').show();			
								$('#valida_13').html('Este campo no puede estar vacio.');
								$('#valida_13').show();	
								$('#variable_13').val('');		
								document.getElementById("variable_13").focus();
								return true;
							}else if(variable_14==""){
								$('#mensaje_13').hide();									
								$('#valida_14').html('');
								$("#valida_14").css("fontSize", 15);						
								$("#valida_14").css("font-weight","Bold"); 	
								$("#mensaje_14").attr("class", "panel panel-danger");
								$('#mensaje_14').show();			
								$('#valida_14').html('Este campo no puede estar vacio.');
								$('#valida_14').show();	
								$('#variable_14').val('');		
								document.getElementById("variable_14").focus();
								return true;
							}else if(variable_15==""){
								$('#mensaje_14').hide();									
								$('#valida_15').html('');
								$("#valida_15").css("fontSize", 15);						
								$("#valida_15").css("font-weight","Bold"); 	
								$("#mensaje_15").attr("class", "panel panel-danger");
								$('#mensaje_15').show();			
								$('#valida_15').html('Este campo no puede estar vacio.');
								$('#valida_15').show();	
								$('#variable_15').val('');		
								document.getElementById("variable_15").focus();
								return true;
							}else if(variable_16==""){
								$('#mensaje_15').hide();									
								$('#valida_16').html('');
								$("#valida_16").css("fontSize", 15);						
								$("#valida_16").css("font-weight","Bold"); 	
								$("#mensaje_16").attr("class", "panel panel-danger");
								$('#mensaje_16').show();			
								$('#valida_16').html('Este campo no puede estar vacio.');
								$('#valida_16').show();	
								$('#variable_16').val('');		
								document.getElementById("variable_16").focus();
								return true;
							}else{
								$('#mensaje_1').hide();
								$('#mensaje_2').hide();
								$('#mensaje_3').hide();
								$('#mensaje_4').hide();
								$('#mensaje_5').hide();
								$('#mensaje_6').hide();
								$('#mensaje_7').hide();
								$('#mensaje_8').hide();
								$('#mensaje_9').hide();
								$('#mensaje_10').hide();
								$('#mensaje_11').hide();
								$('#mensaje_12').hide();
								$('#mensaje_13').hide();
								$('#mensaje_14').hide();
								$('#mensaje_15').hide();
								$('#mensaje_16').hide();
								return false;
							}
						}


						$('body').delegate('.BtnRegistrar','click',function(){								
							if(Validar_Vacios()!==true){
								$('#ModalRegistrar').modal('show');
								$('.BtnRegistrarDatos').click(function(){

									$.ajax({
										url:'Registrar_Consolidado',
										data:new FormData($("#id_formulario_consolidado")[0]),
										dataType:'json',
										async:false,
										type:'post',
										processData: false,
										contentType: false,
										success:function(respuesta){											
											if(respuesta==0){
												$('#ModalRegistrar').modal('hide');
												$("#estilo_mensaje_registro").attr("class", "panel panel-success");
												$('#id_validacion_registro').html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> La ruta se registró con éxito!!');
												$("#id_validacion_registro").css("fontSize", 15);					
												$("#id_validacion_registro").css("font-weight","Bold"); 		
												$('#estilo_mensaje_registro').show();
												$('#id_validacion_registro').show();
												$("#estilo_mensaje_registro").fadeTo(4500, 500).slideUp(500, function(){
													$("#estilo_mensaje_registro").hide();												
												});	
												Cargar_Formulario();
											}			
										}
									});
								});
							}
						});	
					</script>	

					<script src="global/scripts/Pulso.js"></script>
					<script type="text/javascript">
						// $('#pulsate-regular').pulsate();


						$("#pulsate-regular").pulsate({color:"#ee000c"});						
					</script>
					@stop
