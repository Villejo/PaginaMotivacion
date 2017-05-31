<?php
namespace Motivacion\Http\Controllers\Controller_Formulario;
use Illuminate\Http\Request;
use Motivacion\Http\Requests;
use Motivacion\Http\Controllers\Controller;
use Motivacion\Models\Formulario\Encabezado_Formulario;
use Motivacion\Models\Formulario\Detalle_Formulario;
use Motivacion\Models\Formulario\Consolidado_Formularios;
use Motivacion\Models\Equipos\Equipo;
use Motivacion\Models\Asignaciones\Asignaciones_M;
use Motivacion\Models\Turnos\Turnos_M;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Facades\Validator;
use DB;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\UserTrait;
use Hash;
use Illuminate\Support\Facades\Input;

use DateTime;

class FormularioController extends Controller{
	public function __construct(){
		Carbon::setLocale('es');
	}


	function RestarHoras($horaini,$horafin)
	{
		$ArregloVacio = array();
		$horai=substr($horaini,0,2);
		$mini=substr($horaini,3,2);
		$segi=substr($horaini,6,2);
		$horaf=substr($horafin,0,2);
		$minf=substr($horafin,3,2);
		$segf=substr($horafin,6,2);
		$ini=((($horai*60)*60)+($mini*60)+$segi);
		$fin=((($horaf*60)*60)+($minf*60)+$segf);
		$dif=$fin-$ini;
		$difh=floor($dif/3600);
		$difm=floor(($dif-($difh*3600))/60);
		$difs=$dif-($difm*60)-($difh*3600);		
		$Data=date("H:i:s",mktime($difh,$difm,$difs));		
		return $Data;	
	}

