<?php

// Rutas del Sistema
// Route::any('Inde', array('as'=>'Index','uses'=>'ControllerUsuarios\UsuariosController@Login'))->middleware('guest');
Route::any('/', array('as'=>'Index','uses'=>'ControllerIndex\IndexController@Index'))->middleware('guest');

Route::any('Cargar_Megustas', array('as'=>'Cargar_Megustas','uses'=>'ControllerIndex\IndexController@Cargar_Megustas'))->middleware('guest');














Route::any('Login', array('as'=>'Login','uses'=>'ControllerUsuarios\UsuariosController@Logueo'))->middleware('guest');
Route::any('Salir', array('as'=>'Salir','uses'=>'ControllerUsuarios\UsuariosController@Salir'));
// Actualiza el la fecha Fecha_Ultimo_Ingreso de la persona que se loguea en la aplicacion
Route::any('Actualizar_Fecha_Ultimo_Ingreso', array('as'=>'Actualizar_Fecha_Ultimo_Ingreso','uses'=>'ControllerUsuarios\UsuariosController@Actualizar_Fecha_Ultimo_Ingreso'));
// Ruta Perfil de Usuario
Route::any('MyProfile', array('as'=>'MyProfile','uses'=>'ControllerUsuarios\UsuariosController@MyProfile'))->middleware('auth');
// Termina Ruta Perfil usuario
// Ruta actualizar Photo de Perfil Usuario
Route::any('ActualizarFotoPerfil', array('as'=>'ActualizarFotoPerfil','uses'=>'ControllerUsuarios\UsuariosController@ActualizarFotoPerfil'))->middleware('auth');
// Termina Ruta actualizar Photo de Perfil Usuario
// Rutas del Sistema

// Encriptar_Password Temporal
Route::any('encriptar', array('as'=>'encriptar','uses'=>'ControllerIndex\IndexController@encriptar'));
Route::any('Encriptar_Password_Temporal', array('as'=>'Encriptar_Password_Temporal','uses'=>'ControllerIndex\IndexController@Encriptar_Password_Temporal'));
// Termina Encriptar_Password Temporal

// Notificaciones
Route::any('Cargar_Notificaciones', array('as'=>'Cargar_Notificaciones','uses'=>'ControllerIndex\IndexController@Cargar_Notificaciones'))->middleware('auth');
// Termina Notificaciones

// Equipos
Route::any('Equipos', array('as'=>'Equipos','uses'=>'AdministradorController\Administrador_Controller@Equipos_V'))->middleware('auth');

// Carga Vista Parametros
Route::any('Parametros_Equipos_R', array('as'=>'Parametros_Equipos_R','uses'=>'AdministradorController\Administrador_Controller@Parametros_Equipos_C'))->middleware('auth');
// Ruta para registrar una nueva variable
Route::any('Registrar_Nueva_Variable', array('as'=>'Registrar_Nueva_Variable','uses'=>'AdministradorController\Administrador_Controller@Registrar_Nueva_Variable'))->middleware('auth');
// Carga Nombre de parametros en Jcombobox Vista Parametros
Route::any('Listar_Parametros_Vista_Parametros', array('as'=>'Listar_Parametros_Vista_Parametros','uses'=>'AdministradorController\Administrador_Controller@Listar_Parametros_Vista_Parametros'))->middleware('auth');
// Carga Nombre de unidades en Jcombobox Vista Parametros
Route::any('Listar_Unidad_Vista_Parametros', array('as'=>'Listar_Unidad_Vista_Parametros','uses'=>'AdministradorController\Administrador_Controller@Listar_Unidad_Vista_Parametros'))->middleware('auth');
// Ruta Para cargar el parametro seleccionado en el Jcombobox para Modificar
//Termina  Ruta Para cargar el parametro seleccionado en el Jcombobox para Modificar
// Ruta para actualizar una variable
Route::any('Actualizar_Variable', array('as'=>'Actualizar_Variable','uses'=>'AdministradorController\Administrador_Controller@Actualizar_Variable'))->middleware('auth');
// Termina Ruta para actualizar una variable
// Ruta para Eliminar una variable
Route::any('Eliminar_Variable', array('as'=>'Eliminar_Variable','uses'=>'AdministradorController\Administrador_Controller@Eliminar_Variable'))->middleware('auth');
// Ruta para Eliminar una variable parametros
// TERMINA VARIABLES
// Empienza de Unidades
Route::any('Registrar_Nueva_Unidad', array('as'=>'Registrar_Nueva_Unidad','uses'=>'AdministradorController\Administrador_Controller@Registrar_Nueva_Unidad'))->middleware('auth');
// Ruta Para Modificar una unidad
Route::any('Actualizar_Unidad', array('as'=>'Actualizar_Unidad','uses'=>'AdministradorController\Administrador_Controller@Actualizar_Unidad'))->middleware('auth');
// Termina Ruta para modificar una unidad
// Ruta Para eliminar una unidad
Route::any('Eliminar_Unidad', array('as'=>'Eliminar_Unidad','uses'=>'AdministradorController\Administrador_Controller@Eliminar_Unidad'))->middleware('auth');
// Termina Ruta para eliminar una unidad
// Termina Unidades

