<?php
date_default_timezone_set('America/Bogota');
use Carbon\Carbon;
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<title><?php echo $__env->yieldContent('title'); ?> | TpmMovil APP</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<!-- Para que no guarde en cache -->
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-cache">
	<link href="global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<link href="global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
	<link href="global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<!-- <link href="global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"> -->
	<link href="global/BoostrapButton/bootstrap-switch.css" rel="stylesheet">
	<link href="global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
	<link type="text/css" rel="stylesheet" href="global/plugins/zoom/style.css"/>
	<link href="global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
	<link href="global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="global/plugins/bootstrap-datepicker/css/datepicker.css"/>
	<link rel="stylesheet" type="text/css" href="global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
	<link href="global/css/plugins-md.css" rel="stylesheet" type="text/css"/>
	<link href="global/admin/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
	<link id="style_color" href="global/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css"/>
	<link href="global/admin/layout2/css/custom.css" rel="stylesheet" type="text/css"/>
	<link href="global/plugins/select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>	
	<!-- <link rel="icon" type="image/png" href="http://sucroal.com.co/wp-content/uploads/2015/09/favicon-sucroal-01.png"> -->
	<link rel="icon" type="image/png" href="global/slider/FotosSucroal/Nuevas/paginaweb.ico">

	
	<script src="global/plugins/jquery/jquery-3.1.0.min.js"></script>	

	
</head>
<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" id="_token">
<script type="text/javascript">
	function deshabilitaRetroceso(){
		window.location.hash=" ";
	window.location.hash="Again-No-back-button" //chrome
	window.onhashchange=function(){window.location.hash=" ";}
}
</script>
<script type="text/javascript">
	var Variable_Tiempo;
	function Consultar_Notificaciones_Cada_5_Min() {
		if("<?php echo e(Auth::user()->fk_rol==1); ?>"){
	Variable_Tiempo= window.setTimeout(function(){NotificacionesMensajes();},350000);//Tiempo en milesegundos en que carga la funcion contador    300000=5 Minutos 250000= 4 min
}
}
function NotificacionesMensajes(){
	$.ajax({
		type:'get',
		url:'<?php echo e(url('Cargar_Notificaciones')); ?>',
		success: function(data){
			$('#NotificacionesAdministrador').empty().html(data);
			window.clearTimeout(Variable_Tiempo);
			Consultar_Notificaciones_Cada_5_Min(); 
			// console.API;
		}
	});	
}

var timer;
var Variable_Tiempo,Variable_Tiempo2;

function ini() {
  Variable_Tiempo= window.setTimeout(function(){ContadorSesion();},900000);//Tiempo en milesegundos en que carga la funcion contador    300000=5 Minutos 
  // Variable_Tiempo2= window.setTimeout(function(){CompararHoraActual();},200);// Tiempo para comparar la hora actual con el turno actual
}