	public function Cargar_Formulario(){

		$Fecha_Actual =Carbon::now()->toDateString(); 
		$Fecha_Actual2 =Carbon::now()->toDateString(); 
		$horaActual  = Carbon::now()->toTimeString();
		$Fecha_De_Manana= Carbon::tomorrow()->toDateString();
		$Fecha_De_Ayer= Carbon::yesterday()->toDateString();

		$horaFinTurno;
		$turno=0;

		if($horaActual>="06:00:01" &&  $horaActual<="14:00:00"){
			$horaFinTurno="14:00:00";
			$turno=1;
			$MensajeInformativo=$this->RestarHoras($horaActual,$horaFinTurno);			
			$MensajeInformativo=Carbon::now()->toFormattedDateString()." "."14:00:00";			
		}
		if($horaActual>="14:00:01" &&  $horaActual<="22:00:00"){
			$horaFinTurno="22:00:00";
			$turno=2;
			$MensajeInformativo=$this->RestarHoras($horaActual,$horaFinTurno);	
			$MensajeInformativo=Carbon::now()->toFormattedDateString()." "."22:00:00";		
		}
		if($horaActual>="22:00:01" &&  $horaActual<="23:59:59" ||$horaActual>="00:00:01" &&  $horaActual<="06:00:00"){
			$horaFinTurno="06:00:00";
			$turno=3;	
			$MensajeInformativo=$this->RestarHoras($horaActual,$horaFinTurno);
			$MensajeInformativo=Carbon::tomorrow()->toFormattedDateString()." "."06:00:00";	
		}

		$id_Usuario_Logueado=Auth::user()->id;	

		$Registro_En_turno=Consolidado_Formularios::where('fk_usuario',$id_Usuario_Logueado)
		->where('fecha_ingreso',$Fecha_Actual)
		->where('fk_turno',$turno)->get();

		$AsignacionesGenerales=Asignaciones_M::Where('fk_usuarios',$id_Usuario_Logueado)->
		Where('estado',"Activo")
		->get();


		$turno_vigente1=0;$turno_vigente2=0;$turno_vigente3=0;


		$TurnoGeneral=0;

		foreach ($AsignacionesGenerales as $key => $value) {  
			$idAsignacion=$value->id;
			$Fecha_fin=$value->fecha_fin;

			if($Fecha_Actual > $Fecha_fin){
				$Datos = array(
					'estado'           => 'Inactivo'
					);
				$check = DB::table('asignaciones')
				->where('id',$idAsignacion)
				->update($Datos);
			}
			$TurnoGeneral=$value->fk_turno; 


			if($TurnoGeneral==1){
				$turno_vigente1++;
			}
			if($TurnoGeneral==2){
				$turno_vigente2++;
			}
			if($TurnoGeneral==3){
				$turno_vigente3++;
			}
		}

		$Asignaciones_En_turno=Asignaciones_M::Where('fk_usuarios',$id_Usuario_Logueado)
		->Where('estado',"Activo")
		->Where('fk_turno',$turno)
		->get();


		foreach ($Asignaciones_En_turno as $key => $value) {
			$id_Formulario_En_turno=$value->fk_formulario;
			$id_asignacion=$value->id;
			$Nombre_Turno=$value->Nombre_Turno->nombre_turno;
		}
		$mensaje_despues_guardar;


// 
	// dd("TURNO ACTUAL:". $turno,"TURNO VIGENTE1: " .$turno_vigente1,"TURNO VIGENTE2: " .$turno_vigente2,"TURNO VIGENTE3: " .$turno_vigente3,"AsignacionesGenerales " .$AsignacionesGenerales,"ASIGNACIONES EN TURNO ".$Asignaciones_En_turno);

	// dd($Asignaciones_En_turno,$Registro_En_turno);

		if($AsignacionesGenerales=="[]"){
			$Mensaje="<div class='panel panel-info'>
			<div class='panel-heading'></div>
			<div class='panel-body'><center><img src='global/images/No_Asignacion.png' class='img-thumbnail img-responsive'></center></div>";
			return $Mensaje;

		}else if($Asignaciones_En_turno=="[]"){		
			$Otros_turnos_asignados;
			if($turno==1){
				if($turno_vigente2!=0 && $turno_vigente3!=0 ){
					$Otros_turnos_asignados="¡¡ Tiene asignaciones vigentes en los turnos 2 y 3 !!";
				}else if($turno_vigente2!=0){
					$Otros_turnos_asignados= "¡¡ Tiene asignaciones vigentes en el turno 2  !!";
				}else if($turno_vigente3!=0){
					$Otros_turnos_asignados= "¡¡  Tiene asignaciones vigentes en el turno 3  !!";
				}

			}else if($turno==2){
				if($turno_vigente1!=0 && $turno_vigente3!=0 ){
					$Otros_turnos_asignados= "¡¡ Tiene asignaciones vigentes en los turnos 1 y 3 !!";
				}else if($turno_vigente3!=0){
					$Otros_turnos_asignados= "¡¡ Tiene asignaciones vigentes en el turno 3 !!";

				}else if($turno_vigente1!=0){
					$Otros_turnos_asignados= "¡¡ Tiene asignaciones vigentes en el turno 1  !!";
				}
			}else if($turno==3){

				if($turno_vigente1!=0 && $turno_vigente2!=0 ){
					$Otros_turnos_asignados= "¡¡ Tiene asignaciones vigentes en los turnos 1 y 2 !!";
				}else if($turno_vigente1!=0){
					$Otros_turnos_asignados="¡¡ Tiene asignaciones vigentes en el turno 1  !!";
				}else if($turno_vigente2!=0){
					$Otros_turnos_asignados= "¡¡ Tiene asignaciones vigentes en el turno 2  !!";
				}
			}
			// $variable =Carbon::parse($Fecha_Actual.' '.$horaFinTurno)->diffForHumans();
			$Mensaje="<div class='panel panel-info'>
			<div class='panel-heading' style='text-align: right;'>					
			</div>
			<div class='panel-body'><center><img src='global/images/No_Asignacion_Turno.png' class='img-thumbnail img-responsive'></center>
				<div  style='color: red;font-size:20px'>

					<center>	$Otros_turnos_asignados</center>
				</div>
			</div>";
			return $Mensaje;
		}else if($Asignaciones_En_turno!="[]" && $Registro_En_turno!="[]"){

			// dd('EA');	

			if($turno==1 && $turno_vigente1!=0 && $turno_vigente2!=0 && $turno_vigente3!=0){
				$variable=Carbon::now()->toFormattedDateString()." "."14:00:00";
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}else if($turno==1 && $turno_vigente1==0 && $turno_vigente2==0 && $turno_vigente3!=0){
				$variable=Carbon::now()->toFormattedDateString()." "."22:00:00";
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}else if($turno==1 && $turno_vigente1==0 && $turno_vigente2!=0 && $turno_vigente3==0){
				$variable=Carbon::now()->toFormattedDateString()." "."14:00:00";				
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);			
			}else if($turno==1 && $turno_vigente1!=0 && $turno_vigente2==0 && $turno_vigente3==0){	
				$variable=Carbon::tomorrow()->toFormattedDateString()." "."06:00:00";				
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}else if($turno==1 && $turno_vigente1!=0 && $turno_vigente2!=0 && $turno_vigente3==0){	
				$variable=Carbon::now()->toFormattedDateString()." "."14:00:00";
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}else if($turno==1 && $turno_vigente1==0 && $turno_vigente2!=0 && $turno_vigente3!=0){
				$variable=Carbon::now()->toFormattedDateString()." "."14:00:00";
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}else if($turno==1 && $turno_vigente1!=0 && $turno_vigente2==0 && $turno_vigente3!=0){
				$variable=Carbon::now()->toFormattedDateString()." "."22:00:00";
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}
// TERMINA PRIMER TURNO
		// EMPIEZA SEGUNDO TURNO	
		// dd('EPA');			// 
			if($turno==2 && $turno_vigente1!=0 && $turno_vigente2!=0 && $turno_vigente3!=0){
				$variable=Carbon::now()->toFormattedDateString()." "."22:00:00";	
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}else if($turno==2 && $turno_vigente1==0 && $turno_vigente2==0 && $turno_vigente3!=0){
				$variable=Carbon::now()->toFormattedDateString()." "."22:00:00";
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}else if($turno==2 && $turno_vigente1==0 && $turno_vigente2!=0 && $turno_vigente3==0){
				$variable=Carbon::tomorrow()->toFormattedDateString()." "."14:00:00";
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);			
			}else if($turno==2 && $turno_vigente1!=0 && $turno_vigente2==0 && $turno_vigente3==0){	
				$variable=Carbon::tomorrow()->toFormattedDateString()." "."06:00:00";
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}else if($turno==2 && $turno_vigente1!=0 && $turno_vigente2!=0 
				&& $turno_vigente3==0){				
				$variable=Carbon::tomorrow()->toFormattedDateString()." "."06:00:00";
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}else if($turno==2 && $turno_vigente1==0 && $turno_vigente2!=0 && $turno_vigente3!=0){	
				$variable=Carbon::now()->toFormattedDateString()." "."22:00:00";
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}else if($turno==2 && $turno_vigente1!=0 && $turno_vigente2==0 && $turno_vigente3!=0){
				$variable=Carbon::now()->toFormattedDateString()." "."22:00:00";
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}		
		// TERMINA SEGUNDO TURNO
		// EMPIEZA TERCER TURNO
		// 
			if($turno==3 && $turno_vigente1!=0 && $turno_vigente2!=0 && $turno_vigente3!=0){		
				$variable=Carbon::tomorrow()->toFormattedDateString()." "."06:00:00";	
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}else if($turno==3 && $turno_vigente1==0 && $turno_vigente2==0 && $turno_vigente3!=0){				
				$variable=Carbon::tomorrow()->toFormattedDateString()." "."22:00:00";
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}else if($turno==3 && $turno_vigente1==0 && $turno_vigente2!=0 && $turno_vigente3==0){
				$variable=Carbon::tomorrow()->toFormattedDateString()." "."14:00:00";
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);			
			}else if($turno==3 && $turno_vigente1!=0 && $turno_vigente2==0 && $turno_vigente3==0){	
				$variable=Carbon::tomorrow()->toFormattedDateString()." "."06:00:00";
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}else if($turno==3 && $turno_vigente1!=0 && $turno_vigente2!=0 
				&& $turno_vigente3==0){				
				$variable=Carbon::tomorrow()->toFormattedDateString()." "."06:00:00";
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}else if($turno==3 && $turno_vigente1==0 && $turno_vigente2!=0 && $turno_vigente3!=0){
				$variable=Carbon::tomorrow()->toFormattedDateString()." "."14:00:00";
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}else if($turno==3 && $turno_vigente1!=0 && $turno_vigente2==0 && $turno_vigente3!=0){
				$variable=Carbon::tomorrow()->toFormattedDateString()." "."06:00:00";
				return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
				->with('variable',$variable);
			}
		// TERMINA TERCER TURNO
		}else{								
			if($horaActual>="23:59:59" || $horaActual<="06:00:00"){	
				$horaFinTurno="06:00:00";
				$turno=3;
				// $variable=Carbon::now()->toFormattedDateString()." "."06:00:00";	
				$MensajeInformativo=Carbon::now()->toFormattedDateString()." "."06:00:00";	
				$Fecha_Actual=$Fecha_De_Ayer;
					// dd('ELSE2');
			}
				// dd('ELSE');
			$Registro_En_turno=Consolidado_Formularios::where('fk_usuario',$id_Usuario_Logueado)
			->where('fecha_ingreso',$Fecha_Actual)
			->where('fk_turno',$turno)->get();
			$Encabezado_Formulario=Encabezado_Formulario::Where('id',$id_Formulario_En_turno)->get();

			foreach ($Encabezado_Formulario as $key => $value) {
				$Nombre_Formulario=$value->nombre_formulario;
				$NombreEquipo=$value->Nombre_Equipo->nombre_equipo;
				$fk_equipos=$value->fk_equipos;
			}
			$UltimaVersionForm=Detalle_Formulario::Where('fk_formulario',$id_Formulario_En_turno)
			->Where('estado_registro','Activo')
			->get();

			$id_version_form_Vigente=1;
			foreach ($UltimaVersionForm as $key => $value){
				$id_version_form_Vigente=$value->id_version_formulario;
			}

			if($Registro_En_turno=="[]"){			

				$Detalle_Formulario=Detalle_Formulario::Where('fk_formulario',$id_Formulario_En_turno)
				->where('id_version_formulario',$id_version_form_Vigente)
				->where('estado_registro','Activo')
				->get();

				foreach ($Detalle_Formulario as $key => $value) {
					$fk_formulario=$value->fk_formulario;
					$id_version_formulario=$value->id_version_formulario;
					$estado_registro=$value->estado_registro;
				}

				return view('Empleados/Tablas.Tabla_Ingreso_Ruta_Empleado')
				->with('Nombre_Formulario',$Nombre_Formulario)
				->with('Fecha_Actual',$Fecha_Actual)
				->with('NombreEquipo',$NombreEquipo)
				->with('Detalle_Formulario',$Detalle_Formulario)
				->with('Num_formulario',$id_Formulario_En_turno)
				->with('id_usuario',$id_Usuario_Logueado)
				->with('id_asignacion',$id_asignacion)
				->with('Nombre_Turno',$Nombre_Turno)
				->with('TurnoFinal',$MensajeInformativo)
				->with('turno_actual',$turno)
				->with('fk_equipos',$fk_equipos)
				->with('ultimo_registroo',$id_version_form_Vigente)
				->with('fk_formulario',$id_Formulario_En_turno)							
				->with('id_version_formulario',$id_version_formulario)
				->with('estado_registro',$estado_registro);

			}else{			
				if($turno==3 &&  $turno_vigente1!=0 &&$turno_vigente2!=0 && $turno_vigente3!=0){
					$fecha;
					if($horaActual>="23:59:59"){
						$fecha=$Fecha_De_Manana;
					}else if($horaActual>="00:00:01"){
						$fecha=$Fecha_Actual2;
					}					
					$variable=Carbon::now()->toFormattedDateString()." "."06:00:00";

					return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
					->with('variable',$variable);
				}

				if($turno==3 &&  $turno_vigente1==0 &&$turno_vigente2!=0 && $turno_vigente3!=0){
					$variable=Carbon::now()->toFormattedDateString()." "."14:00:00";

					return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
					->with('variable',$variable);
				}

				if($turno==3 &&  $turno_vigente1==0 &&$turno_vigente2==0 && $turno_vigente3!=0){										
					$variable=Carbon::now()->toFormattedDateString()." "."22:00:00";

					return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
					->with('variable',$variable);
				}

				if($turno==3 &&  $turno_vigente1!=0 &&$turno_vigente2==0 && $turno_vigente3!=0){

					$variable=Carbon::now()->toFormattedDateString()." "."06:00:00";			

					return view('Empleados/Tablas.Tabla_Temporizador_Ruta')
					->with('variable',$variable);
				}

			}
		}
	}
		// ------------------------Enviar Notificiacion si se pasa de los rangos---------
	public function CrearNotificacionValidacion($id_equipo,$titulo_mensaje,$mensaje,$fk_usuario){

		$hora_notificacion=carbon::now();
		$fecha_notificacion=carbon::now();

		$Datos = array(
			'fk_equipo'=>$id_equipo,
			'titulo_mensaje'=>$titulo_mensaje,
			'mensaje'=>$mensaje,
			'imagen_foto'=>'global/images/error.png',
			'fk_usuario'=>$fk_usuario,
			'hora_notificacion'=>$hora_notificacion,
			'fecha_notificacion'=>$fecha_notificacion,
			'estado'=>'Si',
			);
		$check = DB::table('notificaciones')->insert($Datos);

	}

		// ------------------------Termina Enviar Notificiacion si se pasa de los rangos-----
		//------------------------------- guardar ------------------


