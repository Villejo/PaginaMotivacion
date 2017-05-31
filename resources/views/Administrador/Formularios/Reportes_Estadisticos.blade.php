@extends('layouts.master')
@section('title')
Reportes
@stop
@section('content')
<div class="panel" style="background: #4c9cb5">
	<div class="panel-heading">
		<h3 class="panel-title">
			<strong><font size ="3", color="#d3cabe" face="Tahoma">Generar GRAFICA</font></strong>
		</h3>
	</div>
	<div class="panel-body">
		<div  class="row" >
			<div class="col-md-3">				
				<strong>
					<font size ="3", color="#ffffff" face="Tahoma">
						<i class="fa fa-book fa-2x" aria-hidden="true"></i>
						Formulario
					</font>
				</strong>
				<select class="form-control selectpicker id_formulario" onchange="CambioEstado();" data-live-search="true" id="id_formulario" name="id_formulario"  autofocus>
					<option></option>
				</select>
			</div>
			<div class="col-md-3">
				<strong>
					<font size ="3", color="#ffffff" face="Tahoma">
						<i class="fa fa-cog fa-2x" aria-hidden="true"></i>
						Parametro
					</font>
				</strong>
				<select class="form-control selectpicker ParametroControll" onchange="CambioEstado();"  data-live-search="true" id="ParametroControl" name="ParametroControl">
					<option></option>
				</select>
			</div>
			<div class="col-md-2">
				<strong>
					<font size ="3", color="#ffffff" face="Tahoma">
						<i class="fa fa-hourglass-half fa-2x" aria-hidden="true"></i>
						Turno
					</font>
				</strong>
				<select class="form-control selectpicker TurnoControl" onchange="CambioEstado();"  data-live-search="true" id="TurnoControl" name="TurnoControl">
					<option></option>
				</select>
			</div>	
			<div class="col-md-2">
				<strong>
					<font size ="3", color="#ffffff" face="Tahoma">
						<i class="fa fa-calendar fa-2x" aria-hidden="true"></i>
						Año
					</font>
				</strong>
				<select class="form-control selectpicker AnoSelect" onchange="CambioEstado();"  data-live-search="true" id="AnoSelect" name="AnoSelect">
					<option value="2010" >2010</option>
					<option value="2011" >2011</option>
					<option value="2012" >2012</option>
					<option value="2013" >2013</option>
					<option value="2014" >2014</option>					
					<option value="2015" >2015</option>
					<option value="2016" >2016</option>
					<option value="2017" >2017</option>
					<option value="2018" >2018</option>
					<option value="2019" >2019</option>
					<option value="2020" >2020</option>
					<option value="2021" >2021</option>
					<option value="2022" >2022</option>
					<option value="2023" >2023</option>
					<option value="2024" >2024</option>
					<option value="2025" >2025</option>
				</select>				
			</div>
			<div class="col-md-2">
				<strong>
					<font size ="3", color="#ffffff" face="Tahoma">
						<i class="fa fa-calendar-times-o fa-2x" aria-hidden="true"></i>
						Mes
					</font>
				</strong>
				<select class="form-control selectpicker MesSelect" onchange="CambioEstado();" data-live-search="true" id="MesSelect" name="MesSelect">
					<option value="1">ENERO</option>
					<option value="2">FEBRERO</option>
					<option value="3">MARZO</option>
					<option value="4">ABRIL</option>
					<option value="5">MAYO</option>
					<option value="6">JUNIO</option>
					<option value="7">JULIO</option>
					<option value="8">AGOSTO</option>
					<option value="9">SEPTIEMBRE</option>
					<option value="10">OCTUBRE</option>
					<option value="11">NOVIEMBRE</option>
					<option value="12">DICIEMBRE</option>
				</select>				
			</div>	
		</div>
	</div>
</div>			
<div class="panel id_grafica_mostrar" style="display: none; background: #3ea50e">
	<div class="panel-heading">		
	</div>
	<div class="panel-body">
		<div id="id_grafica"></div>
	</div>
</div>
<label id="ID_oculto_formularioSeleccionado" style="display: none;"></label>