//  Termina Ruta par consultar el id del equipo en nueva asigancion
Route::any('Consultar_Id_Maquina', array('as'=>'Consultar_Id_Maquina','uses'=>'AdministradorController\Administrador_Controller@Consultar_Id_Maquina'))->middleware('auth');
// Termina Equipos

// Carga vista de las notificaciones
Route::any('Notificaciones', array('as'=>'Notificaciones','uses'=>'ControllerIndex\IndexController@Notificaciones'))->middleware('auth');
// Carga la vista y pinta la tabla de las notificaciones
Route::any('Tabla_Notificaciones', array('as'=>'Tabla_Notificaciones','uses'=>'ControllerIndex\IndexController@Tabla_Notificaciones'))->middleware('auth');
// Ruta Notificaciones Anteriores
Route::any('Tabla_Notificaciones_Anteriores', array('as'=>'Tabla_Notificaciones_Anteriores','uses'=>'ControllerIndex\IndexController@Tabla_Notificaciones_Anteriores'))->middleware('auth');
// Termina Ruta Notificaciones Anteriores
// Ruta Cambiar_Estado_Notificacion_LEIDO
Route::any('Cambiar_Estado_Notificacion', array('as'=>'Cambiar_Estado_Notificacion','uses'=>'ControllerIndex\IndexController@Cambiar_Estado_Notificacion'))->middleware('auth');
// Eliminar Notificaciones
Route::any('Eliminar_Notificacion', array('as'=>'Eliminar_Notificacion','uses'=>'ControllerIndex\IndexController@Eliminar_Notificacion'))->middleware('auth');
// Termina Vista de las notificaciones

//Ruta para reportar un Daño
Route::any('ReportarDano', array('as'=>'ReportarDano','uses'=>'ControllerIndex\IndexController@Reportar_Daño'))->middleware('auth');
//Ruta para cargar nombres de equipos Combobox
Route::any('cargar_nombres_equipos', array('as'=>'cargar_nombres_equipos','uses'=>'ControllerIndex\IndexController@cargar_nombres_equipos'))->middleware('auth');
// Ruta donde guarda la notificion por el empleado
Route::any('RegistrarNotificacion', array('as'=>'RegistrarNotificacion','uses'=>'ControllerIndex\IndexController@RegistrarNotificacion'))->middleware('auth');
// -------------------------Admin - Asignaciones---------------------------
// Ruta para asignaciones
Route::any('Asignaciones', array('as'=>'Asignaciones','uses'=>'AdministradorController\Administrador_Controller@Asignaciones'))->middleware('auth');
// Carga todas las asignaciones registradas en una Tabla
Route::any('Tabla_Asignaciones', array('as'=>'Tabla_Asignaciones','uses'=>'AdministradorController\Administrador_Controller@Tabla_Asignaciones'))->middleware('auth');


