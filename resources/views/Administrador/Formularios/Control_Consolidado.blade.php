@extends('layouts.master')
@section('title')
Reportes
@stop
@section('content')
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
		<div class="panel panel-primary" >
			<div class="panel-heading" style="background-color: #321a7c" >
				<h3 class="panel-title">
					<strong> <CENTER> INFORMACION REGISTRO DE RUTAS</CENTER></strong>
				</h3>
			</div>
			<div class="panel-body">				
				<div class="row">
					<div class="col-md-3">
						<input type="checkbox" onchange="DectetarCambioCheckBos();" class="CheckBossUser" name="CheckBossUser" id="CheckBossUser" data-on-text="ACTIVO" data-off-text="INACTIVO">
					</div>
					<div class="col-md-3">
						<div id="Mensaje_Estado_Usuarios" style="display: block; border: 1px solid;border-radius: 5px;padding: 1px;"">						
						</div>					
					</div>
					<br><br>				
				</div>
				<div class="col-md-3"  style="background-color:#0489B1; border: 1px solid;border-color:#000000;padding: 1px" >
					<br>				
					<center>
						<strong>
							<font  size ="2", color="#000000" face="Tahoma">
								<i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i>
								USUARIO
							</font>
						</strong>
					</center>
					<br>
					<select onchange="Cargar_turnos_usuarios();"  class="form-control selectpicker id_select_usuario"  data-live-search="true" id="id_select_usuario"  name="id_select_usuario"  >
						<option></option>
					</select>
				</div>
				<div class="col-md-2"  style="background-color: #0489B1; border: 1px solid;border-color:#000000;padding: 1px">
					<br>				
					<center>
						<strong>
							<font size ="2", color="#000000" face="Tahoma">
								<i class="fa fa-hourglass-half fa-2x" aria-hidden="true"></i>
								TURNO
							</font>
						</strong>
					</center>
					<br>
					<select onchange="Listar_Formularios();" class="form-control selectpicker id_select_turno"  data-live-search="true" id="id_select_turno"  name="id_select_turno"  >
						<option></option>
					</select>
				</div>
				<div class="col-md-3"  style=" background-color: #0489B1; border: 1px solid;border-color:#000000;padding: 1px">
					<br>				
					<center>
						<strong>
							<font size ="2", color="#000000" face="Tahoma">
								<i class="fa fa-book fa-2x" aria-hidden="true"></i>
								FORMULARIO
							</font>
						</strong>
					</center>
					<br>
					<select onchange="Cargar_Tabla_Control_consolidado();" disabled="true" class="form-control selectpicker id_select_formulario"  data-live-search="true" id="id_select_formulario"  name="id_select_formulario"  >
						<option></option>
					</select>
				</div>			
				<div  class="col-md-2"  style="background-color: #0489B1; border: 1px solid;border-color:#000000;">
					<br>				
					<center>
						<strong>
							<font size ="2", color="#000000" face="Tahoma">

								FECHA INICIO
							</font>
						</strong>
					</center>
					<br>
					<div class="form-group">				
						<div class="input-group date date-picker margin-bottom-1" data-date-format="yyyy-mm-dd">
							<input type="text" class="form-control form-filter input-sm" name="Fecha_Inicial" id="Fecha_Inicial"   placeholder="Fecha Inicial" value="{{Carbon::today()->toDateString()}}" readonly>
							<span class="input-group-btn">
								<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
							</span>
						</div>
					</div>
				</div>

				<div class="col-md-2"  style="background-color: #0489B1; border: 1px solid;border-color:#000000;">
					<br>				
					<center>
						<strong>
							<font size ="2", color="#000000" face="Tahoma">
								FECHA FIN
							</font>
						</strong>
					</center>
					<br>
					<div class="form-group">				
						<div class="input-group date date-picker margin-bottom-1" data-date-format="yyyy-mm-dd">
							<input type="text" class="form-control form-filter input-sm" name="Fecha_Final" id="Fecha_Final"   placeholder="Fecha Final" value="{{Carbon::today()->toDateString()}}" readonly>
							<span class="input-group-btn">
								<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
<!-- <div class="row"> -->
<div id="Tabla_consolidados">

</div>
<!-- </div> -->
<!-- <div class="row">
	
</div> -->
<div style="display: none;" id="Tabla_consolidados">

</div>