<script type="text/javascript">
	$('body').delegate('.sidebar-toggler','click',function(){	
		window.setTimeout(function(){ElaborarConsulta();},2);		
	});	
</script>


{{Form::input("hidden", "_token", csrf_token())}}

<script type="text/javascript">

	

	function CambioEstado(){
		var id_formulario = document.getElementById('id_formulario').value; 		
		var Id_ParametroControl =document.getElementById("ParametroControl").value;
		var Id_TurnoControl= document.getElementById("TurnoControl").value;
		var AnoSelect=document.getElementById("AnoSelect").value;
		var MesSelect=document.getElementById("MesSelect").value;

		var ID_oculto_formularioSeleccionado=$('#ID_oculto_formularioSeleccionado').text();
		$('#ID_oculto_formularioSeleccionado').text(id_formulario);

		if(id_formulario!=0 &&  Id_ParametroControl==0){			
			Parametros();
			// CargarTurnosRegistrados();
			$('TurnoControl').selectpicker('destroy');
			$("#ParametroControl" ).prop( "disabled", false );
			$("#ParametroControl").val('').selectpicker('refresh');
		}else{
			if(id_formulario!=0 &&  Id_ParametroControl!=0 && Id_TurnoControl==0){			
				RemoverDataCombobox(document.getElementById("TurnoControl"));
				$('TurnoControl').selectpicker('destroy');
				CargarTurnosRegistrados();
				$("#TurnoControl" ).prop( "disabled", false );
				$("#TurnoControl").val('').selectpicker('refresh');			
			}else{
				if(Id_ParametroControl!=0 && Id_TurnoControl==0){
					$("#TurnoControl" ).prop( "disabled", false );
					$("#TurnoControl").val('').selectpicker('refresh');
				}else{
					if(id_formulario!=ID_oculto_formularioSeleccionado){
						$("#ParametroControl").val('').selectpicker('refresh');					
						$("#TurnoControl").val('').selectpicker('refresh');					
						$('.id_grafica_mostrar').hide();										
					}else{
						ElaborarConsulta();			
					}
				}
			}
		}
	}
	function CargarTurnosRegistrados(){
		$el =$('#TurnoControl');		
		$.ajax({
			url   : "<?= URL::to('Cargar_Turnos_Registrados') ?>",
			type  : "GET",
			async : false,			
			success:function(respuesta){	
				var option = $('<option />');
				$.each(respuesta, function(key,value) {
					$el.append($("<option></option>")
						.attr("value", key).text(value));
				});							

				var options = $('.TurnoControl option');
				var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});				
			}
		});
	}
	function Cargar_Ano_Mes(){		

		$.ajax({
			url   : "<?= URL::to('Cargar_Ano_Mes_Reporte') ?>",
			type  : "GET",
			async : false,			
			success:function(respuesta){	
				$('select[name=AnoSelect]').val(respuesta.Ano);
				$('select[name=AnoSelect]').change();	
				$('select[name=MesSelect]').val(respuesta.Mes);
				$('select[name=MesSelect]').change();				
			}
		});
	}
	// function cargar_diseno(){
	// 	$.ajax({
	// 		type:'get',			
	// 		url:'{{ url('Cargar_Graficas')}}',
	// 		success: function(data){ 		
	// 			$('#id_grafica').empty().html(data);	
	// 		}         
	// 	});
	// }
	function Cargar_Nombres_Formularios(){
		$el =$('#id_formulario');
		var _token=$('#_token').val();		
		$.ajax({
			url   : "<?= URL::to('Listar_Formularios') ?>",
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

				var options = $('.id_formulario option');
				var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});
			}
		});
	}

	function Parametros(){
		var id_formulario = document.getElementById('id_formulario').value; 

		$el =$('#ParametroControl'); 		
		var _token=$('#_token').val();
		$.ajax({
			url   : "<?= URL::to('Listar_Parametros') ?>",
			type  : "POST",
			async : false,
			data  :{
				'_token'       	  : _token,
				'id_formulario'   : id_formulario
			},
			success:function(re){
				$('#ParametroControl option').remove(); 
				$('#ParametroControl').append($("<option></option>")
					.attr("value", 0).text(''));				
				var option = $('<option />');
				$.each(re, function(key,value) {
					$el.append($("<option></option>")
						.attr("value", key).text(value));
				});							

				var options = $('.ParametroControll option');
				var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});				
			}

		});


	}

	function Recargar_ParametroControl(){	
		$('#ParametroControl').val('').selectpicker('refresh');	
		$( "#ParametroControl" ).prop( "disabled", false );
		$('#ParametroControl').val('').selectpicker('refresh')
		$( "#TurnoControl" ).prop( "disabled", false );
		$('#TurnoControl').val('').selectpicker('refresh')
	}	
	function ElaborarConsulta(){

		var id_formulario=document.getElementById("id_formulario").value;

		var ParametroControl =$("#ParametroControl option:selected").text();
		var Id_ParametroControl =document.getElementById("ParametroControl").value;

		var AnoSelect=document.getElementById("AnoSelect").value;
		var MesSelect=document.getElementById("MesSelect").value;
		var Id_TurnoControl= document.getElementById("TurnoControl").value;
		var NombreTurno =$("#TurnoControl option:selected").text();	

		var _token=$('#_token').val();

		if(id_formulario!=0 || ParametroControl!=0){		

			$.ajax({
				url   : "<?= URL::to('Consultar_x_Fecha') ?>",
				type  : "POST",
				async : false,
				data  :{
					'_token'       	  		: _token,					
					'id_formulario'   		: id_formulario,
					'ParametroControl'		: ParametroControl,
					'Id_ParametroControl'	: Id_ParametroControl,
					'Id_TurnoControl'		: Id_TurnoControl,
					'NombreTurno'			: NombreTurno,												
					'AnoSelect'		  		: AnoSelect,
					'MesSelect'		  		: MesSelect				

				},
				success:function(data){
					$('#id_grafica').empty().html(data);	
				}
			});
		}
	}

	function OcultarGrafica(){
		var id_formulario=document.getElementById("id_formulario").value;		
		var Id_ParametroControl =document.getElementById("ParametroControl").value;
		var Id_TurnoControl= document.getElementById("TurnoControl").value;

		var ID_oculto_formularioSeleccionado=$('#ID_oculto_formularioSeleccionado').text();

		$('#ID_oculto_formularioSeleccionado').text(id_formulario);

		
		if(id_formulario!=0 && Id_ParametroControl==0 ){
			$('.id_grafica_mostrar').hide();
		}
		if(id_formulario==0 ){
			$('.id_grafica_mostrar').hide();
		}	

		if(Id_ParametroControl==0 ){
			$('.id_grafica_mostrar').hide();
		}
		if(Id_TurnoControl==0 ){
			$('.id_grafica_mostrar').hide();
		}

		if(id_formulario!=0){
			Parametros();
		}

		
		if(id_formulario!=ID_oculto_formularioSeleccionado){
			// $("#ParametroControl").val('').selectpicker('refresh');				
			$( "#ParametroControl" ).prop( "disabled", true );
			console.log('GOLO');	
			$('.id_grafica_mostrar').hide();			

		}


		DesactivarTurnoYParametro();
		// $('.id_grafica_mostrar').show();	
	}

	// CargarTurnosRegistrados();
	Cargar_Nombres_Formularios();
	Cargar_Ano_Mes();

	
	$( "#TurnoControl" ).prop( "disabled", true );
	$( "#ParametroControl" ).prop( "disabled", true );

	function RemoverDataCombobox(selectbox){
		var i;
		for(i = selectbox.options.length - 1 ; i >= 1 ; i--)
		{
			selectbox.remove(i);
		}
	}

</script>

<script src="global/graficas/highcharts2.js"></script>
<!-- <script src="http://code.highcharts.com/highcharts.js"></script> -->
<script src="global/graficas/exporting2.js"></script>
<!-- <script src="https://code.highcharts.com/modules/exporting.js"></script> -->

@stop