// Carga todos los usuarios en combobox
Route::any('Listar_Usuarios', array('as'=>'Listar_Usuarios','uses'=>'AdministradorController\Administrador_Controller@Listar_Usuarios'))->middleware('auth');
// Carga todos los Turnos en combobox
Route::any('Listar_Turnos', array('as'=>'Listar_Turnos','uses'=>'AdministradorController\Administrador_Controller@Listar_Turnos'))->middleware('auth');
// Carga todos los nombres de los formularios
Route::any('Listar_Formularios', array('as'=>'Listar_Formularios','uses'=>'AdministradorController\Administrador_Controller@Listar_Formularios'))->middleware('auth');
// Registrar Nueva Asignacion
Route::any('RegistrarNewAsignacion', array('as'=>'RegistrarNewAsignacion','uses'=>'AdministradorController\Administrador_Controller@RegistrarNewAsignacion'))->middleware('auth');
// Eliminar Asignacion
Route::any('Eliminar_Asignacion', array('as'=>'Eliminar_Asignacion','uses'=>'AdministradorController\Administrador_Controller@Eliminar_Asignacion'))->middleware('auth');
// Carga los datos en asignacion para modificarlos
Route::any('Cargar_Datos_Editar_Asignacion', array('as'=>'Cargar_Datos_Editar_Asignacion','uses'=>'AdministradorController\Administrador_Controller@Cargar_Datos_Editar_Asignacion'))->middleware('auth');
// Modificar Asignacion
Route::any('ModificarAsignacion', array('as'=>'ModificarAsignacion','uses'=>'AdministradorController\Administrador_Controller@ModificarAsignacion'))->middleware('auth');
// -------------------------Termina Admin - Asignaciones---------------------------
// -------------------------Reportes Admin---------------------------
// Cargar Vista de Reportes admin
Route::any('Reports', array('as'=>'Reports','uses'=>'AdministradorController\Reportes_Controller@Cargar_Vista_Reportes'))->middleware('auth');
// Cargar la grafica en el div
Route::any('Cargar_Graficas', array('as'=>'Cargar_Graficas','uses'=>'AdministradorController\Reportes_Controller@Cargar_Graficas'))->middleware('auth');
// Termina  Cargar la grafica en el div
// Carga el año y mes actual en el combox del reporte Estadistico
Route::any('Cargar_Ano_Mes_Reporte', array('as'=>'Cargar_Ano_Mes_Reporte','uses'=>'AdministradorController\Reportes_Controller@Cargar_Ano_Mes_Reporte'))->middleware('auth');
// Termina de Carga el año y mes actual en el combox del reporte Estadistico
// Carga el todos los turnos registrados en el combox del reporte Estadistico
Route::any('Cargar_Turnos_Registrados', array('as'=>'Cargar_Turnos_Registrados','uses'=>'AdministradorController\Reportes_Controller@Cargar_Turnos_Registrados'))->middleware('auth');
// Termina de Carga el todos los turnos registrados en el combox del reporte Estadistico
// Cargar los parametros dependiendo del formulario
Route::any('Listar_Parametros', array('as'=>'Listar_Parametros','uses'=>'AdministradorController\Reportes_Controller@Listar_Parametros'))->middleware('auth');
// Elabora la consulta y envia las fechas iniciales y finales.
Route::any('Consultar_x_Fecha', array('as'=>'Consultar_x_Fecha','uses'=>'AdministradorController\Reportes_Controller@Consultar_x_Fecha'))->middleware('auth');
// Ruta para cargar reporte de daños de maquinas
Route::any('Reporte_Maquinas', array('as'=>'Reporte_Maquinas','uses'=>'AdministradorController\Reportes_Controller@Reporte_Maquinas'))->middleware('auth');
// Termina Ruta para cargar Reporte de daños de maquinas
// Ruta para generar reporte pdf si existe algun daño registrado
Route::any('GenerarReporteDanoMaquinas', array('as'=>'GenerarReporteDanoMaquinas','uses'=>'AdministradorController\Reportes_Controller@GenerarReporteDanoMaquinas'))->middleware('auth');
// Termina Ruta  para generar reporte pdf si existe algun daño registrado
// Eliminar Reporte Exportado de la carpeta del proyecto
Route::any('delete_archivo_exportado', array('as'=>'delete_archivo_exportado','uses'=>'AdministradorController\Reportes_Controller@delete_archivo_exportado'))->middleware('auth');
//  Termina Eliminar Reporte Exportado de la carpeta del proyecto
// Ruta Prueba Reporte PDF

