<?php

namespace Motivacion\Http\Controllers\ControllerUsuarios;


use Illuminate\Http\Request;
use Motivacion\Http\Controllers\Controller;
use Motivacion\Models\Usuarios\Usuario;
use Motivacion\Models\Usuarios\Conexion_Usuarios;
use Motivacion\Models\Roles\Roles;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Facades\Validator;
use DB;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\UserTrait;
use Hash;
use Redirect;
use File;

class UsuariosController extends Controller {


	public function __construct(){
		Carbon::setLocale('es');
		
	}
	

	public function Salir()	{
		Auth::logout();
		return Redirect::to('/');

	}


	public function Login()	{
		

		return View('Index.login');
	}

	public function Logueo(){	
		$usuario = Input::all();
		$Usuarios=Usuario::Where('email',$usuario['email'])->get();
		$EstadoUsuario="";
		foreach ($Usuarios as $key => $value) {
			$EstadoUsuario=$value->estado_usuario;
		}
		if($EstadoUsuario!='Activo'){
			return Response::json(['ErrorInactivo' =>false,
				'errors'=>'La cuenta de usuario ingresada se encuentra Inactiva, Por favor consulte con el Administrador de la aplicación.']);
		}else{	
			$rules = array
			(
				"email" => "required|email|exists:usuarios",
				'password' => 'required',  
				'estado_usuario' =>'Activo'
		// 'g-recaptcha-response' => 'required'          
				);

			$messages = array
			(
				'email.required' => 'Ingrese el Email.',
				'email.exists' => 'El Email Ingresado No Se Encuentra Registrado',
				'email.email' => 'El Formato Email Esta Incorrecto.',
				'password.required' => 'Ingrese el password.',
				'password.exists' => 'El email o password estan incorrectos.',
		// 'g-recaptcha-response.required'=>'El campo Captcha es requerido.',

				);

			$validator = Validator::make(Input::All(), $rules, $messages);
			if ($validator->fails()) {

				return Response::json(['error' =>false,
					'errors'=>$validator->errors()->toArray()]);
			}else{			

			// $Pass_Encriptado = Hash::make(Input::get('password'));

				$user = array(
					'email' => Input::get('email'),
					'password' =>Input::get('password'), 				              
					);

			// dd($user);

				if (Auth::guard()->attempt($user)==true){ 				
					return 'ok';   

				}else{
					$message = '¡Error... Correo o Contraseña Incorrectos..!';			

					return Response::json(['ErrorEnPass' =>false,
						'errors'=>$message]); 
				}

			}
		}
	}

	public function Index(){
		$cambiar_password=Auth::user()->cambiar_password;       
		if($cambiar_password=='Si'){          
			return Redirect::to('MyProfile');
		}else{
			if(Auth::user()->fk_rol==1 ||Auth::user()->fk_rol==2 ){
				return view('Usuarios.Index');
			}else{
				return redirect('Index');	
			}
		}
	}


	public function Tabla_Usuarios(){
		$Usuarios=Usuario::Where('id','>',1)
		->Where('estado_usuario','Activo')
		->orderBy('id','desc')
		->paginate(4);

		return view('Usuarios/Tablas.Tabla_Usuarios')
		->with('Usuarios',$Usuarios);		
	}


	

	public function Actualizar_Fecha_Ultimo_Ingreso(){
		$Fecha_Conexion=Carbon::now();
		$Hora_Conexion=Carbon::now();
		// $Hora_Conexion=Carbon::now()->format('g:i A');			
		$UsuarioLogueado=Auth::user()->id;

		$IP = request()->ip();		
		if($IP=="::1"){
			$LocalIP = getHostByName(getHostName());
		}else{
			$LocalIP=$IP;
		}	


		$Datos = array(
			'fecha_conexion'     		=> $Fecha_Conexion,
			'hora_conexion'     		=> $Hora_Conexion,	
			'ip_conexion'      			=> $LocalIP,	
			'fk_usuario'    			=> $UsuarioLogueado						   
			);
		$check = DB::table('conexiones_usuarios')->insert($Datos);			

		if($check >0){
			return 0;
		}

	}

