<?php

namespace Motivacion\Http\Controllers\AdministradorController;

use Illuminate\Http\Request;

use Motivacion\Http\Requests;
use Motivacion\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Response;
use Illuminate\Support\Facades\Validator;
use DB;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\UserTrait;
use Hash;
use Carbon\Carbon;
use File;
use Motivacion\Models\Asignaciones\Asignaciones_M;
use Motivacion\Models\Usuarios\Usuario;
use Motivacion\Models\Turnos\Turnos_M;
use Motivacion\Models\Formulario\Encabezado_Formulario;
use Motivacion\Models\Formulario\Detalle_Formulario;
use Motivacion\Models\Formulario\Consolidado_Formularios;
use Motivacion\Models\Notificaciones\Notificacion;
use Motivacion\Models\Equipos\Equipo;
use Redirect;
use App;
use PDF;

class Reportes_Controller extends Controller{

	public function Reporte_Maquinas(){
		return view('Administrador/Formularios.Reportes_Dano_Maquinas');
	}

	public function Cargar_Vista_Reportes(){
		$cambiar_password=Auth::user()->cambiar_password;       
		if($cambiar_password=='Si'){          
			return Redirect::to('MyProfile');
		}else{
			if(Auth::user()->fk_rol==1 ||Auth::user()->fk_rol==2 ){
				return view('Administrador/Formularios.Reportes_Estadisticos');
			}else{
				return redirect('Index');	
			}
		}
	}
	public function Cargar_Graficas(){
		$cambiar_password=Auth::user()->cambiar_password;       
		if($cambiar_password=='Si'){          
			return Redirect::to('MyProfile');
		}else{
			return view('Administrador/Diseno_Grafica_Estadistica');
		}
	}

	public function Listar_Parametros(){

		$Datos_Recibidos=Input::all();
		$mensaje=[];
		$mensaje[0] = "No se encontró ningún parámetro.";			

		$id_Formulario=Detalle_Formulario::Where('fk_formulario',$Datos_Recibidos['id_formulario'])->paginate(1);

		if($id_Formulario->total()!=0){
			$ultimo_registro=Detalle_Formulario::Where('fk_formulario',$Datos_Recibidos['id_formulario'])->get();						
			$ultimo_registroo=0;

			foreach ($ultimo_registro as $key => $value) {
				$ultimo_registroo=$value->id_version_formulario;
			}

			$Conulta_Parametros=Detalle_Formulario::orderBy('id','ASC')
			->Where('fk_formulario',$Datos_Recibidos['id_formulario'])
			->Where('id_version_formulario',$ultimo_registroo)
			->get();
			$Parametross=[];	
			$i=1;

			foreach ($Conulta_Parametros  as $resultados) {		
				$Parametross[$i++] = ucfirst($resultados->NombreParametro->nombre_parametro)." // UNIDAD: ---->  (".ucfirst($resultados->NombreUnidad->nombre_unidad).")";
			}		
			return $Parametross;			
			

		}else{
			return $mensaje;
		}
	}


	public function getUltimoDiaMes($elAnio,$elMes) {
		return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
	}

