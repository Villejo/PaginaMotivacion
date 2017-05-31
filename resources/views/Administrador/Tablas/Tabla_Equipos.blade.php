
<div class="panel panel-info">	
	<div class="panel-heading" style="background-color: #1c6a9e">
		<h3 class="panel-title">
			<strong>INFORMACION EQUIPO</strong>
		</h3>
	</div>	
	<div class="panel-body">		
		@foreach ($datos_equipo as $value)	
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-12" style="word-break: break-all">
			<div class="panel panel-primary">
				<div class="panel-heading" style="background-color: #321a7c">		
					<h3 class="panel-title">
						<b>
							<center><font size ="3", color color="#000000" face="Tahoma" >
								<strong><label style=""><p>{{$value->nombre_equipo}}</p></label></strong></font>
							</center>
						</b>
					</h3>
				</div>
			</div>
 <!-- word-break: break-all;
 word-wrap: break-word; -->


 <div class="row">					
 	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-12">			
 		<table class="table table-user-information">									
 			<tbody>							
 				<tr>
 					<td style="width:25% !important"> <!-- ese style width define el tamaño del resto de los td -->

 						<i class="fa fa-user" aria-hidden="true"></i>
 						<b><strong><font size ="2", color color="#000000" face="Tahoma">Nombre:</font></strong></b>
 					</td>
 					<td>								

 						<b>
 							<strong>
 								<font size ="2">
 									
 									{{ucfirst($value->nombre_equipo)}}	 		
 								</font>
 							</strong>
 						</b>

 					</td>   

 				</tr> 			
 				<tr>
 					<td>
 						<i class="fa fa-id-card-o" aria-hidden="true"></i>
 						<b><strong><font size ="2", color color="#000000" face="Tahoma">identificador:</font></strong></b>
 					</td>
 					<td>								

 						<b>
 							<strong>
 								<font size ="2">
 									{{ucfirst($value->identificador)}}	
 								</font>
 							</strong>
 						</b>

 					</td>

 				</tr>
 				<tr>
 					<td>
 						<i class="fa fa-map-marker" aria-hidden="true"></i>
 						<b><strong><font size ="2", color color="#000000" face="Tahoma">Ubicacion:</font></strong></b>
 					</td>
 					<td>								

 						<b>
 							<strong>
 								<font size ="2">
 									{{ucfirst($value->ubicacion)}}
 								</font>
 							</strong>
 						</b>

 					</td>

 				</tr>
 				<tr>
 					<td>
 						<i class="fa fa-info-circle" aria-hidden="true"></i>
 						<b><strong><font size ="2", color color="#000000" face="Tahoma">Descripcion:</font></strong></b>
 					</td>
 					<td>								

 						<b>
 							<strong>
 								<font size ="2">
 									{{ucfirst($value->descripcion)}}	
 								</font>
 							</strong>
 						</b>

 					</td>

 				</tr>
 				<tr>
 					<td>
 						<i class="fa fa-tag" aria-hidden="true"></i>
 						<b><strong><font size ="2", color color="#000000" face="Tahoma">Marca:</font></strong></b>
 					</td>
 					<td>								

 						<b>
 							<strong>
 								<font size ="2">
 									{{ucfirst($value->marca)}}
 								</font>
 							</strong>
 						</b>

 					</td>

 				</tr>
 				<tr>
 					<td>
 						<i class="fa fa-cogs" aria-hidden="true"></i>
 						<b><strong><font size ="2", color color="#000000" face="Tahoma">Estado del equipo:</font></strong></b>
 					</td>
 					<td>								

 						<b>
 							<strong>
 								<font size ="2">
 									{{ucfirst($value->estado_equipo)}}
 								</font>
 							</strong>
 						</b>

 					</td>

 				</tr>
 				<tr>
 					<td>
 						<i class="fa fa-calendar" aria-hidden="true"></i>
 						<b><strong><font size ="2", color color="#000000" face="Tahoma">Fecha de registro:</font></strong></b>

 					</td>
 					<td>								

 						<b>
 							<strong>
 								<font size ="2">
 									
 									{{Carbon::parse($value->fecha_registro)->toDateString()}}	
 								</font>
 							</strong>
 						</b>
 					</td>
 				</tr>
 			</tbody>
 		</table>
 	</div>
 </div>
 <div class="panel-footer">Panel de opciones
 	<div class="pull-right">
 		<a href="#" data-toggle = 'modal' data-target="#Modal_Confirmacion_Delete" class="Eliminar_Equipo" id_Eliminar_Equipo="{{$value->id}}" title="Eliminar" <strong> <font size ="3", color ="#321a7c" face="Lucida Sans"><span class= "fa fa-times fa-2x"></font>
 		</a>
 		<td>
 			<a href="#" id="{{$value->identificador}}" 
 				class="btnEditar_Equipo" 
 				id_equipo_editar="{{$value->id}}"               	
 				nombre_equipo="{{$value->nombre_equipo}}"
 				identificador="{{$value->identificador}}"
 				ubicacion="{{$value->ubicacion}}"
 				descripcion="{{$value->descripcion}}"
 				marca="{{$value->marca}}"
 				
 				estado_equipo="{{$value->estado_equipo}}"
 				fecha_registro="{{$value->fecha_registro}}"
 				title="Editar" <strong> 
 				<font size ="3", color ="#321a7c" face="Lucida Sans"><span class= "fa fa-pencil-square-o fa-2x"></font>
 			</a>	
 		</td>		
 	</div>
 </div>
</div>	
@endforeach	
</div>







</div>