	function Tabla_Roles_Registrados(){
		$Roles=Roles::Where('id','>',1)->paginate(50);

		return view('Usuarios/Tablas.Tabla_Roles')
		->with('Roles',$Roles);
	}

	function RegistrarNuevoRol(){
		$Rol=Input::get('nombre_nuevo_rol');

		$Roles=Roles::where('nombre_rol', 'LIKE', '%'.$Rol.'%')->paginate(8);
		
		if($Roles->total()!=0){
			return 3;
		}else{
			$rules = array
			(
				'nombre_nuevo_rol'     => 'required'
				);
			$message = array
			(
				'nombre_nuevo_rol.required'=> ' Por favor Ingrese un rol.'		
				);
			$validator = Validator::make(Input::All(), $rules, $message);
			if ($validator->fails()) {

				return Response::json(['error' =>false,
					'errors'=>$validator->errors()->toArray()]);
			}else{	
				$Mensaje=Input::all();
				$Mensajes = array(
					'nombre_rol'     => $Mensaje['nombre_nuevo_rol']				   
					);
				$check = DB::table('roles')->insert($Mensajes);			

				if($check >0){
					return 0;
				}
			}
		}
	}

	public function ElimiarRol(){

		$Rol=Input::get('Id_Rol_Delete');

		$Usuarios=Usuario::Where('fk_rol',$Rol)->paginate(8);

		if($Usuarios->total()!=0){
			return 3;
		}else{
			$check = DB::table('roles')
			->where('id',$Rol)		
			->delete();

			if($check >0){
				return 0;
			}

		}
	}

	public function EditarRol(){
		$Rol=Input::get('id_rol_editar_oculto');
		$Nombre_Rol=Input::get('NombreEditarRol');
		$NombreEditarRol_Oculto=Input::get('NombreEditarRol_Oculto');

		$Roles=Roles::where('nombre_rol', 'LIKE', '%'.$Nombre_Rol.'%')->paginate(8);

		if($Nombre_Rol==$NombreEditarRol_Oculto){

			$datos_editar = array(
				'nombre_rol'     => $NombreEditarRol_Oculto
				);	

			$check = DB::table('roles')
			->where('id',$Rol)		
			->update($datos_editar);

			if($check >0){
				return 0;
			}else{
				return 1;
			}
		}else{
			if($Roles->total()!=0){
				return 2;
			}else{
				$datos_editar = array(
					'nombre_rol'     => $Nombre_Rol
					);		

				$check = DB::table('roles')
				->where('id',$Rol)		
				->update($datos_editar);

				if($check >0){
					return 0;
				}else{
					return 1;
				}
			}
		}
	}