//---------------------  CrearNuevaVersionFormulario --------------------------------------
	public function  CrearNuevaVersionFormulario() { 
		$datosFormulario = Input::all();

		$TotalRegistros=$datosFormulario['TotalRegistros'];
		$Id_Formulario=$datosFormulario['fk_formulario'];

		$i=0;
		while ($i < $TotalRegistros) {
			$i++;
			if($i==$TotalRegistros){
				$i=$TotalRegistros;
			}

			$Datos = array(

				'fk_formulario'         	   =>  $Id_Formulario,
				'parametros_control'           =>  $datosFormulario['nombre_parametro_'.$i],
				'valor_ideal'            	   =>  $datosFormulario['porcentaje_minimo_'.$i],
				'unidad'                       =>  $datosFormulario['unidad_'.$i],
				'valor_minimo'                 =>  $datosFormulario['alarma_'.$i],
				'valor_maximo'                 =>  $datosFormulario['disparo_'.$i],			
				'estado_registro'              =>  $datosFormulario['estado_registro_version'],
				'id_version_formulario'        =>  $datosFormulario['Ultimo_id_version_Nuevo_Formulario'],
				);

			$check = DB::table('detalle_formulario')->insert($Datos);
		}
		$datos_editar = array(
			'estado_registro'     => 'Inativo',
			'id_version_formulario' => $datosFormulario['Ultimo_id_version_Nuevo_Registro']
			);		

		$check = DB::table('detalle_formulario')
		->where('fk_formulario',$Id_Formulario)	
		->where('id_version_formulario',$datosFormulario['Ultimo_id_version_Nuevo_Registro'])		
		->update($datos_editar);

		if($check >0){
			return 0;
		}
	}

