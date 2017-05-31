@if($Listado_Unidades->total()==0)
<div class="panel panel-info pulsate-regular2" id="pulsate-regular2">		 
	<div class="panel-body">
		<h5>
			<center>
				<button class="btn btn-md btn-danger">
					¡¡ No has seleccionado ninguna variable !!
				</button>				
			</center>
		</h5>
	</div>
</div>
<!-- <script src="global/scripts/Pulso.js"></script>
<script type="text/javascript">
	$("#pulsate-regular2").pulsate({color:"#ee000c"});						
</script> -->
@else
<div class="panel panel-info pulsate-regular2" id="pulsate-regular2">		 
	<div class="panel-body">		
		<label id="DatoSeleccionado">	
		</label>		
	</div>
</div>
<!-- <script src="global/scripts/Pulso.js"></script>
<script type="text/javascript">
	$("#pulsate-regular2").pulsate({color:"#19cc06"});						
</script> -->
@endif