function startTime() {
	var today = new Date();
	var h = today.getHours();
	var m = today.getMinutes();
	var s = today.getSeconds();
	m = checkTime(m);
	s = checkTime(s);
	$('.HoraReloj').html("<i class='fa fa-clock-o fa-2x' aria-hidden='true'></i> "+h + ":" + m + ":" + s);
	$(".HoraReloj").css("fontSize", 20);						
	$(".HoraReloj").css("font-weight","Bold");
	var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

function CancelarContador() {
	$('.MensajeSinInactividad').hide();
	$("#pulsate-regular").hide();
	window.clearTimeout(timer);
	window.clearTimeout(Variable_Tiempo);
	ini();
// clearInterval(timer);
}
function ContadorSesion(){
	var info2   = $('.MensajeSinInactividad');
	var mensaje;
// var time = "00:02:30",
var time = "00:05:00",
parts = time.split(':'),
hours = +parts[0],
minutes = +parts[1],
seconds = +parts[2],
span = $('#countdown');
function correctNum(num) {
	return (num<10)? ("0"+num):num;
}
timer = setInterval(function(){
	$('.MensajeSinInactividad').show();
	$("#pulsate-regular").show();
	seconds--;
	if(seconds == -1) {
		seconds = 59;
		minutes--;
		if(minutes == -1) {
			minutes = 59;
			hours--;
			if(hours==-1) {
// alert("timer finished");
clearInterval(timer);
// $mensajee="Su sesión ha expirado.";
Variable_Tiempo = setTimeout('document.location.href = "<?php echo e(route('Salir')); ?>"',1);
return  ;
}
}
}
$(".EstiloMensajeSinInactividad").show();
$(".MensajeSinInactividad").css("fontSize", 15);						
$(".MensajeSinInactividad").css("font-weight","Bold"); 	
$(".EstiloMensajeSinInactividad").attr("class", "panel panel-danger");
$('.MensajeSinInactividad').show();			
$('.MensajeSinInactividad').html('<h4><i class="fa fa-clock-o" aria-hidden="true"></i>'+' No ha habido actividad en los últimos 15 minutos, por seguridad la sesión se cerrara automáticamente en:'+correctNum(hours) + ":" + correctNum(minutes) + ":" + correctNum(seconds)+' '+'<button type="button" class="btn btn-info btn-xs" onclick="CancelarContador()">Cancelar</button></li></h4>');
}, 1000);
}
</script>
<body class="page-md page-header-fixed page-container-bg-solid page-sidebar-closed-hide-logo page-header-fixed-mobile page-footer-fixed1" onload="deshabilitaRetroceso();Consultar_Notificaciones_Cada_5_Min();startTime();<?php if(Auth::user()->fk_rol!=1): ?> ini();<?php endif; ?>" onkeypress="CancelarContador()" onclick="CancelarContador()">
	<!-- BEGIN HEADER -->
	<div class="page-header md-shadow-z-1-i navbar navbar-fixed-top">
		<!-- BEGIN HEADER INNER -->
		<div class="page-header-inner">
			<!-- BEGIN LOGO -->
			<div class="page-logo">
				<a href="<?php echo e(URL::route('Index')); ?>">
					<!-- <img src="global/slider/FotosSucroal/Nuevas/1.jpeg" alt="logo" class="logo-default" height="40" width="130"> -->
					<font size ="2", color ="#fcfcfc"><center><i class="fa fa-home fa-4x logo-default" aria-hidden="true" title="Inicio TpmMovil"></i></center></font>
				</a>
				<div class="menu-toggler sidebar-toggler">
					<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
				</div>
			</div>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
			</a>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<!-- BEGIN PAGE ACTIONS -->
			<!-- DOC: Remove "hide" class to enable the page header actions -->
			<div class="page-actions">
				<div class="btn-group hide">
					<button type="button" class="btn btn-circle red-pink dropdown-toggle" data-toggle="dropdown">
						<i class="icon-bar-chart"></i>&nbsp;<span class="hidden-sm hidden-xs">New&nbsp;</span>&nbsp;<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="javascript:;">
								<i class="icon-user"></i> New User </a>
							</li>
							<li>
								<a href="javascript:;">
									<i class="icon-present"></i> New Event <span class="badge badge-success">4</span>
								</a>
							</li>
							<li>
								<a href="javascript:;">
									<i class="icon-basket"></i> New order </a>
								</li>
								<li class="divider">
								</li>
								<li>
									<a href="javascript:;">
										<i class="icon-flag"></i> Pending Orders <span class="badge badge-danger">4</span>
									</a>
								</li>
								<li>
									<a href="javascript:;">
										<i class="icon-users"></i> Pending Users <span class="badge badge-warning">12</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="page-top">
						<div class="top-menu">
							<div class="row">
								<ul class="nav navbar-nav pull-left">
									<div  style="margin-left: auto;margin-top: 18px">
										<!-- Hora Actual: -->
										<div class="HoraReloj" id="HoraReloj"></div>
									</div>
								</ul>
								<ul class="nav navbar-nav pull-right">
									<div>
										<script type="text/javascript">
											NotificacionesMensajes();
										</script>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: -2%" id="NotificacionesAdministrador">						
										</div>
									</div>
								</ul>
							</div>
							<!-- <ul class="nav navbar-nav pull-right"> -->
							<!-- Icono de  Notificaciones -->
									<!-- <script type="text/javascript">
										NotificacionesMensajes();
									</script>
									<div id="NotificacionesAdministrador"></div> -->
									<!-- Termina las notificaciones -->
									<!-- </ul> -->
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix">
					</div>
					<div class="page-container">
						<div class="page-sidebar-wrapper">
							<div class="page-sidebar navbar-collapse collapse">
								<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
									<?php
									$vista = Route::currentRouteName();
									$current = array
									(
										'Index' => '',
										'Asignaciones' => '',
										'Notificaciones' => '',
										'Equipos' => '',
										'ReportarDano' => '',
										'Reports' => '',
										'Reporte_Maquinas' => '',
										'Usuarios' => '',
										'EdicionFormulario' => '',
										'control_consolidado' => ''
										);
									if ($vista == '' || $vista == 'Index'){
										$current['Index'] = 'active';
									}
									else if ($vista == '' || $vista == 'Asignaciones'){
										$current['Asignaciones'] = 'active';
									}
									else if ($vista == '' || $vista == 'Notificaciones'){
										$current['Notificaciones'] = 'active';
									}
									else if ($vista == '' || $vista == 'Equipos'){
										$current['Equipos'] = 'active';
									}								
									else if ($vista == '' || $vista == 'ReportarDano'){
										$current['ReportarDano'] = 'active';
									}
									else if ($vista == '' || $vista == 'Reports' || $vista == 'Reporte_Maquinas'){
										$current['Reports'] = 'active';
									}							
									else if ($vista == '' || $vista == 'Usuarios'){
										$current['Usuarios'] = 'active';
									}
									else if ($vista == '' || $vista == 'EdicionFormulario'){
										$current['EdicionFormulario'] = 'active';
									}
									else if ($vista == '' || $vista == 'control_consolidado'){
										$current['control_consolidado'] = 'active';
									}														
									?>
									<?php if(Auth::user()->fk_rol!=1): ?>
									<li class="<?php echo e($current['Index']); ?>">
										<a href="<?php echo e(URL::route('Index')); ?>">
											<i class="icon-home"></i>
											<span class="title">Menú Principal</span>
										</a>
									</li>
									<li class="<?php echo e($current['ReportarDano']); ?>">
										<a href="javascript:;">
											<i class="fa fa-bug" aria-hidden="true"></i>
											<span class="title">Daños</span>
											<span class="arrow "></span>
										</a>
										<ul class="sub-menu">
											<li>
												<a href="<?php echo e(URL::route('ReportarDano')); ?>">
													<i class="fa fa-plus-circle" aria-hidden="true"></i>
													Reportar Daño</a>
												</li> 
											</ul>
										</li>
										<?php endif; ?>
										<?php if(Auth::user()->fk_rol==1): ?>
										<!-- Asignaciones -->
										<li class="<?php echo e($current['Asignaciones']); ?>">
											<a href="<?php echo e(URL::route('Asignaciones')); ?>">
												<i class="fa fa-cog" aria-hidden="true"></i>
												<span class="title">Asignaciones</span>
												<span class="arrow "></span>
											</a>
										</li> 
										<!-- Termina Asignaciones -->	
										<!-- Notificaciones -->
										<li class="<?php echo e($current['Notificaciones']); ?>">
											<a href="<?php echo e(URL::route('Notificaciones')); ?>">
												<i class="fa fa-envelope-o" aria-hidden="true"></i>
												<span class="title">Notificaciones</span>
												<span class="arrow "></span>
											</a>
										</li> 
										<!-- Termina Notificaciones -->	
										<!-- Notificaciones -->
										<li class="<?php echo e($current['Equipos']); ?>">
											<a href="<?php echo e(URL::route('Equipos')); ?>">
												<i class="fa fa-microchip" aria-hidden="true"></i>
												<span class="title">Equipos</span>
												<span class="arrow "></span>
											</a>
										</li> 
										<!-- Termina Notificaciones -->	
										<!-- Empieza Modulo Usuarios -->
										<li class="<?php echo e($current['Usuarios']); ?>">
											<a href="<?php echo e(URL::route('Usuarios')); ?>">
												<i class="fa fa-user" aria-hidden="true"></i>
												<span class="title">Usuarios</span>
												<span class="arrow "></span>
											</a>
										</li>
										<!-- Empieza Ediccion Formularios -->
										<li class="<?php echo e($current['EdicionFormulario']); ?>">
											<a href="<?php echo e(URL::route('EdicionFormulario')); ?>">
												<i class="fa fa-pencil-square" aria-hidden="true"></i>
												<span class="title">Formularios</span>
												<span class="arrow "></span>
											</a>
										</li>
										<!-- Termina Ediccion Formularios -->
										<!-- Empieza Ediccion revision trabajo -->
										<li class="<?php echo e($current['control_consolidado']); ?>">
											<a href="<?php echo e(URL::route('control_consolidado')); ?>">
												<i class="fa fa-eye" aria-hidden="true"></i>
												<span class="title">Control de consolidados</span>
												<span class="arrow "></span>
											</a>
										</li>
										<!-- Termina revision trabajo -->
										<!-- Termina Modulo Usuarios -->
										<!--Empieza Reports admin  -->
										<li class="<?php echo e($current['Reports']); ?>">
											<a href="javascript:;">
												<i class="fa fa-book" aria-hidden="true"></i>
												<span class="title">Reportes</span>
												<span class="arrow "></span>
											</a>
											<ul class="sub-menu">
												<li>
													<a href="<?php echo e(URL::route('Reporte_Maquinas')); ?>">
														<i class="fa fa-rocket" aria-hidden="true"></i>
														Daños Máquina
													</a>
												</li> 											
												<li>
													<a href="<?php echo e(URL::route('Reports')); ?>">
														<i class="fa fa-bar-chart" aria-hidden="true"></i>
														Estadisticos
													</a>
												</li> 
											</ul>
										</li>																	
										<!-- Termina Reportes admin -->
										<?php else: ?>
										<?php endif; ?>						
									</div>
								</div>
								<div class="page-content-wrapper">
									<div class="page-content">
										<div class="row">
											<div class="col-md-12">
												<?php echo $__env->yieldContent('content'); ?>
											</div>
										</div>								
									</div>

								</div>
								<div class="page-footer">
									<div class="page-footer-inner">
										2017 &copy; Copyright TpmMovil APP.
									</div>
									<div class="scroll-to-top">
										<i class="icon-arrow-up"></i>
									</div>
								</div>


								<script type="text/javascript">
									Autocompletado_rutas();
									function Autocompletado_rutas(){
										$.ajax({
											url   : "<?= URL::to('Autocompletar_consolidado_R') ?>",
											type  : "GET",
											async : false,
											data  :{    

											},
										});
									}
								</script>




								<script src="global/plugins/jquery.min.js" type="text/javascript"></script>
								<script src="global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
								<script src="global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
								<script src="global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
								<script src="global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
								<script src="global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
								<script src="global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
								<script src="global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
								<script src="global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
								<script src="global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
								<script src="global/scripts/metronic.js" type="text/javascript"></script>
								<script src="global/admin/layout2/scripts/layout.js" type="text/javascript"></script>
								<script src="global/admin/layout2/scripts/demo.js" type="text/javascript"></script>
								<script src="global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
								<script src="global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
								<script type="text/javascript" src="global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
								<script type="text/javascript" src="global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
								<script src="global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
								<script src="global/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
								<script src="global/admin/pages/scripts/index.js" type="text/javascript"></script>
								<script type="text/javascript" src="global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
								<script type="text/javascript" src="global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
								<script type="text/javascript" src="global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
								<script src="global/scripts/datatable.js"></script>
								<script src="global/admin/pages/scripts/ecommerce-orders-view.js"></script>
								<script>
									jQuery(document).ready(function() {
										Metronic.init();
										Layout.init();
										QuickSidebar.init();
										Demo.init();
										Index.init();
										Index.initDashboardDaterange();
										Index.initCalendar();
										EcommerceOrdersView.init();
									});
								</script>								
								<script src="global/plugins/select/js/bootstrap-select.min.js" type="text/javascript"></script>
								<script type="text/javascript">
									$('#id_producto').selectpicker({
										size: 8
									});
								</script>

								<script type="text/javascript"></script>

								<script src="global/BoostrapButton/bootstrap-switch.js">	
								</script>
								<script type="text/javascript">
									$("[name='CheckBossUser']").bootstrapSwitch('state', true)
								</script>
								<style type="text/css">
									.bootstrap-select.btn-group .btn .filter-option {
										text-align: center; /* to override text-align: left; */
									}
									.bootstrap-select.btn-group .dropdown-menu li > a {
										text-align: center;
									}
									.bootstrap-switch-large{
										width: 200px;
									}
								</style>
							</body>
							</html>