//------------ fin    guardar guardar guardar   fin------------------------------
//--------------------------------------------------------------------------



	public function Guardar_consolidado(){

		$consolidadoValues = Input::all();

		$fk_equipos=$consolidadoValues['fk_equipos'];	
		$fk_formulario=$consolidadoValues['fk_formulario'];	
		$id_version_formulario=$consolidadoValues['id_version_formulario'];	
		$estado_registro=$consolidadoValues['estado_registro'];	
		$NumeroTurno=$consolidadoValues['turno_actual'];	
		$Formulario_Compresor=Detalle_Formulario::all();
		$fk_usuario=Auth::user()->id;	


		if(empty($consolidadoValues['variable_1'])) {
			$Campo1=0;
		}else{
			$Campo1=$consolidadoValues['variable_1'];
		}
		if(empty($consolidadoValues['variable_2'])) {		
			$Campo2=0;
		}else{
			$Campo2=$consolidadoValues['variable_2'];
		}

		if(empty($consolidadoValues['variable_3'])){
			$Campo3=0;
		}else{
			$Campo3=$consolidadoValues['variable_3'];
		}

		if(empty($consolidadoValues['variable_4'])){
			$Campo4=0;
		}else{
			$Campo4=$consolidadoValues['variable_4'];
		}

		if(empty($consolidadoValues['variable_5'])){
			$Campo5=0;
		}else{
			$Campo5=$consolidadoValues['variable_5'];
		}

		if(empty($consolidadoValues['variable_6'])){
			$Campo6=0;
		}else{
			$Campo6=$consolidadoValues['variable_6'];
		}

		if(empty($consolidadoValues['variable_7'])){
			$Campo7=0;
		}else{
			$Campo7=$consolidadoValues['variable_7'];
		}

		if(empty($consolidadoValues['variable_8'])){
			$Campo8=0;
		}else{
			$Campo8=$consolidadoValues['variable_8'];
		}

		if(empty($consolidadoValues['variable_9'])){
			$Campo9=0;
		}else{
			$Campo9=$consolidadoValues['variable_9'];
		}

		if(empty($consolidadoValues['variable_10'])){
			$Campo10=0;
		}else{
			$Campo10=$consolidadoValues['variable_10'];
		}

		if(empty($consolidadoValues['variable_11'])){
			$Campo11=0;
		}else{
			$Campo11=$consolidadoValues['variable_11'];
		}

		if(empty($consolidadoValues['variable_12'])){
			$Campo12=0;
		}else{
			$Campo12=$consolidadoValues['variable_12'];
		}

		if(empty($consolidadoValues['variable_13'])){
			$Campo13=0;
		}else{
			$Campo13=$consolidadoValues['variable_13'];
		}

		if(empty($consolidadoValues['variable_14'])){
			$Campo14=0;
		}else{
			$Campo14=$consolidadoValues['variable_14'];
		}

		if(empty($consolidadoValues['variable_15'])){
			$Campo15=0;
		}else{
			$Campo15=$consolidadoValues['variable_15'];
		}

		if(empty($consolidadoValues['variable_16'])){
			$Campo16=0;
		}else{
			$Campo16=$consolidadoValues['variable_16'];
		}
		if(empty($consolidadoValues['variable_17'])){
			$Campo17=0;
		}else{
			$Campo17=$consolidadoValues['variable_17'];
		}
		if(empty($consolidadoValues['variable_18'])){
			$Campo18=0;
		}else{
			$Campo18=$consolidadoValues['variable_18'];
		}
		if(empty($consolidadoValues['variable_19'])){
			$Campo19=0;
		}else{
			$Campo19=$consolidadoValues['variable_19'];
		}
		if(empty($consolidadoValues['variable_20'])){
			$Campo20=0;
		}else{
			$Campo20=$consolidadoValues['variable_20'];
		}
		if(empty($consolidadoValues['variable_21'])){
			$Campo21=0;
		}else{
			$Campo21=$consolidadoValues['variable_21'];
		}
		if(empty($consolidadoValues['variable_22'])){
			$Campo22=0;
		}else{
			$Campo22=$consolidadoValues['variable_22'];
		}
		if(empty($consolidadoValues['variable_23'])){
			$Campo23=0;
		}else{
			$Campo23=$consolidadoValues['variable_23'];
		}
		if(empty($consolidadoValues['variable_24'])){
			$Campo24=0;
		}else{
			$Campo24=$consolidadoValues['variable_24'];
		}
		if(empty($consolidadoValues['variable_25'])){
			$Campo25=0;
		}else{
			$Campo25=$consolidadoValues['variable_25'];
		}
		if(empty($consolidadoValues['variable_26'])){
			$Campo26=0;
		}else{
			$Campo26=$consolidadoValues['variable_26'];
		}
		if(empty($consolidadoValues['variable_27'])){
			$Campo27=0;
		}else{
			$Campo27=$consolidadoValues['variable_27'];
		}
		if(empty($consolidadoValues['variable_28'])){
			$Campo28=0;
		}else{
			$Campo28=$consolidadoValues['variable_28'];
		}
		if(empty($consolidadoValues['variable_29'])){
			$Campo29=0;
		}else{
			$Campo29=$consolidadoValues['variable_29'];
		}
		if(empty($consolidadoValues['variable_30'])){
			$Campo30=0;
		}else{
			$Campo30=$consolidadoValues['variable_30'];
		}
		if(empty($consolidadoValues['variable_31'])){
			$Campo31=0;
		}else{
			$Campo31=$consolidadoValues['variable_31'];
		}
		if(empty($consolidadoValues['variable_32'])){
			$Campo32=0;
		}else{
			$Campo32=$consolidadoValues['variable_32'];
		}
		if(empty($consolidadoValues['variable_33'])){
			$Campo33=0;
		}else{
			$Campo33=$consolidadoValues['variable_33'];
		}
		if(empty($consolidadoValues['variable_34'])){
			$Campo34=0;
		}else{
			$Campo34=$consolidadoValues['variable_34'];
		}
		if(empty($consolidadoValues['variable_35'])){
			$Campo35=0;
		}else{
			$Campo35=$consolidadoValues['variable_35'];
		}
		if(empty($consolidadoValues['variable_36'])){
			$Campo36=0;
		}else{
			$Campo36=$consolidadoValues['variable_36'];
		}
		if(empty($consolidadoValues['variable_37'])){
			$Campo37=0;
		}else{
			$Campo37=$consolidadoValues['variable_37'];
		}
		if(empty($consolidadoValues['variable_38'])){
			$Campo38=0;
		}else{
			$Campo38=$consolidadoValues['variable_38'];
		}
		if(empty($consolidadoValues['variable_39'])){
			$Campo39=0;
		}else{
			$Campo39=$consolidadoValues['variable_39'];
		}
		if(empty($consolidadoValues['variable_40'])){
			$Campo40=0;
		}else{
			$Campo40=$consolidadoValues['variable_40'];
		}

		$Datos = array(

			'fk_encabezado_formulario' => $consolidadoValues['id_formulario'],
			'fk_detalle_formulario'    => $consolidadoValues['id_formulario'],
			'fk_usuario'               => $consolidadoValues['fk_usuario'],
			'fecha_ingreso'            => $consolidadoValues['fecha_turno'],
			'campo1'                   => $Campo1,
			'campo2'                   => $Campo2,
			'campo3'              	   => $Campo3,
			'campo4'              	   => $Campo4,
			'campo5'                   => $Campo5,
			'campo6'           		   => $Campo6,
			'campo7'   				   => $Campo7,
			'campo8'                   => $Campo8,
			'campo9'                   => $Campo9,
			'campo10'     			   => $Campo10,
			'campo11'     			   => $Campo11,
			'campo12'      			   => $Campo12,
			'campo13'     			   => $Campo13,
			'campo14' 				   => $Campo14,
			'campo15'                  => $Campo15,
			'campo16'                  => $Campo16,
			'campo17'                  => $Campo17,
			'campo18'                  => $Campo18,
			'campo19'                  => $Campo19,
			'campo20'                  => $Campo20,
			'campo21'                  => $Campo21,
			'campo22'                  => $Campo22,
			'campo23'                  => $Campo23,
			'campo24'                  => $Campo24,
			'campo25'                  => $Campo25,
			'campo26'                  => $Campo26,
			'campo27'                  => $Campo27,
			'campo28'                  => $Campo28,
			'campo29'                  => $Campo29,
			'campo30'                  => $Campo30,
			'campo31'                  => $Campo31,
			'campo32'                  => $Campo32,
			'campo33'                  => $Campo33,
			'campo34'                  => $Campo34,
			'campo35'                  => $Campo35,
			'campo36'                  => $Campo36,
			'campo37'                  => $Campo37,
			'campo38'                  => $Campo38,
			'campo39'                  => $Campo39,
			'campo40'                  => $Campo40,
			'fk_turno' 			   	   => $NumeroTurno
			);
	//--------------------------------	

		$Detalle_Formulario=Detalle_Formulario::Where('estado_registro',$estado_registro)
		->Where('fk_formulario',$fk_formulario)
		->Where('id_version_formulario',$id_version_formulario)
		->get();

		$fk_usuario=Auth::user()->id;
		$freno4=1;	$freno44=1;
		$Valor_Minimo = array();
		$Valor_Maximo = array();
		$Parametro_Control = array();
		$Valor_Ideal_Arreglo = array();
		$contador=0;
		$contador2=1;

		foreach ($Detalle_Formulario as $key => $value) {
			$contador++;
			$Parametro_Control[$contador]=$value->NombreParametro->nombre_parametro;
			$Unidad[$contador]=$value->NombreUnidad->nombre_unidad;
			$Valor_Ideal[$contador]=$value->valor_ideal;		
			$Valor_Minimo[$contador]=$value->valor_minimo;
			$Valor_Maximo[$contador]=$value->valor_maximo;
		}		
// Arranca 1
		if(!empty($consolidadoValues['variable_1'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_1'] != $Valor_Ideal[1]){

				if($consolidadoValues['variable_1'] <$Valor_Minimo[1]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_1'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[1].".";
				}else{
					if($consolidadoValues['variable_1'] < $Valor_Ideal[1] && $consolidadoValues['variable_1'] >=$Valor_Minimo[1]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_1'] > $Valor_Ideal[1] && $consolidadoValues['variable_1'] <=$Valor_Maximo[1]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_1'] >$Valor_Maximo[1]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_1'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[1].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[1].'//'.$Unidad[1].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_1'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[1].' ". ',$fk_usuario);
			}			
		}			

// Termina 1
// Arranca 2
		if(!empty($consolidadoValues['variable_2'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_2'] != $Valor_Ideal[2]){

				if($consolidadoValues['variable_2'] <$Valor_Minimo[2]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_2'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[2].".";
				}else{
					if($consolidadoValues['variable_2'] < $Valor_Ideal[2] && $consolidadoValues['variable_2'] >=$Valor_Minimo[2]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_2'] > $Valor_Ideal[2] && $consolidadoValues['variable_2'] <=$Valor_Maximo[2]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_2'] >$Valor_Maximo[2]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_2'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[2].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[2].'//'.$Unidad[2].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_2'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[2].' ". ',$fk_usuario);
			}			
		}			

// Termina 2
		// Arranca 3
		if(!empty($consolidadoValues['variable_3'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_3'] != $Valor_Ideal[3]){

				if($consolidadoValues['variable_3'] <$Valor_Minimo[3]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_3'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[3].".";
				}else{
					if($consolidadoValues['variable_3'] < $Valor_Ideal[3] && $consolidadoValues['variable_3'] >=$Valor_Minimo[3]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_3'] > $Valor_Ideal[3] && $consolidadoValues['variable_3'] <=$Valor_Maximo[3]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_3'] >$Valor_Maximo[3]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_3'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[3].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[3].'//'.$Unidad[3].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_3'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[3].' ". ',$fk_usuario);
			}			
		}			

// Termina 3
// Arranca 4
		if(!empty($consolidadoValues['variable_4'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_4'] != $Valor_Ideal[4]){

				if($consolidadoValues['variable_4'] <$Valor_Minimo[4]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_4'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[4].".";
				}else{
					if($consolidadoValues['variable_4'] < $Valor_Ideal[4] && $consolidadoValues['variable_4'] >=$Valor_Minimo[4]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_4'] > $Valor_Ideal[4] && $consolidadoValues['variable_4'] <=$Valor_Maximo[4]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_4'] >$Valor_Maximo[4]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_4'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[4].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[4].'//'.$Unidad[4].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_4'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[4].' ". ',$fk_usuario);
			}			
		}			

// Termina 4
	// Arranca 5
		if(!empty($consolidadoValues['variable_5'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_5'] != $Valor_Ideal[5]){

				if($consolidadoValues['variable_5'] <$Valor_Minimo[5]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_5'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[5].".";
				}else{
					if($consolidadoValues['variable_5'] < $Valor_Ideal[5] && $consolidadoValues['variable_5'] >=$Valor_Minimo[5]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_5'] > $Valor_Ideal[5] && $consolidadoValues['variable_5'] <=$Valor_Maximo[5]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_5'] >$Valor_Maximo[5]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_5'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[5].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[5].'//'.$Unidad[5].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_5'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[5].' ". ',$fk_usuario);
			}			
		}			

// Termina 5	
		// Arranca 6
		if(!empty($consolidadoValues['variable_6'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_6'] != $Valor_Ideal[6]){

				if($consolidadoValues['variable_6'] <$Valor_Minimo[6]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_6'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[6].".";
				}else{
					if($consolidadoValues['variable_6'] < $Valor_Ideal[6] && $consolidadoValues['variable_6'] >=$Valor_Minimo[6]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_6'] > $Valor_Ideal[6] && $consolidadoValues['variable_6'] <=$Valor_Maximo[6]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_6'] >$Valor_Maximo[6]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_6'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[6].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[6].'//'.$Unidad[6].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_6'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[6].' ". ',$fk_usuario);
			}			
		}			

// Termina 6
		// Arranca 7
		if(!empty($consolidadoValues['variable_7'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_7'] != $Valor_Ideal[7]){

				if($consolidadoValues['variable_7'] <$Valor_Minimo[7]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_7'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[7].".";
				}else{
					if($consolidadoValues['variable_7'] < $Valor_Ideal[7] && $consolidadoValues['variable_7'] >=$Valor_Minimo[7]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_7'] > $Valor_Ideal[7] && $consolidadoValues['variable_7'] <=$Valor_Maximo[7]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_7'] >$Valor_Maximo[7]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_7'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[7].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[7].'//'.$Unidad[7].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_7'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[7].' ". ',$fk_usuario);
			}			
		}			

// Termina 7
		// Arranca 8
		if(!empty($consolidadoValues['variable_8'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_8'] != $Valor_Ideal[8]){

				if($consolidadoValues['variable_8'] <$Valor_Minimo[8]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_8'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[8].".";
				}else{
					if($consolidadoValues['variable_8'] < $Valor_Ideal[8] && $consolidadoValues['variable_8'] >=$Valor_Minimo[8]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_8'] > $Valor_Ideal[8] && $consolidadoValues['variable_8'] <=$Valor_Maximo[8]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_8'] >$Valor_Maximo[8]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_8'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[8].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[8].'//'.$Unidad[8].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_8'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[8].' ". ',$fk_usuario);
			}			
		}			

// Termina 8
		// Arranca 9
		if(!empty($consolidadoValues['variable_9'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_9'] != $Valor_Ideal[9]){

				if($consolidadoValues['variable_9'] <$Valor_Minimo[9]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_9'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[9].".";
				}else{
					if($consolidadoValues['variable_9'] < $Valor_Ideal[9] && $consolidadoValues['variable_9'] >=$Valor_Minimo[9]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_9'] > $Valor_Ideal[9] && $consolidadoValues['variable_9'] <=$Valor_Maximo[9]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_9'] >$Valor_Maximo[9]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_9'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[9].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[9].'//'.$Unidad[9].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_9'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[9].' ". ',$fk_usuario);
			}			
		}			

// Termina 9
		// Arranca 10
		if(!empty($consolidadoValues['variable_10'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_10'] != $Valor_Ideal[10]){

				if($consolidadoValues['variable_10'] <$Valor_Minimo[10]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_10'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[10].".";
				}else{
					if($consolidadoValues['variable_10'] < $Valor_Ideal[10] && $consolidadoValues['variable_10'] >=$Valor_Minimo[10]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_10'] > $Valor_Ideal[10] && $consolidadoValues['variable_10'] <=$Valor_Maximo[10]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_10'] >$Valor_Maximo[10]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_10'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[10].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[10].'//'.$Unidad[10].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_10'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[10].' ". ',$fk_usuario);
			}			
		}			

// Termina 10
		// Arranca 11
		if(!empty($consolidadoValues['variable_11'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_11'] != $Valor_Ideal[11]){

				if($consolidadoValues['variable_11'] <$Valor_Minimo[11]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_11'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[11].".";
				}else{
					if($consolidadoValues['variable_11'] < $Valor_Ideal[11] && $consolidadoValues['variable_11'] >=$Valor_Minimo[11]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_11'] > $Valor_Ideal[11] && $consolidadoValues['variable_11'] <=$Valor_Maximo[11]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_11'] >$Valor_Maximo[11]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_11'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[11].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[11].'//'.$Unidad[11].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_11'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[11].' ". ',$fk_usuario);
			}			
		}			

// Termina 11
		// Arranca 12
		if(!empty($consolidadoValues['variable_12'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_12'] != $Valor_Ideal[12]){

				if($consolidadoValues['variable_12'] <$Valor_Minimo[12]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_12'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[12].".";
				}else{
					if($consolidadoValues['variable_12'] < $Valor_Ideal[12] && $consolidadoValues['variable_12'] >=$Valor_Minimo[12]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_12'] > $Valor_Ideal[12] && $consolidadoValues['variable_12'] <=$Valor_Maximo[12]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_12'] >$Valor_Maximo[12]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_12'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[12].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[12].'//'.$Unidad[12].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_12'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[12].' ". ',$fk_usuario);
			}			
		}			

// Termina 12
		// Arranca 13
		if(!empty($consolidadoValues['variable_13'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_13'] != $Valor_Ideal[13]){

				if($consolidadoValues['variable_13'] <$Valor_Minimo[13]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_13'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[13].".";
				}else{
					if($consolidadoValues['variable_13'] < $Valor_Ideal[13] && $consolidadoValues['variable_13'] >=$Valor_Minimo[13]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_13'] > $Valor_Ideal[13] && $consolidadoValues['variable_13'] <=$Valor_Maximo[13]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_13'] >$Valor_Maximo[13]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_13'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[13].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[13].'//'.$Unidad[13].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_13'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[13].' ". ',$fk_usuario);
			}			
		}			

// Termina 13
		// Arranca 14
		if(!empty($consolidadoValues['variable_14'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_14'] != $Valor_Ideal[14]){

				if($consolidadoValues['variable_14'] <$Valor_Minimo[14]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_14'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[14].".";
				}else{
					if($consolidadoValues['variable_14'] < $Valor_Ideal[14] && $consolidadoValues['variable_14'] >=$Valor_Minimo[14]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_14'] > $Valor_Ideal[14] && $consolidadoValues['variable_14'] <=$Valor_Maximo[14]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_14'] >$Valor_Maximo[14]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_14'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[14].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[14].'//'.$Unidad[14].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_14'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[14].' ". ',$fk_usuario);
			}			
		}			

// Termina 14
		// Arranca 15
		if(!empty($consolidadoValues['variable_15'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_15'] != $Valor_Ideal[15]){

				if($consolidadoValues['variable_15'] <$Valor_Minimo[15]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_15'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[15].".";
				}else{
					if($consolidadoValues['variable_15'] < $Valor_Ideal[15] && $consolidadoValues['variable_15'] >=$Valor_Minimo[15]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_15'] > $Valor_Ideal[15] && $consolidadoValues['variable_15'] <=$Valor_Maximo[15]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_15'] >$Valor_Maximo[15]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_15'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[15].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[15].'//'.$Unidad[15].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_15'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[15].' ". ',$fk_usuario);
			}			
		}			

// Termina 15
		// Arranca 16
		if(!empty($consolidadoValues['variable_16'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_16'] != $Valor_Ideal[16]){

				if($consolidadoValues['variable_16'] <$Valor_Minimo[16]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_16'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[16].".";
				}else{
					if($consolidadoValues['variable_16'] < $Valor_Ideal[16] && $consolidadoValues['variable_16'] >=$Valor_Minimo[16]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_16'] > $Valor_Ideal[16] && $consolidadoValues['variable_16'] <=$Valor_Maximo[16]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_16'] >$Valor_Maximo[16]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_16'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[16].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[16].'//'.$Unidad[16].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_16'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[16].' ". ',$fk_usuario);
			}			
		}			

// Termina 16
		// Arranca 17
		if(!empty($consolidadoValues['variable_17'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_17'] != $Valor_Ideal[17]){

				if($consolidadoValues['variable_17'] <$Valor_Minimo[17]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_17'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[17].".";
				}else{
					if($consolidadoValues['variable_17'] < $Valor_Ideal[17] && $consolidadoValues['variable_17'] >=$Valor_Minimo[17]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_17'] > $Valor_Ideal[17] && $consolidadoValues['variable_17'] <=$Valor_Maximo[17]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_17'] >$Valor_Maximo[17]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_17'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[17].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[17].'//'.$Unidad[17].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_17'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[17].' ". ',$fk_usuario);
			}			
		}			

// Termina 17
		// Arranca 18
		if(!empty($consolidadoValues['variable_18'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_18'] != $Valor_Ideal[18]){

				if($consolidadoValues['variable_18'] <$Valor_Minimo[18]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_18'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[18].".";
				}else{
					if($consolidadoValues['variable_18'] < $Valor_Ideal[18] && $consolidadoValues['variable_18'] >=$Valor_Minimo[18]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_18'] > $Valor_Ideal[18] && $consolidadoValues['variable_18'] <=$Valor_Maximo[18]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_18'] >$Valor_Maximo[18]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_18'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[18].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[18].'//'.$Unidad[18].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_18'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[18].' ". ',$fk_usuario);
			}			
		}			

// Termina 18
		// Arranca 19
		if(!empty($consolidadoValues['variable_19'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_19'] != $Valor_Ideal[19]){

				if($consolidadoValues['variable_19'] <$Valor_Minimo[19]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_19'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[19].".";
				}else{
					if($consolidadoValues['variable_19'] < $Valor_Ideal[19] && $consolidadoValues['variable_19'] >=$Valor_Minimo[19]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_19'] > $Valor_Ideal[19] && $consolidadoValues['variable_19'] <=$Valor_Maximo[19]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_19'] >$Valor_Maximo[19]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_19'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[19].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[19].'//'.$Unidad[19].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_19'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[19].' ". ',$fk_usuario);
			}			
		}			

// Termina 19
		// Arranca 20
		if(!empty($consolidadoValues['variable_20'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_20'] != $Valor_Ideal[20]){

				if($consolidadoValues['variable_20'] <$Valor_Minimo[20]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_20'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[20].".";
				}else{
					if($consolidadoValues['variable_20'] < $Valor_Ideal[20] && $consolidadoValues['variable_20'] >=$Valor_Minimo[20]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_20'] > $Valor_Ideal[20] && $consolidadoValues['variable_20'] <=$Valor_Maximo[20]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_20'] >$Valor_Maximo[20]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_20'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[20].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[20].'//'.$Unidad[20].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_20'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[20].' ". ',$fk_usuario);
			}			
		}			

// Termina 20
		// Arranca 21
		if(!empty($consolidadoValues['variable_21'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_21'] != $Valor_Ideal[21]){

				if($consolidadoValues['variable_21'] <$Valor_Minimo[21]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_21'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[21].".";
				}else{
					if($consolidadoValues['variable_21'] < $Valor_Ideal[21] && $consolidadoValues['variable_21'] >=$Valor_Minimo[21]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_21'] > $Valor_Ideal[21] && $consolidadoValues['variable_21'] <=$Valor_Maximo[21]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_21'] >$Valor_Maximo[21]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_21'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[21].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[21].'//'.$Unidad[21].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_21'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[21].' ". ',$fk_usuario);
			}			
		}			

// Termina 21
		// Arranca 22
		if(!empty($consolidadoValues['variable_22'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_22'] != $Valor_Ideal[22]){

				if($consolidadoValues['variable_22'] <$Valor_Minimo[22]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_22'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[22].".";
				}else{
					if($consolidadoValues['variable_22'] < $Valor_Ideal[22] && $consolidadoValues['variable_22'] >=$Valor_Minimo[22]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_22'] > $Valor_Ideal[22] && $consolidadoValues['variable_22'] <=$Valor_Maximo[22]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_22'] >$Valor_Maximo[22]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_22'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[22].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[22].'//'.$Unidad[22].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_22'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[22].' ". ',$fk_usuario);
			}			
		}			

// Termina 22
		// Arranca 23
		if(!empty($consolidadoValues['variable_23'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_23'] != $Valor_Ideal[23]){

				if($consolidadoValues['variable_23'] <$Valor_Minimo[23]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_23'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[23].".";
				}else{
					if($consolidadoValues['variable_23'] < $Valor_Ideal[23] && $consolidadoValues['variable_23'] >=$Valor_Minimo[23]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_23'] > $Valor_Ideal[23] && $consolidadoValues['variable_23'] <=$Valor_Maximo[23]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_23'] >$Valor_Maximo[23]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_23'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[23].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[23].'//'.$Unidad[23].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_23'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[23].' ". ',$fk_usuario);
			}			
		}			

// Termina 23
		// Arranca 24
		if(!empty($consolidadoValues['variable_24'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_24'] != $Valor_Ideal[24]){

				if($consolidadoValues['variable_24'] <$Valor_Minimo[24]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_24'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[24].".";
				}else{
					if($consolidadoValues['variable_24'] < $Valor_Ideal[24] && $consolidadoValues['variable_24'] >=$Valor_Minimo[24]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_24'] > $Valor_Ideal[24] && $consolidadoValues['variable_24'] <=$Valor_Maximo[24]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_24'] >$Valor_Maximo[24]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_24'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[24].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[24].'//'.$Unidad[24].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_24'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[24].' ". ',$fk_usuario);
			}			
		}			

// Termina 24
		// Arranca 25
		if(!empty($consolidadoValues['variable_25'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_25'] != $Valor_Ideal[25]){

				if($consolidadoValues['variable_25'] <$Valor_Minimo[25]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_25'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[25].".";
				}else{
					if($consolidadoValues['variable_25'] < $Valor_Ideal[25] && $consolidadoValues['variable_25'] >=$Valor_Minimo[25]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_25'] > $Valor_Ideal[25] && $consolidadoValues['variable_25'] <=$Valor_Maximo[25]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_25'] >$Valor_Maximo[25]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_25'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[25].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[25].'//'.$Unidad[25].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_25'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[25].' ". ',$fk_usuario);
			}			
		}			

// Termina 25
		// Arranca 26
		if(!empty($consolidadoValues['variable_26'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_26'] != $Valor_Ideal[26]){

				if($consolidadoValues['variable_26'] <$Valor_Minimo[26]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_26'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[26].".";
				}else{
					if($consolidadoValues['variable_26'] < $Valor_Ideal[26] && $consolidadoValues['variable_26'] >=$Valor_Minimo[26]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_26'] > $Valor_Ideal[26] && $consolidadoValues['variable_26'] <=$Valor_Maximo[26]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_26'] >$Valor_Maximo[26]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_26'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[26].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[26].'//'.$Unidad[26].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_26'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[26].' ". ',$fk_usuario);
			}			
		}			

// Termina 26
		// Arranca 27
		if(!empty($consolidadoValues['variable_27'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_27'] != $Valor_Ideal[27]){

				if($consolidadoValues['variable_27'] <$Valor_Minimo[27]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_27'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[27].".";
				}else{
					if($consolidadoValues['variable_27'] < $Valor_Ideal[27] && $consolidadoValues['variable_27'] >=$Valor_Minimo[27]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_27'] > $Valor_Ideal[27] && $consolidadoValues['variable_27'] <=$Valor_Maximo[27]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_27'] >$Valor_Maximo[27]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_27'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[27].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[27].'//'.$Unidad[27].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_27'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[27].' ". ',$fk_usuario);
			}			
		}			

// Termina 27
		// Arranca 28
		if(!empty($consolidadoValues['variable_28'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_28'] != $Valor_Ideal[28]){

				if($consolidadoValues['variable_28'] <$Valor_Minimo[28]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_28'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[28].".";
				}else{
					if($consolidadoValues['variable_28'] < $Valor_Ideal[28] && $consolidadoValues['variable_28'] >=$Valor_Minimo[28]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_28'] > $Valor_Ideal[28] && $consolidadoValues['variable_28'] <=$Valor_Maximo[28]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_28'] >$Valor_Maximo[28]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_28'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[28].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[28].'//'.$Unidad[28].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_28'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[28].' ". ',$fk_usuario);
			}			
		}			

// Termina 28
		// Arranca 29
		if(!empty($consolidadoValues['variable_29'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_29'] != $Valor_Ideal[29]){

				if($consolidadoValues['variable_29'] <$Valor_Minimo[29]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_29'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[29].".";
				}else{
					if($consolidadoValues['variable_29'] < $Valor_Ideal[29] && $consolidadoValues['variable_29'] >=$Valor_Minimo[29]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_29'] > $Valor_Ideal[29] && $consolidadoValues['variable_29'] <=$Valor_Maximo[29]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_29'] >$Valor_Maximo[29]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_29'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[29].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[29].'//'.$Unidad[29].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_29'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[29].' ". ',$fk_usuario);
			}			
		}			

// Termina 29
		// Arranca 30
		if(!empty($consolidadoValues['variable_30'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_30'] != $Valor_Ideal[30]){

				if($consolidadoValues['variable_30'] <$Valor_Minimo[30]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_30'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[30].".";
				}else{
					if($consolidadoValues['variable_30'] < $Valor_Ideal[30] && $consolidadoValues['variable_30'] >=$Valor_Minimo[30]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_30'] > $Valor_Ideal[30] && $consolidadoValues['variable_30'] <=$Valor_Maximo[30]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_30'] >$Valor_Maximo[30]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_30'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[30].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[30].'//'.$Unidad[30].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_30'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[30].' ". ',$fk_usuario);
			}			
		}			

// Termina 30
		// Arranca 31
		if(!empty($consolidadoValues['variable_31'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_31'] != $Valor_Ideal[31]){

				if($consolidadoValues['variable_31'] <$Valor_Minimo[31]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_31'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[31].".";
				}else{
					if($consolidadoValues['variable_31'] < $Valor_Ideal[31] && $consolidadoValues['variable_31'] >=$Valor_Minimo[31]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_31'] > $Valor_Ideal[31] && $consolidadoValues['variable_31'] <=$Valor_Maximo[31]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_31'] >$Valor_Maximo[31]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_31'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[31].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[31].'//'.$Unidad[31].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_31'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[31].' ". ',$fk_usuario);
			}			
		}			

// Termina 31
		// Arranca 32
		if(!empty($consolidadoValues['variable_32'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_32'] != $Valor_Ideal[32]){

				if($consolidadoValues['variable_32'] <$Valor_Minimo[32]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_32'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[32].".";
				}else{
					if($consolidadoValues['variable_32'] < $Valor_Ideal[32] && $consolidadoValues['variable_32'] >=$Valor_Minimo[32]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_32'] > $Valor_Ideal[32] && $consolidadoValues['variable_32'] <=$Valor_Maximo[32]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_32'] >$Valor_Maximo[32]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_32'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[32].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[32].'//'.$Unidad[32].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_32'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[32].' ". ',$fk_usuario);
			}			
		}			

// Termina 32
		// Arranca 33
		if(!empty($consolidadoValues['variable_33'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_33'] != $Valor_Ideal[33]){

				if($consolidadoValues['variable_33'] <$Valor_Minimo[33]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_33'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[33].".";
				}else{
					if($consolidadoValues['variable_33'] < $Valor_Ideal[33] && $consolidadoValues['variable_33'] >=$Valor_Minimo[33]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_33'] > $Valor_Ideal[33] && $consolidadoValues['variable_33'] <=$Valor_Maximo[33]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_33'] >$Valor_Maximo[33]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_33'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[33].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[33].'//'.$Unidad[33].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_33'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[33].' ". ',$fk_usuario);
			}			
		}			

// Termina 33
		// Arranca 34
		if(!empty($consolidadoValues['variable_34'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_34'] != $Valor_Ideal[34]){

				if($consolidadoValues['variable_34'] <$Valor_Minimo[34]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_34'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[34].".";
				}else{
					if($consolidadoValues['variable_34'] < $Valor_Ideal[34] && $consolidadoValues['variable_34'] >=$Valor_Minimo[34]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_34'] > $Valor_Ideal[34] && $consolidadoValues['variable_34'] <=$Valor_Maximo[34]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_34'] >$Valor_Maximo[34]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_34'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[34].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[34].'//'.$Unidad[34].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_34'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[34].' ". ',$fk_usuario);
			}			
		}			

// Termina 34
		// Arranca 35
		if(!empty($consolidadoValues['variable_35'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_35'] != $Valor_Ideal[35]){

				if($consolidadoValues['variable_35'] <$Valor_Minimo[35]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_35'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[35].".";
				}else{
					if($consolidadoValues['variable_35'] < $Valor_Ideal[35] && $consolidadoValues['variable_35'] >=$Valor_Minimo[35]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_35'] > $Valor_Ideal[35] && $consolidadoValues['variable_35'] <=$Valor_Maximo[35]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_35'] >$Valor_Maximo[35]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_35'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[35].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[35].'//'.$Unidad[35].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_35'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[35].' ". ',$fk_usuario);
			}			
		}			

// Termina 35
		// Arranca 36
		if(!empty($consolidadoValues['variable_36'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_36'] != $Valor_Ideal[36]){

				if($consolidadoValues['variable_36'] <$Valor_Minimo[36]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_36'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[36].".";
				}else{
					if($consolidadoValues['variable_36'] < $Valor_Ideal[36] && $consolidadoValues['variable_36'] >=$Valor_Minimo[36]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_36'] > $Valor_Ideal[36] && $consolidadoValues['variable_36'] <=$Valor_Maximo[36]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_36'] >$Valor_Maximo[36]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_36'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[36].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[36].'//'.$Unidad[36].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_36'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[36].' ". ',$fk_usuario);
			}			
		}			

// Termina 36
		// Arranca 37
		if(!empty($consolidadoValues['variable_37'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_37'] != $Valor_Ideal[37]){

				if($consolidadoValues['variable_37'] <$Valor_Minimo[37]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_37'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[37].".";
				}else{
					if($consolidadoValues['variable_37'] < $Valor_Ideal[37] && $consolidadoValues['variable_37'] >=$Valor_Minimo[37]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_37'] > $Valor_Ideal[37] && $consolidadoValues['variable_37'] <=$Valor_Maximo[37]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_37'] >$Valor_Maximo[37]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_37'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[37].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[37].'//'.$Unidad[37].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_37'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[37].' ". ',$fk_usuario);
			}			
		}			

// Termina 37
		// Arranca 38
		if(!empty($consolidadoValues['variable_38'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_38'] != $Valor_Ideal[38]){

				if($consolidadoValues['variable_38'] <$Valor_Minimo[38]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_38'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[38].".";
				}else{
					if($consolidadoValues['variable_38'] < $Valor_Ideal[38] && $consolidadoValues['variable_38'] >=$Valor_Minimo[38]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_38'] > $Valor_Ideal[38] && $consolidadoValues['variable_38'] <=$Valor_Maximo[38]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_38'] >$Valor_Maximo[38]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_38'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[38].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[38].'//'.$Unidad[38].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_38'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[38].' ". ',$fk_usuario);
			}			
		}			

// Termina 38
		// Arranca 39
		if(!empty($consolidadoValues['variable_39'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_39'] != $Valor_Ideal[39]){

				if($consolidadoValues['variable_39'] <$Valor_Minimo[39]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_39'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[39].".";
				}else{
					if($consolidadoValues['variable_39'] < $Valor_Ideal[39] && $consolidadoValues['variable_39'] >=$Valor_Minimo[39]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_39'] > $Valor_Ideal[39] && $consolidadoValues['variable_39'] <=$Valor_Maximo[39]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_39'] >$Valor_Maximo[39]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_39'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[39].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[39].'//'.$Unidad[39].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_39'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[39].' ". ',$fk_usuario);
			}			
		}			

// Termina 39
		// Arranca 40
		if(!empty($consolidadoValues['variable_40'])){			
			$Dato='';
			$Alerta='';
			$TituloMensaje="Notificación Automática";			

			if($consolidadoValues['variable_40'] != $Valor_Ideal[40]){

				if($consolidadoValues['variable_40'] <$Valor_Minimo[40]){
					$Dato='Valor Minimo';
					$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy bajo de: ".$consolidadoValues['variable_40'].", Ya que su valor mínimo está configurado en: ".$Valor_Minimo[40].".";
				}else{
					if($consolidadoValues['variable_40'] < $Valor_Ideal[40] && $consolidadoValues['variable_40'] >=$Valor_Minimo[40]){				
						$Dato='Valor Mínimo';
						$Alerta='';
					}else{
						if($consolidadoValues['variable_40'] > $Valor_Ideal[40] && $consolidadoValues['variable_40'] <=$Valor_Maximo[40]){
							$Dato='Valor Máximo';	
							$Alerta='';
						}else{
							if($consolidadoValues['variable_40'] >$Valor_Maximo[40]){				
								$Dato='Valor Maximo';
								$Alerta="¡¡ ALERTA !! Si estás viendo este mensaje es porque el sistema presento un valor muy alto de: ".$consolidadoValues['variable_40'].", Ya que su valor máximo está configurado en: ".$Valor_Maximo[40].".";
							}

						}
					}
				}
				$this->CrearNotificacionValidacion($fk_equipos,$TituloMensaje,$Alerta.' El parametro '.
					$Parametro_Control[40].'//'.$Unidad[40].' de este equipo presento un valor de " '.
					$consolidadoValues['variable_40'].' " Lo cual generó esta alerta por encontrarse con un  '.$Dato. ', Cuyo valor ideal es'.' " '.$Valor_Ideal[40].' ". ',$fk_usuario);
			}			
		}			

// Termina 40

		$check = DB::table('consolidado_formularios')->insert($Datos);
		if($check >0){

			return 0;
		}else{
			return 1;
		}

	//dd('chek  '.$check);

	}


	// public function Semaforo()
	// {
	// 	$consolidadoValues = Input::all();
	// 	$Datos = array(


	// 		'Num_control_margin'                       => $consolidadoValues['variable_229756']
	// 		);
	// 	$check = DB::table('a_consolidado_compresor_15203v151')->insert($Datos);
	// 	if($check >0){
	// 		$Datos = array(
	// 			'semaforo'                       => 'Inactivo'
	// 			);
	// 		$check = DB::table('Asignaciones')
	// 		->where('id',$consolidadoValues['id_asignacion'])
	// 		->update($Datos);
	// 		return 0;
	// 	}else{
	// 		return 1;
	// 	}
	// }


	function pruebas(){

		return view('Administrador/Tablas.Tabla_Control_Consolidado');
	}

}