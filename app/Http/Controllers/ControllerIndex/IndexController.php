<?php

namespace WebMotivacion\Http\Controllers\ControllerIndex;

use Illuminate\Http\Request;
use WebMotivacion\Http\Controllers\Controller;
use WebMotivacion\Models\Usuarios\Usuario;
use WebMotivacion\Models\Publicaciones\Publicacion;
use WebMotivacion\Models\Publicaciones\Like;
use WebMotivacion\Models\Publicaciones\Comentario;
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
use Redirect;

class IndexController extends Controller{

	public function __construct(){
		Carbon::setLocale('es');
		// setlocale(LC_ALL,"es_ES");
		// Carbon::setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
	}



	// $asignaturaNotificacion = DB::table('sesiones')
	// ->where('fecha_sesion',$fecha)
	// ->where('asignacion_id',$id_asignacion)
	// ->where('firma_docente',false)
	// ->where('firma_vocero',false)
	// ->join('asignaciones', 'sesiones.asignacion_id', '=','asignaciones.id')
	// ->join('asignaturas', 'asignaturas.id', '=','asignaciones.asignatura_id')
	// ->join('temas', 'temas.id', '=','sesiones.tema_id')
	// ->get();





	public function Index(){
		// $Publicaciones=Publicacion::where('Estado_Publicacion','Activo')		
		// ->get();		




		// return view('Index.Principal')->with('Publicaciones',$Publicaciones);
		return view('Index.Principal');

	}

	public function Principal(){
		return view('Index.Principal');

	}
	
	public function Camino(){
		return view('Index.Camino');

	}
	public function Seguridad(){
		return view('Index.Seguridad');

	}














	public function encriptar(){
		return view('Index.temporal');
	}

	public function Encriptar_Password_Temporal(){
		$Password=Input::get('password');
		$Pass_Encriptado = Hash::make($Password);		
		return $Pass_Encriptado;
	}

	public function Notificaciones(){
		$cambiar_password=Auth::user()->cambiar_password;       
		if($cambiar_password=='Si'){          
			return Redirect::to('MyProfile');
		}else{
			if(Auth::user()->fk_rol==1 ||Auth::user()->fk_rol==2 ){
				return view('Notificaciones.Notificaciones');
			}else{
				return redirect('Index');	
			}
		}
	}
	public function Tabla_Notificaciones(){
		$Fecha_Actual=Carbon::today()->toDateString();
		$Notificacion=Notificacion::OrderBy('hora_notificacion','DESC')->Where('estado','Si')->Where('fecha_notificacion',$Fecha_Actual)->paginate(5);

		return view('Notificaciones/Tablas.TablaNotificaciones')
		->with('Notificacion',$Notificacion);
	}

	public function Tabla_Notificaciones_Anteriores(){		
		$Notificacion=Notificacion::OrderBy('hora_notificacion','DESC')->paginate(10);

		return view('Notificaciones/Tablas.TablaNotificaciones')
		->with('Notificacion',$Notificacion);
	}


	public function Cargar_Notificaciones(){
		$Fecha_Actual=Carbon::today()->toDateString();
		$Notificacion=Notificacion::Where('estado','=','Si')->Where('fecha_notificacion',$Fecha_Actual)->count();	
		$Mensaje=Notificacion::Where('estado','=','Si')
		->OrderBy('hora_notificacion','DESC')
		->Where('fecha_notificacion',$Fecha_Actual)
		->get();
		return view('Notificaciones.EstiloNotificaciones')
		->with('Notificacion',$Notificacion)
		->with('Mensaje',$Mensaje);
	}

	public function Cambiar_Estado_Notificacion(){

		$id_notificacion=Input::get('id_notificacion');
		$estado=Input::get('estado');

		// dd(Input::all());

		$Datos = array(
			'estado'                       => $estado
			);
		$check = DB::table('notificaciones')
		->where('id',$id_notificacion)
		->update($Datos);

		return "ok";
	}

	public function Eliminar_Notificacion(){
		$IdNotificacion=Input::get('IdNotificacion');

		$Notificaciones=Notificacion::where('id',$IdNotificacion)->get();


		foreach ($Notificaciones as $key => $value) {
			$imagen_foto=$value->imagen_foto;
		}

		if (File::exists($imagen_foto)) {
			File::delete($imagen_foto);
		}

		$check = DB::table('notificaciones')
		->where('id',$IdNotificacion)
		->delete();

		return "ok";
	}

	public function Reportar_Daño(){
		$cambiar_password=Auth::user()->cambiar_password;       
		if($cambiar_password=='Si'){          
			return Redirect::to('MyProfile');
		}else{
			return view('Empleados/Formularios.ReportarDano');
		}
	}

	public function cargar_nombres_equipos(){
		$equipos=Equipo::lists('nombre_equipo','id');
		return $equipos;
	}

	public function RegistrarNotificacion(){


		$rules = array
		(
			'id_nombre_equipo'     		=> 'required',
			'titulo_mensaje'   	   		=> 'required|max:100',
			'mensaje_notificacion'  	=> 'required|max:100',
			'ImagenMensaje' 	=> 'max:2000|mimes:jpg,jpeg,png',     
			);

		$message = array
		(
			'id_nombre_equipo.required'=> ' Por favor seleccione un equipo.',		
			'titulo_mensaje.required'  => ' Por favor ingrese el titulo del mensaje.',
			'titulo_mensaje.max'=> ' El titulo del mensaje es de maximo de 100 caracteres',
			'mensaje_notificacion.required'   => ' Por favor ingrese el mensaje.',
			'mensaje_notificacion.max'   => ' El mensaje es de maximo 100 caracteres.',
			'ImagenMensaje.max'   => 'El tamaño maximo debe la imagen es de 1 MB.',
			'ImagenMensaje.mimes' => 'El archivo que pretendes subir, no es una imagen.',
			);

		$validator = Validator::make(Input::All(), $rules, $message);
		if ($validator->fails()) {

			return Response::json(['error' =>false,
				'errors'=>$validator->errors()->toArray()]);
		}else{			  
			$src = $_FILES['ImagenMensaje'];
			$Mensaje=Input::all();
			$id_usuario=Auth::user()->id; 
			$HoraActual=carbon::now();
			$FechaActual=carbon::now();
			if ($src["size"] > 0){

				$ruta_imagen = 'global/Imagenes_Nofiticaciones/';
				File::makeDirectory($ruta_imagen, $mode = 0777, true, true);
				$imagen=rand(1000,999)."-".$src["name"];	

				move_uploaded_file($src["tmp_name"], $ruta_imagen.$imagen);


				$Mensajes = array(
					'fk_equipo'       		=> $Mensaje['id_nombre_equipo'],
					'titulo_mensaje'        => $Mensaje['titulo_mensaje'],
					'mensaje'            	=> $Mensaje['mensaje_notificacion'],
					'imagen_foto'         	=> $ruta_imagen.$imagen,
					'fk_usuario'      		=> $id_usuario,
					'hora_notificacion'  	=> $HoraActual,
					'fecha_notificacion'    => $FechaActual,
					'estado'      			=> "Si"     
					);

				$check = DB::table('notificaciones')->insert($Mensajes);			

				if($check >0){
					return 0;
				}
			}

		}
	}
}