	public function RegistrarNuevoUsuario(){		

		$CodigoRegistrar 		=Input::get('CodigoRegistrar');
		$id_rol_registrar 		=Input::get('id_rol_registrar');
		$NombreRegistrar		=Input::get('NombreRegistrar');
		$ApellidoRegistrar		=Input::get('ApellidoRegistrar');
		$TelefonoRegistrar		=Input::get('TelefonoRegistrar');
		$DireccionRegistrar		=Input::get('DireccionRegistrar');
		$CorreoRegistrarOculto	=Input::get('CorreoRegistrarOculto');

		$rules = array		(	
			'CorreoRegistrarOculto' => 'required|unique:usuarios,email',
			'TelefonoRegistrar' => 'required|unique:usuarios,telefono',
			'CodigoRegistrar' => 'required|unique:usuarios,codigo'	
			
			);
		$messages = array
		(
			'CodigoRegistrar.required' => 'Ingrese el codigo de Usuario.',
			'CodigoRegistrar.unique'   => 'El codigo Ingresado no esta disponible..',

			'TelefonoRegistrar.required' => 'Ingrese el Telefono de Usuario.',
			'TelefonoRegistrar.unique'   => 'El Telefono Ingresado no esta disponible..',

			'CorreoRegistrarOculto.required' => 'Ingrese el Correo de Usuario.',
			'CorreoRegistrarOculto.unique'   => 'El Correo Ingresado no esta disponible..'		
			);

		$validator = Validator::make(Input::All(), $rules, $messages);
		if ($validator->fails()) {

			return Response::json(['error' =>false,
				'errors'=>$validator->errors()->toArray()]);
		}else{
			$password = Hash::make('1234567');
			$fecha= Carbon::today()->toDateString();
			$fecha2= Carbon::now();
			$ruta_imagen="global/images/no_photo_profile.png";
			// $ruta_imagen = 'global/Directorio/Usuarios/Usuario_ID_'.$id_comercio;
			// File::makeDirectory($ruta_imagen, $mode = 0777, true, true);

			$Usuarios = array(
				'nombre_usuario'     		=> $NombreRegistrar,
				'apellido'     				=> $ApellidoRegistrar,	
				'telefono'      			=> $TelefonoRegistrar,	
				'dierccion'    			 	=> $DireccionRegistrar,	
				'email'     				=> $CorreoRegistrarOculto,	
				'password'     				=> $password,		
				'codigo'     				=> $CodigoRegistrar,
				'fk_rol'     				=> $id_rol_registrar,
				'fecha_ingreso'     		=> $fecha,	
				'ruta_photo_profile'     	=> $ruta_imagen,	
				'cambiar_password'			=> 'Si',		
				'Fecha_Ultimo_Ingreso'      => $fecha2,				   
				);
			$check = DB::table('usuarios')->insert($Usuarios);			

			if($check >0){
				return 0;
			}else{
				return 1;
			}
		}
	}

	public function ModificarNuevoUsuario(){		

		$CodigoOculto 			=Input::get('CodigoOculto');
		$TelefonoOculto 		=Input::get('TelefonoOculto');
		$CorreoOculto 			=Input::get('CorreoOculto');
		
		$CodigoModificar 		=Input::get('CodigoModificar');
		$id_rol_editar 			=Input::get('id_rol_editar');
		$NombreModificar		=Input::get('NombreModificar');
		$ApellidoModificar		=Input::get('ApellidoModificar');
		$TelefonoModificar		=Input::get('TelefonoModificar');
		$DireccionModificar		=Input::get('DireccionModificar');
		$CorreoModificarOculto	=Input::get('CorreoModificarOculto');

		

		if($CodigoOculto==$CodigoModificar && $TelefonoModificar==$TelefonoOculto && $CorreoModificarOculto==$CorreoOculto){
			$Usuarios = array(
				'nombre_usuario'     		=> $NombreModificar,
				'apellido'     				=> $ApellidoModificar,					
				'dierccion'    			 	=> $DireccionModificar,					
				'fk_rol'     				=> $id_rol_editar							   
				);
			$check = DB::table('usuarios')
			->where('codigo',$CodigoOculto)		
			->update($Usuarios);	
			if($check >0){
				return 0;
			}
		}else{	

			$codigos=Usuario::Where('codigo',$CodigoModificar)->get();
			$telefonos=Usuario::Where('telefono',$TelefonoModificar)->get();
			$emails=Usuario::Where('email',$CorreoModificarOculto)->get();


			$codigo="";
			$telefono="";
			$email="";

			foreach ($codigos as $key => $value) {
				$codigo=$value->codigo;					
			}
			foreach ($telefonos as $key => $value) {
				$telefono=$value->telefono;					
			}
			foreach ($emails as $key => $value) {
				$email=$value->email;					
			}	

			if($codigo!=$CodigoOculto &&$codigo!=""){
				return Response::json([			
					'error'=>'El codigo Ingresado no esta disponible.'
					]);
			}else{
				if($telefono!=$TelefonoOculto && $telefono!=""){
					return Response::json([			
						'error'=>'El telefono Ingresado no esta disponible'
						]);

				}else{
					if($email!=$CorreoOculto && $email!=""){
						return Response::json([			
							'error'=>"El email Ingresado no esta disponible."
							]);
					}else{
						$Usuarios = array(
							'nombre_usuario'     		=> $NombreModificar,
							'apellido'     				=> $ApellidoModificar,	
							'telefono'      			=> $TelefonoModificar,	
							'dierccion'    			 	=> $DireccionModificar,	
							'email'     				=> $CorreoModificarOculto,	
							'codigo'     				=> $CodigoModificar,
							'fk_rol'     				=> $id_rol_editar							   
							);
						$check = DB::table('usuarios')
						->where('codigo',$CodigoOculto)		
						->update($Usuarios);			

						if($check >0){
							return 0;
						}else{
							return 1;
						}
					}			
				}
			}
		}
	}