	public function Consultar_x_Fecha(){

		$id_formulario=Input::get('id_formulario');
		$ParametroControl=Input::get('ParametroControl');
		$Id_ParametroControl=Input::get('Id_ParametroControl');	
		$Id_TurnoControl=Input::get('Id_TurnoControl');		
		$AnoSelect=Input::get('AnoSelect');
		$MesSelect=Input::get('MesSelect');		
		$primer_dia=1;
		$ultimo_dia=$this->getUltimoDiaMes($AnoSelect,$MesSelect);

		$num = $Id_ParametroControl;
		$Id_ParametroControl = (int)$num;

		$ultimo_registro=Detalle_Formulario::Where('fk_formulario',$id_formulario)
		->Where('estado_registro','Activo')->get();

		$ultimo_registroo=0;

		foreach ($ultimo_registro as $key => $value) {
			$ultimo_registroo=$value->id_version_formulario;
		}

		$Detalle_Formulario=Detalle_Formulario::Where('fk_formulario',$id_formulario)
		->Where('id_version_formulario',$ultimo_registroo)
		->get();

		foreach ($Detalle_Formulario as $key => $value) {
			$parametros_control=$value->parametros_control;
			$porcentaje_minimo=$value->porcentaje_minimo;
			$unidad=$value->unidad;			
		}		

		if($MesSelect==1){
			$variable="01";
		}else if($MesSelect==2){
			$variable="02";
		}else if($MesSelect==3){
			$variable="03";
		}else if($MesSelect==4){
			$variable="04";
		}else if($MesSelect==5){
			$variable="05";
		}else if($MesSelect==6){
			$variable="06";
		}else if($MesSelect==7){
			$variable="07";
		}else if($MesSelect==8){
			$variable="08";
		}else if($MesSelect==9){
			$variable="09";
		}else if($MesSelect==10){
			$variable="10";
		}else if($MesSelect==11){
			$variable="11";
		}else if($MesSelect==12){
			$variable="12";
		}
		$FechaInicial=$AnoSelect.'-'.$variable.'-'.'01';
		$FechaFinal=$AnoSelect.'-'.$variable.'-'.$ultimo_dia;

		$consolidado_formularios=Consolidado_Formularios::whereBetween('fecha_ingreso', array($FechaInicial, $FechaFinal))
		->Where('fk_turno',$Id_TurnoControl)
		->where('fk_detalle_formulario',$id_formulario)->get();		
		
		if($consolidado_formularios!="[]"){	
			$Arreglo = array();	
			$ArregloVacio = array();
			$ArregloFinal = array();	
			$contador=0;
			$freno=true; $fecharestar;

			foreach ($consolidado_formularios as $key => $value) {				
				$FechaBD=$value->fecha_ingreso;
				$HoraTurnoInicio=Carbon::parse($value->Nombre_Turno->hora_inicio)->format('g:i A');
				$HoraTurnoFin=Carbon::parse($value->Nombre_Turno->hora_fin)->format('g:i A');

				$turno=$value->Nombre_Turno->nombre_turno.':'.' '.$HoraTurnoInicio.'---'.$HoraTurnoFin;	
				

				if($freno==true){
					$fecharestar = substr($FechaBD, -2);
					$freno=false;
					$FechaRestada=$ultimo_dia-$fecharestar;

					for ($i=0; $i < $fecharestar ; $i++) {
						$ArregloVacio[$i]=[0];
					}
				}			
				$contador++;
				$NumeroString = $value['campo'.$Id_ParametroControl];
				$NumeroParseado = (int)$NumeroString;
				$Arreglo[$contador]=$NumeroParseado;	
			}
			$ResultadoUnion = array_merge($ArregloVacio, $Arreglo);	

		}else{
			for ($i=0; $i < $ultimo_dia+1 ; $i++) {
				$ArregloVacio[$i]=[0];
			}
			$ResultadoUnion =$ArregloVacio;
			$turno=Input::get('NombreTurno');			

		}

		return view('Administrador/Diseno_Grafica.Diseno_Grafica_Estadistica')
		->with('parametros_control',$parametros_control)
		->with('porcentaje_minimo',$porcentaje_minimo)
		->with('unidad',$unidad)
		->with('turno',$turno)
		->with('ultimo_dia',$ultimo_dia)		
		->with('ResultadoUnion',json_encode($ResultadoUnion));
	}

	public function GenerarReporteDanoMaquinas(){
		$ruta_imagen = 'exports';
		File::makeDirectory($ruta_imagen, $mode = 0777, true, true);

		$id_maquina =Input::get('id_maquina');
		$Fecha_Inicial =Input::get('Fecha_Inicial');
		$Fecha_Final =Input::get('Fecha_Final');	


		$NombreMaquina=Equipo::Where('id',$id_maquina)->get();
		foreach ($NombreMaquina as $key => $value) {
			$NombreEquipo=$value->nombre_equipo;	

		}	

		$Notificacion=Notificacion::whereBetween('fecha_notificacion', array($Fecha_Inicial, $Fecha_Final))
		->Where('fk_equipo',$id_maquina)
		->OrderBy('hora_notificacion','DESC')	
		->paginate(10);

		if($Notificacion->total()!=0){

			$pdf = App::make('dompdf.wrapper'); 
			$pdf = PDF::loadView('Administrador/Tablas.Tabla_Reporte_Maquinas_Danadas',compact('Notificacion','NombreEquipo'))->setPaper('letter', 'landscape');

			$nombreArchivo='Reporte_Equipo';
			$RutaArchivo='exports/'.$nombreArchivo.'.pdf';
			$output = $pdf->output();
			file_put_contents($RutaArchivo, $output);

			return Response::json([			
				'success' =>true,
				'path'=>$RutaArchivo='exports/'.$nombreArchivo.'.pdf',
				'RutaArchivo'=>$RutaArchivo]);

		}else{
			return 1;
		}
	}

	public function delete_archivo_exportado(){
		$NombreArchivo=Input::get('ruta');


		if (File::exists($NombreArchivo)) {
			File::delete($NombreArchivo);			
		}

	}

	public function Cargar_Ano_Mes_Reporte(){
		$now = Carbon::now();
		$Ano=$now->year;
		$Mes=$now->month;
		$MesFinal="";
		return Response::json([			
			'Ano' =>$Ano,'Mes' =>$Mes,
			]);		
	}

	public function Cargar_Turnos_Registrados(){
		$Turnos=Turnos_M::OrderBy('id','ASC')->get();

		$Turnoss=[];	

		foreach ($Turnos  as $resultados) {	

			$HoraTurnoInicio=Carbon::parse($resultados->hora_inicio)->format('g:i A');
			$HoraTurnoFin=Carbon::parse($resultados->hora_fin)->format('g:i A');

			$Turnoss[$resultados->id] = $resultados->nombre_turno.':'.' '.$HoraTurnoInicio.'---'.$HoraTurnoFin;
		}		
		return $Turnoss;

	}

}