<script type="text/javascript">
	// pintar_tabla_consolidados();



	function DectetarCambioCheckBos() {	
		$("[name='CheckBossUser']").bootstrapSwitch();		
		var CheckBossUser     = $("[name='CheckBossUser']").bootstrapSwitch('state');
		if(CheckBossUser==true){
			CheckBossUser='Activo';				
			$("#Mensaje_Estado_Usuarios").css({"fontSize":15, "font-weight":"Bold","background-color":"#00FF40"});
			$('#Mensaje_Estado_Usuarios').html('<center><strong>- USUARIOS ACTIVOS - </strong></center>');
			$('#Mensaje_Estado_Usuarios').show();			
		}else{
			CheckBossUser='Inactivo';
			$("#Mensaje_Estado_Usuarios").css({"fontSize":15, "font-weight":"Bold","background-color":"#FF0000"});
			$('#Mensaje_Estado_Usuarios').html('<center><strong>- USUARIOS INACTIVOS - </strong></center>');
			$('#Mensaje_Estado_Usuarios').show();
		}
		$('.id_select_usuario').selectpicker('destroy');
		Cargar_datos_usuarios_combo(CheckBossUser);
		$('.id_select_usuario').selectpicker("refresh");
		$( "#id_select_formulario" ).prop( "disabled", false );
		$('#id_select_formulario').val('').selectpicker('refresh');
	}

	function Cargar_datos_usuarios_combo(estado){
		$el =$('.id_select_usuario');
		$.ajax({
			url   : "<?= URL::to('Listar_datos_usuarios_Activos_R') ?>",
			type  : "GET",
			async : false,
			data  :{				
				'estado'       	  : estado
			},
			success:function(response){				
				RemoverDataCombobox(document.getElementById("id_select_usuario"));
				var option = $('<option />');									
				$.each(response, function(key,value) {
					$el.append($("<option></option>")
						.attr("value", key).text(value));
				});									

				var options = $('.id_select_usuario option');
				var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});

			}
		});
		$('#Tabla_consolidados').hide();

		window.setTimeout(function(){$( "#id_select_turno" ).prop( "disabled", true );$('#id_select_turno').val('').selectpicker('refresh');$('#id_select_usuario').val('').selectpicker('refresh');$( "#id_select_formulario" ).prop( "disabled", true );
			$('#id_select_formulario').val('').selectpicker('refresh');},1000);		
	}

	CargarMesActual();
	function CargarMesActual(){
		$.ajax({
			url   : "<?= URL::to('CargarMesActual_R') ?>",
			type  : "GET",
			async : false,		
			success:function(re){
				console.log(re);
				$('#Fecha_Inicial').val(re.FechaInicial);
				$('#Fecha_Final').val(re.FechaFinal);
			}
		});
	}


	function Cargar_turnos_usuarios(){	
		$( "#id_select_turno" ).prop( "disabled", false );
		var id_usuario_selecc=document.getElementById("id_select_usuario").value;
		RemoverDataCombobox(document.getElementById("id_select_turno"));
		$el =$('#id_select_turno'); // nombre del select
		var _token=$('#_token').val();
		$.ajax({
			url   : "<?= URL::to('Listar_datos_turnos_R') ?>",
			type  : "POST",
			async : false,
			data  :{
				'_token'       	       : _token,
				'id_usuario_selecc'    :  id_usuario_selecc	
			},
			success:function(re){
				var option = $('<option />');

				$.each(re, function(key,value) {
					$el.append($("<option></option>")
						.attr("value", key).text(value));
				});

				var options = $('id_select_turno option');
				var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});
			}
		});
		$('#id_select_turno').val('').selectpicker('refresh');
		$('#Tabla_consolidados').hide();
	}

	function RemoverDataCombobox(selectbox){
		var i;
		for(i = selectbox.options.length - 1 ; i >= 1 ; i--)
		{
			selectbox.remove(i);
		}
	}

	function Listar_Formularios(){	

		$( "#id_select_formulario" ).prop( "disabled", false );


		var id_usuario_selecc=document.getElementById("id_select_usuario").value;
		var id_turno_selecc=document.getElementById("id_select_turno").value;

		RemoverDataCombobox(document.getElementById("id_select_formulario"));
		$el =$('#id_select_formulario'); // nombre del select
		var _token=$('#_token').val();
		$.ajax({
			url   : "<?= URL::to('Listar_Formularios_R') ?>",
			type  : "POST",
			async : false,
			data  :{
				'_token'       	       : _token,
				'id_usuario_selecc'    :  id_usuario_selecc,
				'id_turno_selecc'    :  id_turno_selecc		
			},
			success:function(re){
				var option = $('<option />');

				$.each(re, function(key,value) {
					$el.append($("<option></option>")
						.attr("value", key).text(value));
				});

				var options = $('id_select_formulario option');
				var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});
			}
		});

		$('#id_select_formulario').val('').selectpicker('refresh');
		$('#Tabla_consolidados').hide();

		
	}
//------------------------fin combo formularios-----------------------


//--------------------------- todo lo de tabla ----------


function Cargar_Tabla_Control_consolidado(){
	// alert('Cargar_Tabla_Control_consolidado');
	var _token=$('#_token').val();

	var id_usuario_selecc=document.getElementById("id_select_usuario").value;
	var id_turno_selecc=document.getElementById("id_select_turno").value;
	var fecha1= document.getElementById("Fecha_Inicial").value;
	var fecha2= document.getElementById("Fecha_Final").value;

	// alert('ww'+id_usuario_selecc+'qqq'+id_turno_selecc+'qqq'+fecha1+'qqq'+fecha1);

	$.ajax({
		type:'GET',
		data: {
			'_token' : _token,
			'id_usuario_selecc' : id_usuario_selecc,
			'id_turno_selecc' : id_turno_selecc,
			'fecha1' : fecha1,
			'fecha2' : fecha2
		},
		url:'{{ url('cargar_tabla_control_consolido_R')}}',
		success: function(data){
			console.log(data);      
			$('#Tabla_consolidados').empty().html(data);
			$('#Tabla_consolidados').show();
		}
	});

	

}

$(document).on("click",".pagination li a",function(e) {
		e.preventDefault();		
		var url = $(this).attr("href");
		$.ajax({
			type:'get',
			url:url,			
			success: function(data){
				$('#Tabla_consolidados').empty().html(data);				
			}
		});
	});

//--------------------------------fin tabla -------------


</script>

@stop