	public function Desactivar_Usuario(){
		$id_usuario_desactivar=Input::get('id_usuario_desactivar');

		$Usuarios = array(
			'estado_usuario' => 'Inactivo'						   
			);
		$check = DB::table('usuarios')
		->where('id',$id_usuario_desactivar)		
		->update($Usuarios);			

		if($check >0){
			return 0;
		}

	}

	public function Activar_Usuario(){		
		$Id_Usuario_Activar=Input::get('Id_Usuario_Activar');

		$Usuarios = array(
			'estado_usuario' => 'Activo'						   
			);
		$check = DB::table('usuarios')
		->where('id',$Id_Usuario_Activar)		
		->update($Usuarios);			

		if($check >0){
			return 0;
		}

	}



	public function Listar_Roles(){
		$Rol=Roles::orderBy('nombre_rol','asc')		
		->Where('id','>',1)
		->get();
		$Roles=[];	

		foreach ($Rol  as $resultados) {		
			$Roles[$resultados->id] = ucfirst($resultados->nombre_rol);
		}		
		return $Roles;
	}

	public function Listar_Nombres_Usuarios(){
		$Usuarios=Usuario::orderBy('nombre_usuario','asc')		
		->Where('id','>',1)
		->get();
		$Usuario=[];	

		foreach ($Usuarios  as $resultados) {		
			$Usuario[$resultados->id] = ucfirst($resultados->nombre_usuario).' '.ucfirst($resultados->apellido).' '.'--------- Codigo:'.$resultados->codigo;
		}		
		return $Usuario;
	}

	public function Tabla_Usuarios_Consultada(){
		$id_usario_buscar=Input::get('id_usario_buscar');

		$Usuarios=Usuario::Where('id','>',1)
		->Where('id',$id_usario_buscar)
		->orderBy('id','desc')
		->paginate(10);

		return view('Usuarios/Tablas.Tabla_Usuarios')
		->with('Usuarios',$Usuarios);
	}

	public function Tabla_Conexiones_Usuarios(){
		$id_usuario=Input::get('id_usuario');

		$Conexion=Conexion_Usuarios::Where('fk_usuario',$id_usuario)		
		->orderBy('id','desc')
		->paginate(50);

		return view('Usuarios/Tablas.Tabla_Conexiones_Usuarios')
		->with('Conexion',$Conexion);	
	}

	public function RestablecerPasswordUsuario(){
		$id_password_restablecer_usuario=Input::get('id_password_restablecer_usuario');
		$password = Hash::make('1234567');
		$Usuarios = array(
			'password' 		   => $password,
			'cambiar_password' =>'Si'							   
			);
		$check = DB::table('usuarios')
		->where('id',$id_password_restablecer_usuario)		
		->update($Usuarios);			

		if($check >0){
			return 0;
		}
	}

	public function MyProfile(){
		if(Auth::user()->fk_rol!='1'){
			return view('Usuarios.Perfil_Usuario');
		}else{
			return Redirect::to('/');
		}
	}