Route::any('prueba', array('as'=>'prueba','uses'=>'AdministradorController\Reportes_Controller@prueba'))->middleware('auth');
// Termina Ruta Prueba Reporte PDF
// -------------------------TerminaReportes Admin---------------------------

// Ruta Para Registrar Nuevo Detalle Formulario
Route::any('Registrar_Nuevo_Detalle_Formulario', array('as'=>'Registrar_Nuevo_Detalle_Formulario','uses'=>'AdministradorController\Administrador_Controller@Registrar_Nuevo_Detalle_Formulario'))->middleware('auth');
// Termina Ruta Para Registrar Nuevo Detalle Formulario
// Ruta Para Eliminar Detalle Formulario
Route::any('Eliminar_Registro_Detalle_Formulario', array('as'=>'Eliminar_Registro_Detalle_Formulario','uses'=>'AdministradorController\Administrador_Controller@Eliminar_Registro_Detalle_Formulario'))->middleware('auth');
// Termina Ruta Para Eliminar Detalle Formulario
// Ruta Para cargar Datos del Encabezado del formularo Para editar
Route::any('Consultar_Datos_Formulario_Editar', array('as'=>'Consultar_Datos_Formulario_Editar','uses'=>'AdministradorController\Administrador_Controller@Consultar_Datos_Formulario_Editar'))->middleware('auth');
//  Termina Ruta Para cargar Datos del Encabezado del formularo Para editar
// Actualizar Emcabezado Formulario
Route::any('Editar_Emcabezado_Formulario', array('as'=>'Editar_Emcabezado_Formulario','uses'=>'AdministradorController\Administrador_Controller@Editar_Emcabezado_Formulario'))->middleware('auth');
// Termina Actualzar Encabezado Formulario




// Carga la ruta del registro del formulario
Route::any('consolidadoFormulario1_R', array('as'=>'consolidadoFormulario1_R','uses'=>'Controller_Formulario\FormularioController@cargar_consolidado_formulario1'))->middleware('auth');

// Ruta para diseño de emcabezado y detalle 
Route::any('Cargar_Formulario', array('as'=>'Cargar_Formulario','uses'=>'Controller_Formulario\FormularioController@Cargar_Formulario'))->middleware('auth');

// Ruta para guardar Consolidado Form1
Route::any('Registrar_Consolidado', array('as'=>'Registrar_Consolidado','uses'=>'Controller_Formulario\FormularioController@Guardar_consolidado'))->middleware('auth');
// Ruta Para consultar una asignacion de un usuario seleccionado
Route::any('ConsultarAsignacionUsuario', array('as'=>'ConsultarAsignacionUsuario','uses'=>'AdministradorController\Administrador_Controller@ConsultarAsignacionUsuario'))->middleware('auth');



// EQUIPOSSSSSSSSSSSSSSSSSSSSSSSSSSS

// Ruta para cargar nombre de equipos en combobox
Route::any('Listar_Nombres_Equipos', array('as'=>'Listar_Nombres_Equipos','uses'=>'AdministradorController\Administrador_Controller@Listar_Nombres_Equipos'))->middleware('auth');


// Ruta para cargar nombre de equipos en combobox
Route::any('Listar_Tipos_Equipos_R', array('as'=>'Listar_Tipos_Equipos_R','uses'=>'AdministradorController\Administrador_Controller@Listar_Tipos_Equipos_C'))->middleware('auth');


// termina Ruta para cargar nombre de equipos en combobox


