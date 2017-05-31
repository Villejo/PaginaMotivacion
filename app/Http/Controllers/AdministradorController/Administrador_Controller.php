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
use Motivacion\Models\Equipos\Equipo;
use Motivacion\Models\Equipos\Tipo_Equipo;
use Motivacion\Models\Formulario\Consolidado_Formularios;
use Motivacion\Models\Parametros\Tipo_Parametro;
use Motivacion\Models\Parametros\Tipo_Unidad;
use Redirect;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Administrador_Controller extends Controller{

	public function Asignaciones() {
		$cambiar_password=Auth::user()->cambiar_password;       
		if($cambiar_password=='Si'){          
			return Redirect::to('MyProfile');
		}else{
			if(Auth::user()->fk_rol==1 ||Auth::user()->fk_rol==2 ){
				return view('Administrador/Formularios.Create_Asignaciones');
			}else{
				return redirect('Index');			
			}
		}
	}
	public function Tabla_Asignaciones(){
		$Asignaciones=Asignaciones_M::orderBy('id','desc')->paginate(4);
		return view('Administrador/Tablas.Tabla_Asignaciones')
		->with('Asignaciones',$Asignaciones);
	}
	public function Tabla_Equpipos_C(){
		$Equipos=Equipo::orderBy('id','desc')->get();
		return view('Administrador/Tablas.Tabla_Equipos')
		->with('Equipos',$Equipos);
	}
	public function Listar_Usuarios(){
		$Empleados=Usuario::orderBy('nombre_usuario','asc')		
		->Where('fk_rol','>',1)
		->get();
		$Empleadoss=[];	

		foreach ($Empleados  as $resultados) {		
			$Empleadoss[$resultados->id] = $resultados->nombre_usuario.' '.$resultados->apellido.'---Codigo: '.$resultados->codigo;
		}		
		return $Empleadoss;
	}
	public function Listar_Turnos(){

		$Turnos=Turnos_M::orderBy('nombre_turno','asc')			
		->get();

		$Turnoss=[];	

		foreach ($Turnos  as $resultados) {	

			$HoraTurnoInicio=Carbon::parse($resultados->hora_inicio)->format('g:i A');
			$HoraTurnoFin=Carbon::parse($resultados->hora_fin)->format('g:i A');

			$Turnoss[$resultados->id] = $resultados->nombre_turno.':'.' '.$HoraTurnoInicio.'---'.$HoraTurnoFin;
		}		
		return $Turnoss;
	}

	public function Listar_Formularios(){

		$Formularios=Encabezado_Formulario::orderBy('nombre_formulario','asc')			
		->get();

		$Formularioss=[];	

		foreach ($Formularios  as $resultados) {				

			$Formularioss[$resultados->id] = $resultados->nombre_formulario;
		}		
		return $Formularioss;
	}

	public function RegistrarNewAsignacion(){
		$Asignaciones=Asignaciones_M::
		// Where('fk_usuarios',Input::get('id_nombre_usuario'))
		Where('fk_turno',Input::get('id_turno'))
		->Where('fk_formulario',Input::get('id_formulario'))
		->paginate(1);		


		if($Asignaciones->total()!=0){
			return 3;
		}else{
			$rules = array
			(
				'id_nombre_usuario'     => 'required',
				'id_turno'   	   		=> 'required',
				'id_formulario'  		=> 'required',
				'FechaInicial' 			=> 'required', 
				'FechaFinal' 			=> 'required', 

				);

			$message = array
			(
				'id_nombre_usuario.required'=> ' Por favor seleccione un  Usuario.',		
				'id_turno.required'  		=> ' Por favor seleccione un Turno.',			
				'id_formulario.required'   	=> ' Por favor seleccione un Formulario.',			
				'FechaInicial.required'   	=> ' Por favor seleccione una fecha Inicial.',	
				'FechaFinal.required'   	=> ' Por favor seleccione una fecha Final.'			
				);

			$validator = Validator::make(Input::All(), $rules, $message);
			if ($validator->fails()) {

				return Response::json(['error' =>false,
					'errors'=>$validator->errors()->toArray()]);
			}else{	

				$Mensaje=Input::all();
				$Mensajes = array(
					'fk_usuarios'     => $Mensaje['id_nombre_usuario'],
					'fk_turno'        => $Mensaje['id_turno'],
					'fk_formulario'   => $Mensaje['id_formulario'],
					'estado'          => 'Activo',
					'fecha_inicio'    => $Mensaje['FechaInicial'],
					'fecha_fin'  	  => $Mensaje['FechaFinal'],	
					'fk_maquina'  	  => $Mensaje['id_maquina_oculta']								   
					);

				$check = DB::table('asignaciones')->insert($Mensajes);			

				if($check >0){
					return 0;
				}
			}
		}
	}

	public function Eliminar_Asignacion(){

		$Mensaje=Input::all();

		$check = DB::table('asignaciones')
		->where('id',$Mensaje['id_asignacion_eliminar'])
		->delete();

		if($check >0){
			return 0;
		}
	}

	public function Cargar_Datos_Editar_Asignacion(){
		$datos_editar=Input::all();	

		$Asignaciones=Asignaciones_M::Where('id',$datos_editar['id_Editar_Asignacion'])->get();

		foreach ($Asignaciones as $key => $value) {
			$id_usuario=$value->Nombre_Usuario->id;	
			$fk_turno=$value->fk_turno;
			$fk_formulario=$value->fk_formulario;		
			$fecha_inicial=Carbon::parse($value->fecha_inicio)->toDateString();
			$fecha_final=Carbon::parse($value->fecha_fin)->toDateString();
			$id_oculto=$value->id;
			$id_maquina=$value->fk_maquina;
		}		

		return Response::json(['id_usuario'=>$id_usuario,
			'fk_turno'=>$fk_turno,
			'fk_formulario'=>$fk_formulario,			
			'fecha_inicial'=>$fecha_inicial,
			'fecha_final'=>$fecha_final,
			'id_oculto'=>$id_oculto,
			'id_maquina'=>$id_maquina]);
	}

	public function ModificarAsignacion(){

		$id_nombre_usuario_editar_oculto=Input::get('id_nombre_usuario_editar_oculto');
		$id_turno_editar_oculto=Input::get('id_turno_editar_oculto');
		$id_formulario_editar_oculto=Input::get('id_formulario_editar_oculto');

		$id_nombre_usuario_editar=Input::get('id_nombre_usuario_editar');
		$id_turno_editar=Input::get('id_turno_editar');
		$id_formulario_editar=Input::get('id_formulario_editar');

		

		if($id_nombre_usuario_editar_oculto==$id_nombre_usuario_editar && $id_turno_editar_oculto==$id_turno_editar && $id_formulario_editar_oculto==$id_formulario_editar){
			$rules = array
			(
				'id_nombre_usuario_editar'     => 'required',
				'id_turno_editar'   	   		=> 'required',
				'id_formulario_editar'  		=> 'required',
				'Fecha_Inicial_editar' 			=> 'required', 
				'Fecha_Final_editar' 			=> 'required', 

				);

			$message = array
			(
				'id_nombre_usuario_editar.required'=> ' Por favor seleccione un  Usuario.',		
				'id_turno_editar.required'  		=> ' Por favor seleccione un Turno.',			
				'id_formulario_editar.required'   	=> ' Por favor seleccione un Formulario.',			
				'Fecha_Inicial_editar.required'   	=> ' Por favor seleccione una fecha Inicial.',	
				'Fecha_Final_editar.required'   	=> ' Por favor seleccione una fecha Final.'			
				);

			$validator = Validator::make(Input::All(), $rules, $message);
			if ($validator->fails()) {

				return Response::json(['error' =>false,
					'errors'=>$validator->errors()->toArray()]);
			}else{	
				$datos_editar=Input::all();

				
				$datos_editarr = array(
					'fk_usuarios'     => $datos_editar['id_nombre_usuario_editar'],
					'fk_turno'        => $datos_editar['id_turno_editar'],
					'fk_formulario'   => $datos_editar['id_formulario_editar'],
					'estado'          => 'Activo',
					'fecha_inicio'    => $datos_editar['Fecha_Inicial_editar'],
					'fecha_fin'  	  => $datos_editar['Fecha_Final_editar'],
					'fk_maquina'  	  => $datos_editar['id_maquina_oculta_editar']			   
					);

				$check = DB::table('asignaciones')
				->where('id',$datos_editar['id_oculto_editar'])
				->update($datos_editarr);	

				if($check >0){
					return 0;
				}else{
					return 1;
				}
			}	
		}else{	
			$Asignaciones=Asignaciones_M::
			Where('fk_usuarios',Input::get('id_nombre_usuario_editar'))
			->Where('fk_turno',Input::get('id_turno_editar'))
			->Where('fk_formulario',Input::get('id_formulario_editar'))
			->paginate(1);		

			if($Asignaciones->total()!=0){
				return 3;
			}else{

				$rules = array
				(
					'id_nombre_usuario_editar'     => 'required',
					'id_turno_editar'   	   		=> 'required',
					'id_formulario_editar'  		=> 'required',
					'Fecha_Inicial_editar' 			=> 'required', 
					'Fecha_Final_editar' 			=> 'required', 

					);

				$message = array
				(
					'id_nombre_usuario_editar.required'=> ' Por favor seleccione un  Usuario.',		
					'id_turno_editar.required'  		=> ' Por favor seleccione un Turno.',			
					'id_formulario_editar.required'   	=> ' Por favor seleccione un Formulario.',			
					'Fecha_Inicial_editar.required'   	=> ' Por favor seleccione una fecha Inicial.',	
					'Fecha_Final_editar.required'   	=> ' Por favor seleccione una fecha Final.'			
					);

				$validator = Validator::make(Input::All(), $rules, $message);
				if ($validator->fails()) {

					return Response::json(['error' =>false,
						'errors'=>$validator->errors()->toArray()]);
				}else{	
					$datos_editar=Input::all();
					$datos_editarr = array(
						'fk_usuarios'     => $datos_editar['id_nombre_usuario_editar'],
						'fk_turno'        => $datos_editar['id_turno_editar'],
						'fk_formulario'   => $datos_editar['id_formulario_editar'],
						'estado'          => 'Activo',
						'fecha_inicio'    => $datos_editar['Fecha_Inicial_editar'],
						'fecha_fin'  	  => $datos_editar['Fecha_Final_editar'],	
						'fk_maquina'  	  => $datos_editar['id_maquina_oculta_editar']			   
						);

					$check = DB::table('asignaciones')
					->where('id',$datos_editar['id_oculto_editar'])
					->update($datos_editarr);	

					if($check >0){
						return 0;
					}else{
						return 1;
					}
				}
			}
		}
	}	

	public function ConsultarAsignacionUsuario(){
		$datos=Input::all();	

		$Asignaciones=Asignaciones_M::Where('fk_usuarios',$datos['id_select_usuario'])->paginate(10);

		if($Asignaciones->total()==0){
			return 0;
		}else{
			return view('Administrador/Tablas.Tabla_Asignaciones')
			->with('Asignaciones',$Asignaciones);
		}
	}

	public function EdicionFormulario(){
		$cambiar_password=Auth::user()->cambiar_password;       
		if($cambiar_password=='Si'){          
			return Redirect::to('MyProfile');
		}else{
			if(Auth::user()->fk_rol==1 ||Auth::user()->fk_rol==2 ){	
				return view('Administrador/Formularios.Create_Formulario');
			}else{
				return redirect('Index');	
			}
		}
	}

	public function Listar_tabla_formularios_seleccioandos(){

		$id_formulario_mostrar=Input::get('id_formulario_mostrar');

		$detalleFormulario=Detalle_Formulario::Where('estado_registro','activo')
		->Where('fk_formulario',$id_formulario_mostrar)
		->paginate(16);

		$ultimo_registro=Detalle_Formulario::Where('fk_formulario',$id_formulario_mostrar)->get();	

		$ultimo_registro_encontrado=1;

		foreach ($ultimo_registro as $key => $value) {
			$ultimo_registro_encontrado=$value->id_version_formulario;
		}

		$Ultimo_id_version_Nuevo_Formulario=$ultimo_registro_encontrado+1;
		$Ultimo_id_version_Nuevo_Registro=$ultimo_registro_encontrado;

		return view('Administrador/Tablas.Tabla_Formularios')
		->with('detalleFormulario',$detalleFormulario)
		->with('Ultimo_id_version_Nuevo_Formulario',$Ultimo_id_version_Nuevo_Formulario)
		->with('Ultimo_id_version_Nuevo_Registro',$Ultimo_id_version_Nuevo_Registro)
		->with('id_formulario_mostrar',$id_formulario_mostrar);
	}

	public function Registrar_Nuevo_Detalle_Formulario(){
		$rules = array
		(
			'reg_Parametros_Control'    => 'required',			
			'reg_unidad'  				=> 'required'
			);

		$message = array
		(
			'reg_Parametros_Control.required'	=> ' Por favor seleccione un  Usuario.',				
			'reg_unidad.required'   			=> ' Por favor seleccione un Formulario.'				
			);
		$validator = Validator::make(Input::All(), $rules, $message);
		if ($validator->fails()) {

			return Response::json(['error' =>false,
				'errors'=>$validator->errors()->toArray()]);
		}else{	
			$datos=Input::all();
			$datos_nuevos = array(
				'fk_formulario'     	=> $datos['id_formulario_mostrar'],
				'parametros_control' 	=> $datos['reg_Parametros_Control'],				
				'unidad'          		=> $datos['reg_unidad'],
				'valor_ideal'  			=> $datos['reg_porcentaje_minimo'],
				'valor_minimo'    		=> $datos['reg_alarma'],
				'valor_maximo'  	  	=> $datos['reg_disparo'],	
				'id_version_formulario' => $datos['Ultimo_id_version_Nuevo_Registro'],	
				'estado_registro'  	  	=> 'Activo'					   
				);
			$check = DB::table('detalle_formulario')->insert($datos_nuevos);
			if($check >0){
				return 0;
			}
		}
	}

	public function Eliminar_Registro_Detalle_Formulario(){
		$Id_Detalle_Formulario_Elimiar=Input::get('id_registro_detalle_eliminar');
		$check = DB::table('detalle_formulario')
		->Where('id',$Id_Detalle_Formulario_Elimiar)->delete();
		if($check >0){
			return 0;
		}

	}

	public function Confirmar_Edicion(){

		$Variables= Input::all();
		
		$id_editar_registro=$Variables['Id_formulario_editar_registro'];
		$id_parametros_editar=$Variables['id_parametro_seleccionado2'];
		$Unidad_editar=$Variables['id_select_unidad2'];
		$Porcentaje_Minimo_editar=$Variables['Porcentaje_Minimo_editar'];
		
		$Alarma_editar=$Variables['Alarma_editar'];
		$Disparo_editar=$Variables['Disparo_editar'];

		$rules = array
		(
			'id_parametro_seleccionado2'     => 'required',
			'id_select_unidad2'   	   	   => 'required'	
			);
		$message = array
		(
			'id_parametro_seleccionado2.required'     => 'Por favor Seleccione un parametro.',
			'id_select_unidad2.required'  		    => ' Por favor Seleccione una unidad.'		
			);
		$validator = Validator::make(Input::All(), $rules, $message);
		if ($validator->fails()) {

			return Response::json(['error' =>false,
				'errors'=>$validator->errors()->toArray()]);
		}else{
			$datos_editarr = array(
				
				'parametros_control'      => $Variables['id_parametro_seleccionado2'],
				'valor_ideal'             => $Variables['Porcentaje_Minimo_editar'],
				'unidad'            	  => $Variables['id_select_unidad2'],
				'valor_minimo'            => $Variables['Alarma_editar'],
				'valor_maximo'            => $Variables['Disparo_editar'],	
				);		

			$check = DB::table('detalle_formulario')
			->where('id',$id_editar_registro)
			->update($datos_editarr);	

			if($check >0){
				return 0;
			}else{
				return 1;
			}			
		}
	}

	public function Listar_Nombres_Formularios(){
		$NombreFormularios=Encabezado_Formulario::orderBy('nombre_formulario','asc')			
		->get();

		$NombresFormularios=[];	

		foreach ($NombreFormularios  as $resultados) {			

			$NombresFormularios[$resultados->id] = strtoupper($resultados->nombre_formulario);
		}		
		return $NombresFormularios;
	}

	public function Listar_Nombres_Equipos(){
		$NombreEquipos=Equipo::Where('estado_registro','Activo')->get();

		$NombreEquipo=[];	

		foreach ($NombreEquipos  as $resultados) {			

			$NombreEquipo[$resultados->id] = strtoupper($resultados->nombre_equipo);
		}		
		return $NombreEquipo;
	}

	public function RegistraNuevoFormulario(){
		$Nombre_formulario=Input::get('Nombre_Nuevo_Formulario');
		$id_equipo=Input::get('id_nombre_equipo');

		$Encabezado_Formulario=Encabezado_Formulario::Where('fk_equipos',$id_equipo)->paginate(1);		

		if($Encabezado_Formulario->total()!=0){
			return 3;
		}else{
			$rules = array
			(
				'Nombre_Nuevo_Formulario'     => 'required',
				'id_nombre_equipo'   	   	=> 'required'
				);
			$message = array
			(
				'Nombre_Nuevo_Formulario.required'=> ' Por favor Ingrese Nombre Formulario.',		
				'id_nombre_equipo.required'  		=> ' Por favor Seleccione ua maquina.',					
				);
			$validator = Validator::make(Input::All(), $rules, $message);
			if ($validator->fails()) {

				return Response::json(['error' =>false,
					'errors'=>$validator->errors()->toArray()]);
			}else{

				$Fecha=Carbon::now();
				$Datos = array(
					'fk_equipos'    			 => $id_equipo,
					'Nombre_Formulario'       	 => $Nombre_formulario,
					'fecha_creacion_formulario'  => $Fecha								   
					);
				$check = DB::table('encabezado_formulario')->insert($Datos);			

				if($check >0){
					return 0;
				}

			}
		}		
	}	
	public function Consultar_Datos_Formulario_Editar(){
		$Id_Formulario_Editar=Input::get('id_formulario_mostrar');

		$Datos_Formulario=Encabezado_Formulario::Where('id',$Id_Formulario_Editar)->get();

		foreach ($Datos_Formulario as $key => $value) {
			$NombreFormulario=$value->nombre_formulario;
			$NombreEquipo=$value->Nombre_Equipo->id;
			$id_encabezado_oculto=$value->id;
		}

		return Response::json(['NombreFormulario'=>$NombreFormulario,
			'NombreEquipo'=>$NombreEquipo,
			'id_encabezado_oculto'=>$id_encabezado_oculto]);
	}

	public function Editar_Emcabezado_Formulario(){
		$id_nombre_equipo_editar= Input::get('id_nombre_equipo_editar');
		$Nombre_Formulario_Editar=Input::get('Nombre_Formulario_Editar');
		$id_nombre_equipo_editar_Oculto= Input::get('id_nombre_equipo_editar_Oculto');
		$Nombre_Formulario_Editar_Oculto=Input::get('Nombre_Formulario_Editar_Oculto');	
		$id_encabezado_oculto=Input::get('id_encabezado_oculto');	

		if($id_nombre_equipo_editar==$id_nombre_equipo_editar_Oculto && $Nombre_Formulario_Editar==$Nombre_Formulario_Editar_Oculto){
			return 3;
		}else{ //-------------------------
			if($id_nombre_equipo_editar!=$id_nombre_equipo_editar_Oculto){
				$Equipos=Encabezado_Formulario::Where('fk_equipos',$id_nombre_equipo_editar)->paginate(1);
				if($Equipos->total()!=0){
					return 4;				
				}
			}
			if($Nombre_Formulario_Editar_Oculto!=$Nombre_Formulario_Editar){
				$NombreFormulario=Encabezado_Formulario::where('nombre_formulario',$Nombre_Formulario_Editar)->paginate(1);
				if($NombreFormulario->total()!=0){
					return 5;
				}
			}
			$rules = array
			(
				'id_nombre_equipo_editar'      => 'required',
				'Nombre_Formulario_Editar'     => 'required'	
				);

			$message = array
			(
				'id_nombre_equipo_editar.required'    => ' Por favor seleccione un equipo.',		
				'Nombre_Formulario_Editar.required'   => ' Por favor Ingrese un Nombre de formulario.'	
				);


			$validator = Validator::make(Input::All(), $rules, $message);
			if ($validator->fails()) {

				return Response::json(['error' =>false,
					'errors'=>$validator->errors()->toArray()]);
			}else{	
				$Variables=Input::all();
				$datos_editarr = array(
					'fk_equipos'     		  => $Variables['id_nombre_equipo_editar'],
					'nombre_formulario'       => $Variables['Nombre_Formulario_Editar']
					);
				$check = DB::table('encabezado_formulario')
				->where('id',$id_encabezado_oculto)
				->update($datos_editarr);	

				if($check >0){
					return 0;
				}else{
					return 1;
				}
			}	
		}			

	} //------------------------------------
//-----------------------------------equipos-----------------------------------------------

	public function ConsultarEquipo_C(){

		$datos=Input::all();
		$id_equipo=$datos['id_select_Equipo'];

		$datos_equipo=Equipo::Where('id',$id_equipo)->get();

		return view('Administrador/Tablas.Tabla_Equipos')->with('datos_equipo',$datos_equipo);

	}

	public function Equipos_V(){

		return view('Administrador/Formularios.Create_Equipos');

	}
	public function RegistrarNuevoEquipo_C(){

		$infoEquipos=Input::all();

		// dd($infoEquipos);
		$Datoexistente=Equipo::where('nombre_equipo',$infoEquipos['nombre_equipo'])->orWhere('identificador',$infoEquipos['identificador'])->get();

		$cont=0;
		foreach ($Datoexistente as $key => $value) {
			$cont++;
		}

		$Datos = array(

			'nombre_equipo'    => $infoEquipos['nombre_equipo'],
			'identificador'    => $infoEquipos['identificador'],
			'ubicacion'        => $infoEquipos['ubicacion'],
			'descripcion'      => $infoEquipos['descripcion'],
			'marca'       	   => $infoEquipos['marca'],
			// 'fk_tipo_equipo'   => $infoEquipos['id_tipo_equipo'],
			'fecha_registro'   => $infoEquipos['Fecha_Registro'],
			'estado_equipo'    => $infoEquipos['estado_equipo'],
			);

		if($cont > 0){
			return Response::json(['repetido'=>"si"]);			
		}else{

			$check = DB::table('equipos')->insert($Datos);	

			$datos=Equipo::all();
			foreach ($datos as $key => $value) {
				$ultimo_id=$value->id;
			}	

			if($check >0){
				return Response::json(['resultado'=>0,
					'ultimo_id'=>$ultimo_id]);			
			}		
		}
	}

	public function Listar_Tipos_Equipos_C(){
		$DatosTipoEquipos=Tipo_Equipo::all();
		$TipoEquipo=[];	

		foreach ($DatosTipoEquipos  as $resultados) {			

			$TipoEquipo[$resultados->id] = $resultados->nombre_tipo_equipos;
		}		
		return $TipoEquipo;
	}


	public function ConfirmarActualizacionEquipo_C(){

		$infoEquipos=Input::all();
		$cont_Ced=0;
		$cont_nombre=0;
		$id=$infoEquipos['id'];
		$nombre_Equipo_ingresada=$infoEquipos['nombre_equipo'];
		$identificador_ingresada=$infoEquipos['identificador'];


		$nombre_equipo_existente=Equipo::where('nombre_equipo',$nombre_Equipo_ingresada)->where('id','!=',$id)->get();

		$ced_existente=Equipo::where('identificador',$identificador_ingresada)->where('id','!=',$id)->get();

		foreach ($nombre_equipo_existente as $key => $value) {
			$cont_nombre++;
		}

		foreach ($ced_existente as $key => $value) {
			$cont_Ced++;
		}	
		
		$Datos = array(
			'nombre_equipo'    => $infoEquipos['nombre_equipo'],
			'identificador'    => $infoEquipos['identificador'],
			'ubicacion'        => $infoEquipos['ubicacion'],
			'descripcion'      => $infoEquipos['descripcion'],
			'marca'       	   => $infoEquipos['marca'],
			'fecha_registro'   => $infoEquipos['Fecha_Registro'],
			'estado_equipo'    => $infoEquipos['estado_equipo'],
			);

		if($cont_nombre==0 && $cont_Ced==0){
			$check = DB::table('equipos')->where('id',$id)->update($Datos);

			if($check >0){
				return Response::json(['cont_nombre'=>$cont_nombre,'cont_Ced'=>$cont_Ced]);	
			}else{
				return 2;
			}		
		}else if($cont_nombre>0 || $cont_Ced>0){
			return Response::json(['cont_nombre'=>$cont_nombre,'cont_Ced'=>$cont_Ced]);	
		}
	}
	public function Eliminar_Equipo_C(){
		$id_equipo=Input::get('id_equipo_eliminar');

		$Datos = array(
			'estado_registro'    => 'Inactivo'			
			);

		$check = DB::table('equipos')->where('id',$id_equipo)->update($Datos);

		if($check>0){
			return 0;
		}
	}
	public function Consultar_Id_Maquina(){

		$id_Consulta=0;
		$id_formulario=Input::get('id_formulario');
		$id_formulario_editar=Input::get('id_formulario_editar');		

		if($id_formulario!=null){
			$id_Consulta=$id_formulario;

		}else{
			if($id_formulario_editar!=null){
				$id_Consulta=$id_formulario_editar;
			}
		}

		$Equipos=Encabezado_Formulario::Where('id',$id_Consulta)->get();

		foreach ($Equipos as $key => $value) {
			$id_equipo=$value->fk_equipos;
		}

		return $id_equipo;
	}


public function Autocompletar_consolidado_C(){ //--------------------------------


	$fechaActual =Carbon::now()->toDateString(); 

	$horaActual  = Carbon::now()->toTimeString();
	$yesterday = Carbon::yesterday()->toDateString();
	$turno=0;
	

	if($horaActual>="14:00:01" &&  $horaActual<="22:00:00"){
		$turno=1;
	}
	if($horaActual>="22:00:01" &&  $horaActual<="23:59:59" ||  $horaActual>="00:00:00" &&  $horaActual<="06:00:00"){
		$turno=2;
	}
	if($horaActual>="06:00:01" &&  $horaActual<="14:00:00" ){
		$turno=3;
	}
	$Asignaciones=Asignaciones_M::Where('fecha_fin','>=', $fechaActual)
	->Where('estado','Activo')
	->Where('fk_turno',$turno)->get();

	$usuario;   $turno;     $formulario;    $contador=0;  // declaracionde variables

	foreach ($Asignaciones as $key => $value) {
		$usuario=$value->fk_usuarios;
		$turno=$value->fk_turno;
		$formulario=$value->fk_formulario;
		$NombreEquipo=$value->fk_maquina;
		$NombreUsuario=ucfirst($value->Nombre_Usuario->nombre_usuario)." ". ucfirst($value->Nombre_Usuario->apellido);

		$NombreFormulario=$value->Nombre_Formulario->nombre_formulario;
		$NombreTurno=$value->Nombre_Turno->nombre_turno;	

		if($turno==3){
			$Datos = array(
				'fk_encabezado_formulario'    => $formulario,	
				'fk_detalle_formulario'	      => $formulario,
				'fk_usuario'	      		  => $usuario,
				'fk_turno'                    => 3,
				'fecha_ingreso'	              => $yesterday,
				'campo1'	                  => 0,
				'campo2'	                  => 0,
				'campo3'	                  => 0,
				'campo4'	                  => 0,
				'campo5'	                  => 0,
				'campo6'	                  => 0,
				'campo7'	                  => 0,
				'campo8'	                  => 0,
				'campo9'	                  => 0,
				'campo10'	                  => 0,
				'campo11'	                  => 0,
				'campo12'	                  => 0,
				'campo13'	                  => 0,
				'campo14'	                  => 0,
				'campo15'	                  => 0,
				'campo16'	                  => 0,
				);
		}else{
			$Datos = array(
				'fk_encabezado_formulario'    => $formulario,	
				'fk_detalle_formulario'	      => $formulario,
				'fk_usuario'	      		  => $usuario,
				'fk_turno'                    => $turno,
				'fecha_ingreso'	              => $fechaActual,
				'campo1'	                  => 0,
				'campo2'	                  => 0,
				'campo3'	                  => 0,
				'campo4'	                  => 0,
				'campo5'	                  => 0,
				'campo6'	                  => 0,
				'campo7'	                  => 0,
				'campo8'	                  => 0,
				'campo9'	                  => 0,
				'campo10'	                  => 0,
				'campo11'	                  => 0,
				'campo12'	                  => 0,
				'campo13'	                  => 0,
				'campo14'	                  => 0,
				'campo15'	                  => 0,
				'campo16'	                  => 0,
				);
		}
		if($turno==2 || $turno==1){
			 // dd('condicion turno 3 y 2');
			$consolidado=consolidado_formularios::Where('fecha_ingreso',$fechaActual)
			->Where('fk_usuario',$usuario)
			->Where('fk_turno',$turno)
			->Where('fk_encabezado_formulario',$formulario)->get();

		}else if($turno==3 ){
			 // dd('condicion turno 3');
			$consolidado=consolidado_formularios::Where('fecha_ingreso',$yesterday)
			->Where('fk_usuario',$usuario)
			->Where('fk_turno',3)
			->Where('fk_encabezado_formulario',$formulario)->get();
		}

		if($consolidado=="[]"){
			$check = DB::table('consolidado_formularios')->insert($Datos);

			$Mensaje='El usuario: '.$NombreUsuario. ' no ingreso datos en: '.' " '.$NombreFormulario.' " '.' del turno: '.' " '.$NombreTurno.' ".';

			$Titulo_Mensaje="RUTA NO DILIGENCIADA";
			
			$this->CrearNotificacionValidacion($NombreEquipo,$Titulo_Mensaje,$Mensaje);
		}else{

		}

	}

	} //------------------
	public function CrearNotificacionValidacion($id_equipo,$titulo_mensaje,$mensaje){

		$hora_notificacion=carbon::now();
		$fecha_notificacion=carbon::now();

		$Datos = array(
			'fk_equipo'=>$id_equipo,
			'titulo_mensaje'=>$titulo_mensaje,
			'mensaje'=>$mensaje,
			'imagen_foto'=>'global/images/error.png',
			'fk_usuario'=>1,
			'hora_notificacion'=>$hora_notificacion,
			'fecha_notificacion'=>$fecha_notificacion,
			'estado'=>'Si',
			);
		$check = DB::table('notificaciones')->insert($Datos);

	}
//------------------------------control  consolidado ----------------


	function control_consolidado_C(){

		return view('Administrador/Formularios.Control_Consolidado');
	}



	public function Listar_datos_usuarios_Activos_C(){

		$Estado=Input::get('estado');		

		$DAtosUsuarios=Usuario::Where('id','>',1)->
		Where('estado_usuario',$Estado)->get();

		$DatoUsuario=[];	

		foreach ($DAtosUsuarios  as $resultados) {			

			$DatoUsuario[$resultados->id] = strtoupper($resultados->nombre_usuario."      ".$resultados->apellido."   -          CODIGO:   ".$resultados->codigo);

		}		
		return $DatoUsuario;
	}

	public function Listar_datos_turnos_C (){

		$Id_USuario=Input::get('id_usuario_selecc');

		$DAtosTurnos=Asignaciones_M::orderBy('id','DESC')
		->Where('fk_usuarios',$Id_USuario)
		->get();		
		$mensaje[0] = "¡¡ El usuario no tiene turno vigente !!";	

		$DatosTurno=[];	
		if($DAtosTurnos!='[]'){
			foreach ($DAtosTurnos  as $resultados) {
				$HoraTurnoInicio=Carbon::parse($resultados->Nombre_Turno->hora_inicio)->format('g:i A');
				$HoraTurnoFin=Carbon::parse($resultados->Nombre_Turno->hora_fin)->format('g:i A');			

				$DatosTurno[$resultados->fk_turno] =$resultados->Nombre_Turno->nombre_turno.':'.' '.$HoraTurnoInicio.'--'.$HoraTurnoFin;

			}		
			return $DatosTurno;

		}else{
			return $mensaje;
		}

	}

//--------- configuracion de fechas -----------------
	public function getUltimoDiaMes($elAnio,$elMes) {
		return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
	}

	public function ListarMesActual(){
		$now = Carbon::now();
		$Anio=$now->year;	
		$mes=$now->month;

		if($mes==1){
			$variable="01";
		}else if($mes==2){
			$variable="02";
		}else if($mes==3){
			$variable="03";
		}else if($mes==4){
			$variable="04";
		}else if($mes==5){
			$variable="05";
		}else if($mes==6){
			$variable="06";
		}else if($mes==7){
			$variable="07";
		}else if($mes==8){
			$variable="08";
		}else if($mes==9){
			$variable="09";
		}else if($mes==10){
			$variable="10";
		}else if($mes==11){
			$variable="11";
		}else if($mes==12){
			$variable="12";
		}

		$ultimo_dia_mes=$this->getUltimoDiaMes($Anio,$variable);

		$FechaInicial=$Anio.'-'.$variable.'-'.'01';
		$FechaFinal=$Anio.'-'.$variable.'-'.$ultimo_dia_mes;

		return Response::json(['FechaInicial' =>$FechaInicial,
			'FechaFinal' =>$FechaFinal,		
			]);
	}
	
	public function Listar_Formularios_C (){

		$Id_USuario =Input::get('id_usuario_selecc');
		$Id_Turno   =Input::get('id_turno_selecc');
		
		$DAtosTurnos=Asignaciones_M::distinct('nombre_formulario')
		->Where('fk_usuarios',$Id_USuario)
		->Where('fk_turno',$Id_Turno)
		->get();		
		$mensaje[0] = "¡¡El usuario no tiene formularios asignados para este turno !!";	

		$DatosTurno=[];	
		
		if($DAtosTurnos!='[]'){
			foreach ($DAtosTurnos  as $resultados) {				

				$DatosTurno[$resultados->id] =$resultados->Nombre_Formulario->nombre_formulario.' - '.'codigo '.$resultados->Nombre_Formulario->id;

			}		
			return $DatosTurno;
		}else{
			return $mensaje;
		}
	}

	public function cargar_tabla_control_consolidos_C(){

		$Id_USuario=Input::get('id_usuario_selecc');
		$Id_Turno=Input::get('id_turno_selecc');
		$fecha1=Input::get('fecha1');
		$fecha2=Input::get('fecha2');
    //-----------------------------------------------------------
		$anioinicio=substr($fecha1, 0, 4);  // abcd
		$mesinicio=substr($fecha1, -5, 2);  // abcd
		$inicio=substr($fecha1, -2, 2); // f

		$fechainicial=$anioinicio.'-'.$mesinicio.'-'.$inicio;

		$añofin=substr($fecha2, 0, 4);  // abcd
		$mesfin=substr($fecha2, -5, 2);  // abcd
		$fin=substr($fecha2, -2, 2); // f

		$formulario_diligenciado = consolidado_formularios::whereBetween('fecha_ingreso', array($fecha1, $fecha2))
		->where('fk_usuario',$Id_USuario)
		->where('fk_turno',$Id_Turno)->paginate(10);


		$TopeMeses; $mes=0;

		for ($i=0; $i <12 ; $i++) { 
			$mes++;
			if($mes==$mesfin){
				$TopeMeses[intval($mesfin)]=$fin; 
			}else{
				$TopeMeses[$i+1]=date("d",(mktime(0,0,0,$mes+1,1,$anioinicio)-1));
			}
		}

		$TotalDias=[];
		$contadorTotalDias=0;
		$entradasaqui=0;
		$posArray=0; $contRangoFecha=0; $contadorRecorridoTopmeses=0; $contDiasmes=0; $secuenciaDia; $contadorllenado=0;
		// dd($mesinicio+1);
		foreach ($TopeMeses as $key => $value) {
			$contadorRecorridoTopmeses++;

			$posArray++;

			if($posArray>=$mesinicio && $posArray<=$mesfin){ 
				$contRangoFecha++;
				
				for ($inicio; $inicio <=$TopeMeses[intval($contadorRecorridoTopmeses)] ; $inicio++) { 
					
					$secuenciaDia=$inicio;
					$dias=strlen($secuenciaDia).' -- '; 
					if($dias<2){
						$secuenciaDia='0'.$inicio;
					}
					$secuenciaMes=$mesinicio;
					$dias=strlen($secuenciaMes).' -- '; 
					if($dias<2){
						$secuenciaMes='0'.$mesinicio;
					}
					$TotalDias[$contadorllenado]=$anioinicio.'-'.$secuenciaMes.'-'.$secuenciaDia;
					$contadorllenado++;
					
					$contadorTotalDias++;					
				}
				$inicio=1;
				$mesinicio++;
				
			}
		}
		$DiasNoLaborados=[];
		$posDiasno=1;
		$verificacion=0;
		foreach ($TotalDias as $key => $value1) {
			
			$fechaArray=$value1;

			foreach ($formulario_diligenciado as $key => $value2) {
				$fechaRegistro=$value2->fecha_ingreso;

				if($fechaArray==$fechaRegistro){
					$verificacion++;
				}
			}
			if($verificacion==0){
				$DiasNoLaborados[$posDiasno]=$fechaArray;
			}
			$verificacion=0;
			$posDiasno++;
		}
		// dd($DiasNoLaborados);

//------------------------------------------------------------
		$formDiligenci=[];

		foreach ($formulario_diligenciado as $key => $value) {
			$formDiligenci[]=$value;
		}
		return view('Administrador/Tablas.Tabla_Control_Consolidado')
		->with('formulario_diligenciado',$formulario_diligenciado)
		->with('DiasNoLaborados',$DiasNoLaborados);

	}
	//------------------------------------ fin control  consolidado--
// Aqui empieza todo de parametros
	public function Parametros_Equipos_C(){
		return view('Administrador/Formularios.Create_Parametros');
	}
	

	public function Listar_Parametros_Vista_Parametros(){
		$Nombres_Parametros=Tipo_Parametro::orderBy('nombre_parametro','asc')			
		->get();

		$Mi_Array=[];	

		foreach ($Nombres_Parametros  as $resultados) {	
			$nombre_parametro=ucfirst($resultados->nombre_parametro);
			$Mi_Array[$resultados->id] = $nombre_parametro;
		}		
		return $Mi_Array;
	}

	public function Listar_Unidad_Vista_Parametros(){
		$Unidad=Input::get('id_parametro_seleccionado');
		$NombreVariable=Input::get('NombreVariable');
		
		$Nombres_Unidades=Tipo_Unidad::orderBy('nombre_unidad','asc')
		->Where('fk_parametro',$Unidad)			
		->get();
		$Mensaje=[];
		$Mensaje[0] = "No se encontró ninguna unidad asociada al parámetro: ".strtoupper($NombreVariable);
		if($Nombres_Unidades!="[]"){
			$Mi_Array=[];	

			foreach ($Nombres_Unidades  as $resultados) {
				$nombre_unidad=ucfirst($resultados->nombre_unidad);
				$Mi_Array[$resultados->id] = $nombre_unidad;
			}		
			return $Mi_Array;
		}else{
			return  $Mensaje;
		}
	}

	public function Registrar_Nueva_Variable(){
		$Nueva_Variable=Input::get('Nueva_Variable');			
		
		$Consultando_Variables=Tipo_Parametro::Where('nombre_parametro', 'LIKE', '%'.$Nueva_Variable.'%')->paginate(1);

		if($Consultando_Variables->total()!=0){
			return 2;
		}else{
			$rules = array
			(
				'Nueva_Variable'    => 'required|max:50|min:3'			
				);

			$message = array
			(
				'Nueva_Variable.required'	=> ' Es obligatorio ingresar una nueva variable.',
				'Nueva_Variable.max'			=> ' La variable debe ser menor a 20 Caracteres.',
				'Nueva_Variable.min'			=> ' La variable debe contener minimo 3 caracteres.'
				);
			$validator = Validator::make(Input::All(), $rules, $message);
			if ($validator->fails()) {
				return Response::json(['error' =>false,
					'errors'=>$validator->errors()->toArray()]);
			}else{	

				$datos_nuevos = array(
					'nombre_parametro'     	=> $Nueva_Variable								   
					);
				$check = DB::table('tipo_parametro')->insert($datos_nuevos);
				if($check >0){
					return 0;
				}

			}
		}
	}
	

	function Actualizar_Variable(){
		$Actualizar_Variable=Input::get('Actualizar_Variable');	
		$NombreVariableEditar_Oculto=Input::get('NombreVariableEditar_Oculto');		
		$id_variable_actualizar=Input::get('id_variable_actualizar');	

		$Consultando_Variables=Tipo_Parametro::Where('nombre_parametro', 'LIKE', '%'.$Actualizar_Variable.'%')->paginate(1);

		if($NombreVariableEditar_Oculto==$Actualizar_Variable){
			return 2;
		}else{
			if($Consultando_Variables->total()!=0){
				return 3;
			}else{

				$rules = array
				(
					'Actualizar_Variable'    => 'required|max:20|min:3'			
					);

				$message = array
				(
					'Actualizar_Variable.required'	=> ' Es obligatorio ingresar una nueva variable.',
					'Actualizar_Variable.max'			=> ' La variable debe ser menor a 20 Caracteres.',
					'Actualizar_Variable.min'			=> ' La variable debe contener minimo 3 caracteres.'
					);
				$validator = Validator::make(Input::All(), $rules, $message);
				if ($validator->fails()) {
					return Response::json(['error' =>false,
						'errors'=>$validator->errors()->toArray()]);
				}else{	

					$datos_nuevos = array(
						'nombre_parametro'     	=> $Actualizar_Variable								   
						);

					$check = DB::table('tipo_parametro')
					->where('id',$id_variable_actualizar)
					->update($datos_nuevos);

					if($check >0){
						return 0;
					}

				}
			}
		}
	}
	function Eliminar_Variable(){
		$id_variable_eliminar=Input::get('id_variable_eliminar');

		$Detalle_Formulario=Detalle_Formulario::Where('parametros_control',$id_variable_eliminar)->paginate(1);		

		if($Detalle_Formulario->total()!=0){
			return 2;			
		}else{
			$check = DB::table('tipo_parametro')
			->where('id',$id_variable_eliminar)
			->delete();

			$check = DB::table('tipo_unidad')
			->where('fk_parametro',$id_variable_eliminar)
			->delete();

			if($check >0){
				return 0;
			}
		}
	}

	public function Registrar_Nueva_Unidad(){

		$Nueva_Unidad=Input::get('Nueva_Unidad');
		$id_parametro_seleccionado=Input::get('id_parametro_seleccionado');

		$rules = array
		(
			'Nueva_Unidad'    => 'required|max:20|min:1'			
			);

		$message = array
		(
			'Nueva_Unidad.required'	    => ' Es obligatorio ingresar una nueva variable.',
			'Nueva_Unidad.max'			=> ' La variable debe ser menor a 20 Caracteres.',
			'Nueva_Unidad.min'			=> ' La variable debe contener minimo 3 caracteres.'
			);
		$validator = Validator::make(Input::All(), $rules, $message);
		if ($validator->fails()) {
			return Response::json(['error' =>false,
				'errors'=>$validator->errors()->toArray()]);
		}else{

			$datos_nuevos = array(
				'nombre_unidad'     => $Nueva_Unidad,
				'fk_parametro'     	=> $id_parametro_seleccionado				
				);
			$check = DB::table('tipo_unidad')->insert($datos_nuevos);

			$Unidad=Tipo_Unidad::all();

			foreach ($Unidad as $key => $value) {
				$ultimo_id=$value->id;
			}

			return Response::json(['resultado'=>"0",
				'ultimo_id'=>$ultimo_id]);		

		}
	}

	function Actualizar_Unidad(){
		$Actualizar_Unidad=Input::get('Actualizar_Unidad');	
		$NombreUnidadEditar_Oculto=Input::get('NombreUnidadEditar_Oculto');		
		$id_unidad_actualizar=Input::get('id_unidad_actualizar');	

		$Consultando_Unidades=Tipo_Unidad::Where('nombre_unidad', 'LIKE', '%'.$Actualizar_Unidad.'%')->paginate(1);

		if($NombreUnidadEditar_Oculto==$Actualizar_Unidad){
			return 2;
		}else{
			if($Consultando_Unidades->total()!=0){
				return 3;
			}else{

				$rules = array
				(
					'Actualizar_Unidad'    => 'required|max:20|min:3'			
					);

				$message = array
				(
					'Actualizar_Unidad.required'	=> ' Es obligatorio ingresar una nueva Unidad.',
					'Actualizar_Unidad.max'			=> ' La Unidad debe ser menor a 20 Caracteres.',
					'Actualizar_Unidad.min'			=> ' La Unidad debe contener minimo 3 caracteres.'
					);
				$validator = Validator::make(Input::All(), $rules, $message);
				if ($validator->fails()) {
					return Response::json(['error' =>false,
						'errors'=>$validator->errors()->toArray()]);
				}else{	

					$datos_nuevos = array(
						'nombre_unidad'     	=> $Actualizar_Unidad								   
						);

					$check = DB::table('tipo_unidad')
					->where('id',$id_unidad_actualizar)
					->update($datos_nuevos);

					if($check >0){
						return 0;
					}

				}
			}
		}
	}

	function Eliminar_Unidad(){
		$id_unidad_eliminar=Input::get('id_unidad_eliminar');

		$Detalle_Formulario=Detalle_Formulario::Where('unidad',$id_unidad_eliminar)->paginate(1);		

		if($Detalle_Formulario->total()!=0){
			return 2;			
		}else{	

			$check = DB::table('tipo_unidad')
			->where('id',$id_unidad_eliminar)
			->delete();

			if($check >0){
				return 0;
			}
		}
	}


	// Aqui termina todo de parametros
}