	public function ModificarPasswordUsuario(){
		$id=Auth::user()->id;       
		$contrasena2=Input::get('contrasena2');
		$password = Hash::make($contrasena2);
		$Usuarios = array(
			'password' 		   => $password,
			'cambiar_password' => 'No'												   
			);
		$check = DB::table('usuarios')
		->where('id',$id)		
		->update($Usuarios);			

		if($check >0){
			return 0;
		}
	}

	public function Cargar_Datos_Perfil_Usuario(){
		$id=Auth::user()->id;

		$Usuario=Usuario::Where('id',$id)->get();

		foreach ($Usuario as $key => $value) {
			$NombrePerfil=ucfirst($value->nombre_usuario).' '.ucfirst($value->apellido);
			$RangoPerfil=ucfirst($value->Nombre_Rol->nombre_rol);
			$CodigoPerfil=$value->codigo;
			$TelefonoPerfil=$value->telefono;
			$DireccionPerfil=$value->dierccion;
			$DireccionEmailPerfil=$value->email;
			$FotoUsuarioPerfil=$value->ruta_photo_profile;
		}



		if (File::exists($FotoUsuarioPerfil)) {
			// File::delete($DireccionURLFoto);
			// $FotoUsuarioPerfil=$FotoUsuarioPerfil;
		}else{
			$FotoUsuarioPerfil="global/images/no_photo_profile.png";
		}


		return Response::json([			
			'NombrePerfil'=>$NombrePerfil,
			'RangoPerfil'=>$RangoPerfil,
			'CodigoPerfil'=>$CodigoPerfil,
			'TelefonoPerfil'=>$TelefonoPerfil,
			'DireccionPerfil'=>$DireccionPerfil,
			'DireccionEmailPerfil'=>$DireccionEmailPerfil,
			'FotoUsuarioPerfil'=>$FotoUsuarioPerfil
			]);
	}

	public function ModificarPasswordUsuario_Manual(){
		$id=Auth::user()->id;
		$Password=Input::get('PasswordModificar2');
		$Encriptar = Hash::make($Password);

		$Usuarios = array(
			'password' 		   => $Encriptar														   
			);
		$check = DB::table('usuarios')
		->where('id',$id)		
		->update($Usuarios);			

		if($check >0){
			return 0;
		}
	}

	public function ActualizarFotoPerfil(){		

		$rules = array 
		(
			'ImagenPerfil' => 'max:4000|mimes:jpg,jpeg,png'   
			);
		$messages = array
		(
			'ImagenPerfil.max'                => 'El tamaño maximo debe la imagen es de 4 MB.',
			'ImagenPerfil.mimes'              => 'El archivo que pretendes subir, no es una imagen.',	
			);

		$validator = Validator::make(Input::All(), $rules, $messages);
		if ($validator->fails()) {
			return Response::json(['error' =>false,
				'errors'=>$validator->errors()->toArray()]);
		}else{
			$FotoUsuarioPerfil=Auth::user()->ruta_photo_profile;
			if (File::exists($FotoUsuarioPerfil)) {
				File::delete($FotoUsuarioPerfil);			
			}
			$id_usuario=Auth::user()->id;
			$src = $_FILES['ImagenPerfil'];
			if ($src["size"] > 0){
				$ruta_imagen = 'global/Directorio/Usuarios/Usuario_ID_'.$id_usuario.'/';
				File::makeDirectory($ruta_imagen, $mode = 0777, true, true);
				$imagen=rand(1000,999)."-".$src["name"];
				move_uploaded_file($src["tmp_name"], $ruta_imagen.$imagen);			

				$Imagen = array(					
					'ruta_photo_profile'  => $ruta_imagen.$imagen     
					);				
				$check = DB::table('usuarios')
				->where('id',$id_usuario)		
				->update($Imagen);
				
				if($check >0){
					return 0;
				}
			}
		}
	}
}