Route::any('Tabla_Equipos_R', array('as'=>'Tabla_Equipos_R','uses'=>'AdministradorController\Administrador_Controller@ConsultarEquipo_C'))->middleware('auth');


Route::any('Registrar_equipos_R', array('as'=>'Registrar_equipos_R','uses'=>'AdministradorController\Administrador_Controller@RegistrarNuevoEquipo_C'))->middleware('auth');



Route::any('Consultar_ultimo_id_R', array('as'=>'Consultar_ultimo_id_R','uses'=>'AdministradorController\Administrador_Controller@ConsultarUltimoEquipo_regisrado_C'))->middleware('auth');


Route::any('Cargar_Datos_Editar_Equipos_R', array('as'=>'Cargar_Datos_Editar_Equipos_R','uses'=>'AdministradorController\Administrador_Controller@Cargar_Datos_Editar_Equipos_C'))->middleware('auth');



Route::any('ConfirmarEdicionEquipos_R', array('as'=>'ConfirmarEdicionEquipos_R','uses'=>'AdministradorController\Administrador_Controller@ConfirmarActualizacionEquipo_C'))->middleware('auth');


Route::any('Eliminar_Equipo_R', array('as'=>'Eliminar_Equipo_R','uses'=>'AdministradorController\Administrador_Controller@Eliminar_Equipo_C'))->middleware('auth');


Route::any('Autocompletar_consolidado_R', array('as'=>'Autocompletar_consolidado_R','uses'=>'AdministradorController\Administrador_Controller@Autocompletar_consolidado_C'))->middleware('auth');

// EQUIPOSSSSSSSSSSSSSSSSSSSSSSSSSSS




// Ruta Para modulo de usuarios
Route::any('Usuarios', array('as'=>'Usuarios','uses'=>'ControllerUsuarios\UsuariosController@Index'))->middleware('auth');

// Ruta para registrar Nuevo FOrmulario
Route::any('RegistraNuevoFormulario', array('as'=>'RegistraNuevoFormulario','uses'=>'AdministradorController\Administrador_Controller@RegistraNuevoFormulario'))->middleware('auth');
// Termina Ruta para registrar Neuvo Formulario
// Ruta para cargar los usaurios registrados en tabla
Route::any('Tabla_Usuarios', array('as'=>'Tabla_Usuarios','uses'=>'ControllerUsuarios\UsuariosController@Tabla_Usuarios'))->middleware('auth');
// Termina Ruta para cargar los usaurios registrados en tabla
// Ruta para cargar tabla de las conexiones de los usuarios
Route::any('Tabla_Conexiones_Usuarios', array('as'=>'Tabla_Conexiones_Usuarios','uses'=>'ControllerUsuarios\UsuariosController@Tabla_Conexiones_Usuarios'))->middleware('auth');
// Termina Ruta para cargar tabla de los conexiones de los usuarios
// Ruta para cargar los datos del perfil de usuario
Route::any('Cargar_Datos_Perfil_Usuario', array('as'=>'Cargar_Datos_Perfil_Usuario','uses'=>'ControllerUsuarios\UsuariosController@Cargar_Datos_Perfil_Usuario'))->middleware('auth');
// Termina Ruta para cargar los datos del perfil de usuario
// Ruta para modificar Password Usuario Manual
Route::any('ModificarPasswordUsuario_Manual', array('as'=>'ModificarPasswordUsuario_Manual','uses'=>'ControllerUsuarios\UsuariosController@ModificarPasswordUsuario_Manual'))->middleware('auth');
// Termina Ruta para Modificar Password Manual
// Ruta para cargar todos los roles registrados
Route::any('Listar_Roles', array('as'=>'Listar_Roles','uses'=>'ControllerUsuarios\UsuariosController@Listar_Roles'))->middleware('auth');
// Termina Ruta para cargar todos los roles registrados
// Ruta Para registrar usuarios por ajax
Route::any('RegistrarNuevoUsuario', array('as'=>'RegistrarNuevoUsuario','uses'=>'ControllerUsuarios\UsuariosController@RegistrarNuevoUsuario'))->middleware('auth');
// Termina Ruta para registrar Usuarios por ajax
// Ruta Para Modificar Usuario por ajax
Route::any('ModificarNuevoUsuario', array('as'=>'ModificarNuevoUsuario','uses'=>'ControllerUsuarios\UsuariosController@ModificarNuevoUsuario'))->middleware('auth');
// Termina Ruta Para Modificar Usuario por ajax
// Ruta Para listar nombres de usuarios
Route::any('Listar_Nombres_Usuarios', array('as'=>'Listar_Nombres_Usuarios','uses'=>'ControllerUsuarios\UsuariosController@Listar_Nombres_Usuarios'))->middleware('auth');
// Termina Ruta Para listar nombres de usuarios
// Ruta para cargar tabla del usuario consultado
Route::any('Tabla_Usuarios_Consultada', array('as'=>'Tabla_Usuarios_Consultada','uses'=>'ControllerUsuarios\UsuariosController@Tabla_Usuarios_Consultada'))->middleware('auth');
// Termina Ruta para cargar tabla del usuario consultado
// Ruta para desactivar Usuario
Route::any('Desactivar_Usuario', array('as'=>'Desactivar_Usuario','uses'=>'ControllerUsuarios\UsuariosController@Desactivar_Usuario'))->middleware('auth');
// Termina Ruta para desactivar Usuario
// Ruta para Activar Usuario
Route::any('Activar_Usuario', array('as'=>'Activar_Usuario','uses'=>'ControllerUsuarios\UsuariosController@Activar_Usuario'))->middleware('auth');
// Termina Ruta para Activar Usuario
// Ruta para restablecer Password de Usuarios
Route::any('RestablecerPasswordUsuario', array('as'=>'RestablecerPasswordUsuario','uses'=>'ControllerUsuarios\UsuariosController@RestablecerPasswordUsuario'))->middleware('auth');
// Termina Ruta para restablecer Password de Usuarios
// Ruta para Modificar Password de Usuarios
Route::any('ModificarPasswordUsuario', array('as'=>'ModificarPasswordUsuario','uses'=>'ControllerUsuarios\UsuariosController@ModificarPasswordUsuario'))->middleware('auth');
// Termina Ruta para Modificar Password de Usuarios
// Ruta Para Cargar los Roles Registrados en un tabla
Route::any('Tabla_Roles_Registrados', array('as'=>'Tabla_Roles_Registrados','uses'=>'ControllerUsuarios\UsuariosController@Tabla_Roles_Registrados'))->middleware('auth');
// Termina Para Cargar los Roles Registrados en un tabla
// Ruta para registrar un nuevo rol con ajax
Route::any('RegistrarNuevoRol', array('as'=>'RegistrarNuevoRol','uses'=>'ControllerUsuarios\UsuariosController@RegistrarNuevoRol'))->middleware('auth');
// Termina Ruta registrar un nuevo rol con ajax
// Ruta Para Eliminar Un rol por ajax
Route::any('ElimiarRol', array('as'=>'ElimiarRol','uses'=>'ControllerUsuarios\UsuariosController@ElimiarRol'))->middleware('auth');
// Termina Ruta Para elminar Rol por ajax.
// Ruta para editar un rol
Route::any('EditarRol', array('as'=>'EditarRol','uses'=>'ControllerUsuarios\UsuariosController@EditarRol'))->middleware('auth');
// Termina Ruta para editar un rol
// Termina Ruta Para modulo de usuarios
// Ruta para modulo de Editar Formularios
Route::any('EdicionFormulario', array('as'=>'EdicionFormulario','uses'=>'AdministradorController\Administrador_Controller@EdicionFormulario'))->middleware('auth');
// Termina Ruta Para Editar Formularios


// Ruta para modulo de control de consolidados
Route::any('control_consolidado', array('as'=>'control_consolidado','uses'=>'AdministradorController\Administrador_Controller@control_consolidado_C'))->middleware('auth');
// Termina Ruta Para el control de consolidados
// -------------------------------------------Insersion formularios--------------
Route::any('CrearNuevaVersionFormulario', array('as'=>'CrearNuevaVersionFormulario','uses'=>'Controller_Formulario\FormularioController@CrearNuevaVersionFormulario'));
// -------------------------------------------fin Insersion formularios --------------
// -------------------------------------------Insersion formularios--------------
Route::any('FormularioSeleccionarRegistroRuta', array('as'=>'FormularioSeleccionarRegistroRuta','uses'=>'Controller_Formulario\FormularioController@CargarFormularioSeleccionarRegistro'));
// -------------------------------------------fin Insersion formularios --------------
// -------------------------------------------Insersion formularios--------------
Route::any('ActualizarFormulario1Ruta', array('as'=>'ActualizarFormulario1Ruta','uses'=>'Controller_Formulario\FormularioController@ActualizarFormulario1'));
// -------------------------------------------fin Insersion formularios --------------
// Ruara Para Editar el formulario en el mmodal
Route::any('Confirmar_Edicion_ruta', array('as'=>'Confirmar_Edicion_ruta','uses'=>'AdministradorController\Administrador_Controller@Confirmar_Edicion'));
	// Termina Ruta Para editar formulario en el modal
// Ruta para cargar Nombres de formularios en combox
Route::any('Listar_Nombres_Formularios', array('as'=>'Listar_Nombres_Formularios','uses'=>'AdministradorController\Administrador_Controller@Listar_Nombres_Formularios'));
// Termina  para cargar Nombres de formularios en combox
// Ruata Elabhorar Consulta als eleccionar combox en editar formularios
// Route::any('Listar_tabla_formularios_seleccioandos', array('as'=>'Listar_tabla_formularios_seleccioandos','uses'=>'AdministradorController\Administrador_Controller@Listar_Formularios_select_C'));
Route::any('Listar_tabla_formularios_seleccioandos', array('as'=>'Listar_tabla_formularios_seleccioandos','uses'=>'AdministradorController\Administrador_Controller@Listar_tabla_formularios_seleccioandos'));
//------------------------------------------------------pruebas ----------------
Route::any('soloPruebas', array('as'=>'soloPruebas','uses'=>'Controller_Formulario\FormularioController@pruebas'));


// -------------------------------------------fin pruebas --------------


//------------------------Control consolidados--------------------------------------------

Route::any('Listar_datos_usuarios_Activos_R', array('as'=>'Listar_datos_usuarios_Activos_R','uses'=>'AdministradorController\Administrador_Controller@Listar_datos_usuarios_Activos_C'))->middleware('auth');

Route::any('Listar_datos_turnos_R', array('as'=>'Listar_datos_turnos_R','uses'=>'AdministradorController\Administrador_Controller@Listar_datos_turnos_C'))->middleware('auth');

// Listar mes actual
Route::any('CargarMesActual_R', array('as'=>'CargarMesActual_R','uses'=>'AdministradorController\Administrador_Controller@ListarMesActual'))->middleware('auth');






Route::any('Informacion_formulario_diligenciado_R  ', array('as'=>'Informacion_formulario_diligenciado_R','uses'=>'AdministradorController\Administrador_Controller@Informacion_formulario_diligenciado_C'))->middleware('auth');




Route::any('cargar_tabla_control_consolido_R', array('as'=>'cargar_tabla_control_consolido_R','uses'=>'AdministradorController\Administrador_Controller@cargar_tabla_control_consolidos_C'))->middleware('auth');




Route::any('Listar_Formularios_R', array('as'=>'Listar_Formularios_R','uses'=>'AdministradorController\Administrador_Controller@Listar_Formularios_C'))->middleware('auth');





//--------------------------------fin control consolidados---------------------------------







// Termina Formulario 1



// Si no no existe la ruta va a la vista error
Route::any('{catchall}', function() {
	return Response::view('errors.503',array(),503);
})->where('catchall', '.*')->middleware('auth');



